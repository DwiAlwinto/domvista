<?php

namespace App\Exports;

use App\Models\Resident;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ResidentExport implements FromCollection, WithHeadings, WithStyles, WithTitle, WithColumnWidths
{
    protected $resident;

    public function __construct(Resident $resident)
    {
        $this->resident = $resident;
    }

    public function collection()
    {
        $data = [];

        // Personal Information
        $data[] = [
            'Field' => 'Full Name',
            'Value' => $this->resident->full_name,
        ];
        $data[] = [
            'Field' => 'Email',
            'Value' => $this->resident->email ?? '-',
        ];
        $data[] = [
            'Field' => 'Phone',
            'Value' => $this->resident->phone ?? '-',
        ];
        $data[] = [
            'Field' => 'Identity Number',
            'Value' => $this->resident->identity_number ?? '-',
        ];
        $data[] = [
            'Field' => 'Status',
            'Value' => $this->resident->is_owner ? 'Owner' : 'Leasee',
        ];
        $data[] = [
            'Field' => 'Citizenship',
            'Value' => $this->resident->citizenship ?? '-',
        ];
        $data[] = [
            'Field' => 'Religion',
            'Value' => $this->resident->religion ?? '-',
        ];
        $data[] = [
            'Field' => 'Place of Birth',
            'Value' => $this->resident->place_of_birth ?? '-',
        ];
        $data[] = [
            'Field' => 'Date of Birth',
            'Value' => $this->resident->date_of_birth ? \Carbon\Carbon::parse($this->resident->date_of_birth)->format('d M Y') : '-',
        ];
        $data[] = [
            'Field' => 'Gender',
            'Value' => ucfirst($this->resident->gender) ?? '-',
        ];
        $data[] = [
            'Field' => 'Occupation',
            'Value' => $this->resident->occupation ?? '-',
        ];
        $data[] = [
            'Field' => 'Company',
            'Value' => $this->resident->company ?? '-',
        ];
        $data[] = [
            'Field' => 'Agent Company',
            'Value' => $this->resident->agent_company ?? '-',
        ];
        $data[] = [
            'Field' => 'Agent Name',
            'Value' => $this->resident->agent_name ?? '-',
        ];
        $data[] = [
            'Field' => 'Agent Phone',
            'Value' => $this->resident->number_agent ?? '-',
        ];

        // Unit Details
        if ($this->resident->units->isNotEmpty()) {
            foreach ($this->resident->units as $unit) {
                $data[] = ['Field' => 'Unit Code', 'Value' => $unit->unit_code];
                $data[] = ['Field' => 'Tower', 'Value' => $unit->tower->name];
                $data[] = ['Field' => 'Floor', 'Value' => $unit->floor->name];
                $data[] = ['Field' => 'Role', 'Value' => $unit->pivot->role];
                $data[] = ['Field' => 'Start Date', 'Value' => \Carbon\Carbon::parse($unit->pivot->start_date)->format('d M Y')];
                $data[] = ['Field' => 'End Date', 'Value' => $unit->pivot->end_date ? \Carbon\Carbon::parse($unit->pivot->end_date)->format('d M Y') : 'Active'];

                if (in_array($unit->pivot->role, ['Owner', 'Co-Owner'])) {
                    $data[] = ['Field' => 'Date Sold', 'Value' => $unit->pivot->date_sold ? \Carbon\Carbon::parse($unit->pivot->date_sold)->format('d M Y') : 'Not set'];
                    $data[] = ['Field' => 'Handover Date', 'Value' => $unit->pivot->date_handover ? \Carbon\Carbon::parse($unit->pivot->date_handover)->format('d M Y') : 'Not set'];
                }
            }
        }

        // Parking Assignment
        if ($this->resident->activeParkingAssignment && $this->resident->activeParkingAssignment->isNotEmpty()) {
            foreach ($this->resident->activeParkingAssignment as $p) {
                $data[] = ['Field' => 'Parking Area - Lot', 'Value' => $p->parkingLot->parkingArea->area_code . ' - ' . $p->parkingLot->lot_number];
                $data[] = ['Field' => 'Parking Type', 'Value' => ucfirst($p->parkingLot->lot_type)];
                $data[] = ['Field' => 'Assigned At', 'Value' => $p->assigned_at->format('d M Y')];
            }
        }

        // Family Members
        foreach ($this->resident->familyMembers as $f) {
            $data[] = ['Field' => 'Family Member', 'Value' => $f->name];
            $data[] = ['Field' => 'Relationship', 'Value' => $f->relationship];
            $data[] = ['Field' => 'Gender', 'Value' => ucfirst($f->gender) ?? '-'];
            $data[] = ['Field' => 'Identity Number', 'Value' => $f->identity_number ?? '-'];
        }

        // Staff Members
        foreach ($this->resident->staffs as $s) {
            $data[] = ['Field' => 'Staff Member', 'Value' => $s->name];
            $data[] = ['Field' => 'Type', 'Value' => ucfirst($s->type)];
            $data[] = ['Field' => 'Phone', 'Value' => $s->phone ?? '-'];
            $data[] = ['Field' => 'License Plate', 'Value' => $s->license_plate ?? '-'];
        }

        return new Collection($data);
    }

    public function headings(): array
    {
        return [
            'Field',
            'Value'
        ];
    }

    public function title(): string
    {
        return 'Resident Detail';
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,  // Field
            'B' => 60,  // Value
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        $rowCount = $this->collection()->count() + 1;

        return [
            // Header style
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFFFF'],
                    'size' => 12,
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['argb' => '2980b9'], // Biru tua konsisten
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ],

            // Data rows
            "A2:B{$rowCount}" => [
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_HAIR,
                        'color' => ['argb' => 'CCCCCC'],
                    ],
                ],
            ],

            // Center align Field
            'A' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true,
                ],
            ],

            // Left align Value with wrap
            'B' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true,
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $resident = $this->resident;
                $lastRow = $this->collection()->count() + 1;

                // Row height
                for ($row = 2; $row <= $lastRow; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(30);
                }

                // Fixed width
                $sheet->getColumnDimension('A')->setAutoSize(false);
                $sheet->getColumnDimension('B')->setAutoSize(false);

                // Filter & freeze
                $sheet->setAutoFilter("A1:B1");
                $sheet->freezePane('A2');

                // Header report
                $sheet->insertNewRowBefore(1, 3);
                $sheet->mergeCells('A1:B1');
                $sheet->setCellValue('A1', "RESIDENT DETAIL REPORT");
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 18, 'color' => ['argb' => '2c3e50']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                $sheet->mergeCells('A2:B2');
                $status = $resident->is_owner ? 'Owner' : 'Leasee';
                $sheet->setCellValue('A2', "Name: {$resident->full_name} | Status: {$status} | Generated on: " . now()->format('d M Y, H:i'));
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => ['italic' => true, 'color' => ['argb' => '7f8c8d']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);
            },
        ];
    }
}