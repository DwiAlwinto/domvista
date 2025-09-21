<?php

namespace App\Exports;

use App\Models\Resident;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;

class ResidentExportBulk implements FromCollection, WithHeadings, WithStyles, WithTitle, WithColumnWidths, WithEvents
{
    protected $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    /**
     * Ambil data resident + maksimal 3 parkir, 4 family, 4 staff
     */
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
        $query = match ($this->type) {
            'owner' => $query->where('is_owner', true),
            'leasee_active' => $query->where('is_owner', false)
                ->whereHas('units', fn($q) => $q->whereNull('end_date')->orWhere('end_date', '>', now())),
            'leasee_expired' => $query->where('is_owner', false)
                ->whereHas('units', fn($q) => $q->where('end_date', '<=', now())),
            default => $query // all residents
        };

        $residents = $query->get();

        return $residents->map(function ($resident) {
            $unit = $resident->units->first();
            $parkings = $resident->activeParkingAssignment->take(3); // max 3

            // Siapkan data parkir
            $parkingData = [];
            for ($i = 1; $i <= 3; $i++) {
                $p = $parkings[$i - 1] ?? null;

                $parkingData["Parking Area {$i}"] = $p && $p->parkingLot && $p->parkingLot->parkingArea
                    ? $p->parkingLot->parkingArea->area_code : '-';

                $parkingData["Lot Number {$i}"] = $p && $p->parkingLot
                    ? $p->parkingLot->lot_number : '-';

                $parkingData["Assigned At {$i}"] = $p && $p->assigned_at
                    ? Carbon::parse($p->assigned_at)->format('d M Y') : '-';
            }

            // Siapkan family members (max 4)
            $familyNames = $resident->familyMembers->take(4);
            $families = [];
            for ($i = 1; $i <= 4; $i++) {
                $families["Family Name {$i}"] = $familyNames[$i - 1]?->name ?? '-';
            }

            // Siapkan staff members (max 4)
            $staffMembers = $resident->staffs->take(4);
            $staffs = [];
            for ($i = 1; $i <= 4; $i++) {
                $s = $staffMembers[$i - 1] ?? null;
                $staffs["Staff Name {$i}"] = $s ? "{$s->name} ({$s->type})" : '-';
            }

            return array_merge([
                'Full Name'         => $resident->full_name ?? '-',
                'Status'            => $resident->is_owner ? 'Owner' : 'Leasee',
                'Email'             => $resident->email ?? '-',
                'Phone'             => $resident->phone ?? '-',
                'Identity Number'   => $resident->identity_number ?? '-',
                'Citizenship'       => $resident->citizenship ?? '-',
                'Religion'          => $resident->religion ?? '-',
                'Date of Birth'     => $resident->date_of_birth ? Carbon::parse($resident->date_of_birth)->format('d M Y') : '-',
                'Gender'            => $resident->gender ? ucfirst($resident->gender) : '-',
                'Occupation'        => $resident->occupation ?? '-',
                'Company'           => $resident->company ?? '-',
                'Agent Name'        => $resident->agent_name ?? '-',
                'Agent Company'     => $resident->agent_company ?? '-',
                'Unit Code'         => $unit?->unit_code ?? '-',
                'Tower'             => $unit?->tower?->name ?? '-',
                'Role in Unit'      => $unit?->pivot->role ?? '-',
                'Start Date'        => $unit && $unit->pivot->start_date ? Carbon::parse($unit->pivot->start_date)->format('d M Y') : '-',
                'End Date'          => $unit && $unit->pivot->end_date ? Carbon::parse($unit->pivot->end_date)->format('d M Y') : 'Active',
            ], $parkingData, $families, $staffs);
        });
    }

    /**
     * Header kolom Excel
     */
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
            'Date of Birth',
            'Gender',
            'Occupation',
            'Company',
            'Agent Name',
            'Agent Company',
            'Unit Code',
            'Tower',
            'Role in Unit',
            'Start Date',
            'End Date',

            // Parking Slot 1
            'Parking Area 1',
            'Lot Number 1',
            'Assigned At 1',

            // Parking Slot 2
            'Parking Area 2',
            'Lot Number 2',
            'Assigned At 2',

            // Parking Slot 3
            'Parking Area 3',
            'Lot Number 3',
            'Assigned At 3',

            // Family Members
            'Family Name 1',
            'Family Name 2',
            'Family Name 3',
            'Family Name 4',

            // Staff Members
            'Staff Name 1',
            'Staff Name 2',
            'Staff Name 3',
            'Staff Name 4',
        ];
    }

    /**
     * Lebar kolom
     */
    public function columnWidths(): array
    {
        return [
            'A'  => 25,  // Full Name
            'B'  => 12,  // Status
            'C'  => 25,  // Email
            'D'  => 15,  // Phone
            'E'  => 18,  // Identity Number
            'F'  => 15,  // Citizenship
            'G'  => 15,  // Religion
            'H'  => 15,  // Date of Birth
            'I'  => 10,  // Gender
            'J'  => 20,  // Occupation
            'K'  => 20,  // Company
            'L'  => 20,  // Agent Name
            'M'  => 20,  // Agent Company
            'N'  => 12,  // Unit Code
            'O'  => 15,  // Tower
            'P'  => 15,  // Role in Unit
            'Q'  => 12,  // Start Date
            'R'  => 12,  // End Date

            // Parking 1
            'S'  => 15,  // Parking Area 1
            'T'  => 12,  // Lot Number 1
            'U'  => 15,  // Assigned At 1

            // Parking 2
            'V'  => 15,  // Parking Area 2
            'W'  => 12,  // Lot Number 2
            'X'  => 15,  // Assigned At 2

            // Parking 3
            'Y'  => 15,  // Parking Area 3
            'Z'  => 12,  // Lot Number 3
            'AA' => 15,  // Assigned At 3

            // Family
            'AB' => 18,  // Family Name 1
            'AC' => 18,  // Family Name 2
            'AD' => 18,  // Family Name 3
            'AE' => 18,  // Family Name 4

            // Staff
            'AF' => 20,  // Staff Name 1
            'AG' => 20,  // Staff Name 2
            'AH' => 20,  // Staff Name 3
            'AI' => 20,  // Staff Name 4
        ];
    }

    /**
     * Styling header
     */
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

    /**
     * Nama sheet
     */
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

    /**
     * Event setelah sheet jadi
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $lastRow = $sheet->getHighestRow();

                // Tambah header report
                $sheet->insertNewRowBefore(1, 3);
                $sheet->mergeCells('A1:AI1');
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

                $sheet->mergeCells('A2:AI2');
                $sheet->setCellValue('A2', "Category: {$typeLabel} | Generated on: " . now()->format('d M Y, H:i') . " | Total: " . ($lastRow - 2) . " residents");
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => ['italic' => true, 'color' => ['argb' => '7f8c8d']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                // Freeze pane & filter
                $sheet->freezePane('A3');
                $sheet->setAutoFilter("A2:AI2");

                // Set row height
                for ($row = 3; $row <= $lastRow; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(30);
                }
            }
        ];
    }
}
