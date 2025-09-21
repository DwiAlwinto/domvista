<?php

namespace App\Exports;

use App\Models\Resident;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;

class ResidentExportBulk implements FromCollection, WithHeadings, WithStyles, WithTitle, WithColumnWidths, \Maatwebsite\Excel\Concerns\WithEvents
{
    protected $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function collection(): Collection
    {
        $query = Resident::with([
            'units.tower',
            'units.floor',
            'familyMembers',
            'staffs',
            'activeParkingAssignment.parkingLot.parkingArea'
        ]);

        // Filter berdasarkan tipe
        match ($this->type) {
            'owner' => $query->where('is_owner', true),
            'leasee_active' => $query->where('is_owner', false)
                ->whereHas('units', fn($q) => $q->whereNull('end_date')->orWhere('end_date', '>', now())),
            'leasee_expired' => $query->where('is_owner', false)
                ->whereHas('units', fn($q) => $q->where('end_date', '<=', now())),
            default => null // all data
        };

        return $query->get()->map(function ($resident) {
            $unit = $resident->units->first();

            return [
                'Full Name'         => $resident->full_name,
                'Status'            => $resident->is_owner ? 'Owner' : 'Leasee',
                'Email'             => $resident->email ?? '-',
                'Phone'             => $resident->phone ?? '-',
                'Identity Number'   => $resident->identity_number ?? '-',
                'Citizenship'       => $resident->citizenship ?? '-',
                'Religion'          => $resident->religion ?? '-',
                'Place of Birth'    => $resident->place_of_birth ?? '-',
                'Date of Birth'     => $resident->date_of_birth ? Carbon::parse($resident->date_of_birth)->format('d M Y') : '-',
                'Gender'            => ucfirst($resident->gender) ?? '-',
                'Occupation'        => $resident->occupation ?? '-',
                'Company'           => $resident->company ?? '-',
                'Agent Name'        => $resident->agent_name ?? '-',
                'Agent Company'     => $resident->agent_company ?? '-',
                'Unit Code'         => $unit?->unit_code ?? '-',
                'Tower'             => $unit?->tower?->name ?? '-',
                'Floor'             => $unit?->floor?->name ?? '-',
                'Role in Unit'      => $unit?->pivot->role ?? '-',
                'Start Date'        => $unit && $unit->pivot->start_date ? Carbon::parse($unit->pivot->start_date)->format('d M Y') : '-',
                'End Date'          => $unit && $unit->pivot->end_date ? Carbon::parse($unit->pivot->end_date)->format('d M Y') : 'Active',
                'Parking Area'      => '-',
                'Parking Lot'       => '-',
                'Parking Type'      => '-',
                'Assigned At'       => '-',
                'Family Members'    => $resident->familyMembers->pluck('name')->implode(', ') ?: '-',
                'Staff Members'     => $resident->staffs->map(fn($s) => "{$s->name} ({$s->type})")->implode(', ') ?: '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Full Name',
            'Status',
            'Email',
            'Phone',
            'Identity Number',
            'Citizenship',
            'Religion',
            'Place of Birth',
            'Date of Birth',
            'Gender',
            'Occupation',
            'Company',
            'Agent Name',
            'Agent Company',
            'Unit Code',
            'Tower',
            'Floor',
            'Role in Unit',
            'Start Date',
            'End Date',
            'Parking Area',
            'Parking Lot',
            'Parking Type',
            'Assigned At',
            'Family Members',
            'Staff Members'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 12,
            'C' => 25,
            'D' => 15,
            'E' => 18,
            'F' => 15,
            'G' => 15,
            'H' => 18,
            'I' => 15,
            'J' => 10,
            'K' => 20,
            'L' => 20,
            'M' => 20,
            'N' => 20,
            'O' => 12,
            'P' => 15,
            'Q' => 10,
            'R' => 15,
            'S' => 12,
            'T' => 12,
            'U' => 15,
            'V' => 12,
            'W' => 15,
            'X' => 15,
            'Y' => 30,
            'Z' => 30,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => '2980b9']],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'borders' => [
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => '000000']],
                ],
            ],
        ];
    }

    public function title(): string
    {
        return match ($this->type) {
            'all' => 'All Residents',
            'owner' => 'Owners Only',
            'leasee_active' => 'Active Leasees',
            'leasee_expired' => 'Expired Leasees',
            default => 'Residents'
        };
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $lastRow = $sheet->getHighestRow();

                // Tambah header report
                $sheet->insertNewRowBefore(1, 3);
                $sheet->mergeCells('A1:Z1');
                $sheet->setCellValue('A1', "RESIDENTS BULK EXPORT");
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 16, 'color' => ['argb' => '2c3e50']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                $typeLabel = match ($this->type) {
                    'all' => 'All Residents',
                    'owner' => 'Owners Only',
                    'leasee_active' => 'Active Leasees',
                    'leasee_expired' => 'Expired Leasees',
                    default => 'All Residents'
                };

                $sheet->mergeCells('A2:Z2');
                $sheet->setCellValue('A2', "Category: {$typeLabel} | Generated on: " . now()->format('d M Y, H:i') . " | Total: " . ($lastRow - 2) . " residents");
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => ['italic' => true, 'color' => ['argb' => '7f8c8d']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                // Freeze pane & filter
                $sheet->freezePane('A3');
                $sheet->setAutoFilter("A2:Z2");

                // Set row height
                for ($row = 3; $row <= $lastRow; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(30);
                }
            }
        ];
    }
}
