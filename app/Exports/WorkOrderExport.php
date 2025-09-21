<?php

namespace App\Exports;

use App\Models\WorkOrder;
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

class WorkOrderExport implements FromCollection, WithHeadings, WithStyles, WithTitle, WithColumnWidths
{
    protected $workOrders;
    protected $filterDate;

    public function __construct($workOrders, $filterDate = null)
    {
        $this->workOrders = $workOrders;
        $this->filterDate = $filterDate;
    }

    public function collection()
    {
        $data = [];

        foreach ($this->workOrders as $wo) {
            $data[] = [
                'No' => count($data) + 1,
                'WO Number' => $wo->wo_no,
                'Tower' => $wo->tower?->name ?? '-',
                'Unit' => $wo->unit?->unit_code ?? '-',
                'Work Description' => strip_tags($wo->work_description),
                'Status' => $wo->status,
                'Schedule Date' => $wo->schedule_date->format('d M Y'),
                'Time Schedule' => $wo->time_schedule ?? '-',
                'Assignee' => $wo->assignee ?? 'Unassigned',
                'Created At' => $wo->created_at->format('d M Y, H:i'),
            ];
        }

        return new Collection($data);
    }

    public function headings(): array
    {
        return [
            'No',
            'WO Number',
            'Tower',
            'Unit',
            'Work Description',
            'Status',
            'Schedule Date',
            'Time Schedule',
            'Assignee',
            'Created At',
        ];
    }

    public function title(): string
    {
        return 'Work Orders';
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,   // No
            'B' => 16,  // WO Number
            'C' => 14,  // Tower
            'D' => 14,  // Unit
            'E' => 45,  // Work Description
            'F' => 15,  // Status
            'G' => 16,  // Schedule Date
            'H' => 14,  // Time Schedule
            'I' => 20,  // Assignee
            'J' => 18,  // Created At
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        $rowCount = $this->workOrders->count() + 1; // header + data rows

        return [
            // Header row style
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFFFF'],
                    'size' => 12,
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['argb' => '2980b9'], // Biru tua profesional
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
            "A2:J{$rowCount}" => [
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

            // Center align
            'A' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'B' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'C' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'D' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'F' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'G' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'H' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'J' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],

            // Left align with wrap text
            'E' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true,
                ],
            ],
            'I' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $workOrders = $this->workOrders;
                $lastRow = $workOrders->count() + 1;

                // Set row height minimum for readability
                for ($row = 2; $row <= $lastRow; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(30);
                }

                // Disable auto size → use fixed widths from columnWidths
                foreach (range('A', 'J') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(false);
                }

                // Add filter on header
                $sheet->setAutoFilter("A1:J1");

                // Freeze header row
                $sheet->freezePane('A2');

                // Insert 3 rows before data
                $sheet->insertNewRowBefore(1, 3);

                // Judul laporan
                $sheet->mergeCells('A1:J1');
                $title = $this->filterDate
                    ? "WORK ORDER REPORT - {$this->filterDate}"
                    : "WORK ORDER REPORT";
                $sheet->setCellValue('A1', strtoupper($title));
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 18, 'color' => ['argb' => '2c3e50']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                // Info tambahan
                $sheet->mergeCells('A2:J2');
                $info = $this->filterDate
                    ? "Date Filter: {$this->filterDate} | Generated on: " . now()->format('d M Y, H:i')
                    : "Generated on: " . now()->format('d M Y, H:i');
                $sheet->setCellValue('A2', $info);
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => ['italic' => true, 'color' => ['argb' => '7f8c8d']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);
            },
        ];
    }
}
