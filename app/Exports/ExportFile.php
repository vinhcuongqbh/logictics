<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Config;

class ExportFile implements WithHeadingRow, FromArray, WithStyles, WithEvents, WithDrawings, WithColumnWidths, ShouldAutoSize
{
    use RegistersEventListeners;
    /**
     * @return \Illuminate\Support\Collection
     */

    public $points;

    public function __construct(array $points)
    {
        $this->points = $points;
    }

    public function array(): array
    {
        return $this->points[0]->points;
    }



    // public function headings(): array
    // {
    //     return [
    //         "STT",
    //         "Mã tra cứu",
    //         "Tên Người nhận (*)",
    //         "Số ĐT Người nhận (*)",
    //         "Địa chỉ nhận (*)",
    //         "Tên hàng hóa (*)",
    //         "Số lượng",
    //         "Trọng lượng (gram)",
    //         "Giá trị hàng (VND) (*)",
    //         "Tiền thu hộ COD (VND)",
    //         "Dịch vụ (*)",
    //         "Dịch vụ cộng thêm",
    //         "Thu tiền xem hàng",
    //         "Dài (cm)",
    //         "Rộng (cm)",
    //         "Cao (cm)",
    //         "Người trả cước",
    //         "Ghi chú",
    //         "Yêu cầu khác",
    //         "Thời gian giao",
    //     ];
    // }

    public function model(array $row)
    {
        return ;
    }
   

    public function styles(Worksheet $sheet)
    {
        $sheet->setCellValue('D2', 'TẬP ĐOÀN CÔNG NGHIỆP - VIỄN THÔNG QUÂN ĐỘI');
        $sheet->setCellValue('D3', 'TỔNG CÔNG TY CỔ PHẦN BƯU CHÍNH VIETTEL');
        $sheet->setCellValue('F5', 'DANH SÁCH ĐƠN HÀNG');   

        return [
            // Styling an entire column.            
            'A' => [
                'font' => ['name' => 'Times New Roman', 'size' => 10],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
            'B' => [
                'font' => ['name' => 'Times New Roman', 'size' => 10],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
            'D' => [
                'font' => ['name' => 'Times New Roman', 'size' => 10],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
            'G' => [
                'font' => ['name' => 'Times New Roman', 'size' => 10],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
            '7'  => [
                'font' => ['name' => 'Times New Roman', 'bold' => true, 'size' => 8],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
            ],
        ];
    }


    public function registerEvents(): array
    {
        $styleCenter = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'WrapText' => true,
            ],
        ];

        return [
            AfterSheet::class => function (AfterSheet $event) use ($styleCenter) {
                // $cellRange = 'A1:A500';
                // $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Times New Roman')->setSize(10);
                // $event->sheet->getStyle($cellRange)->ApplyFromArray($styleCenter);

                $event->sheet->getDelegate()->getParent()->getDefaultStyle()->getFont()->setName('Times New Roman')->setSize(10);

                $event->sheet->getDelegate()->getStyle('D2')->getFont()->setName('Times New Roman')->setSize(12)->setBold(true);
                $event->sheet->getStyle('D2')->getAlignment()->setHorizontal('left');
                $event->sheet->getDelegate()->getStyle('D3')->getFont()->setName('Times New Roman')->setSize(12)->setBold(true);
                $event->sheet->getStyle('D3')->getAlignment()->setHorizontal('left');
                $event->sheet->getDelegate()->getStyle('F5')->getFont()->setName('Times New Roman')->setSize(18)->setBold(true);
                $event->sheet->getDelegate()->getStyle('F5')->getFont()->getColor()->setRGB('385724');
                

                // $event->sheet->getStyle('A1:A500')->ApplyFromArray($styleCenter);
                // $event->sheet->getStyle('B1:B500')->ApplyFromArray($styleCenter);
                // $event->sheet->getStyle('D1:D500')->ApplyFromArray($styleCenter);

                $event->sheet->getStyle('A7:T7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('c5e0b4');
                $event->sheet->getDelegate()->getRowDimension('7')->setRowHeight(30);
                $event->sheet->getStyle('E')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('F')->getAlignment()->setWrapText(true);

                $event->sheet->getStyle('A7:T200')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
         ]);

                // foreach (range(1, 10) as $number) {
                //     $event->sheet->getStyle('A1:T'. $number)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                //     $event->sheet->getStyle('A1:T'. $number)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                //     $event->sheet->getStyle('A1:T'. $number)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                //     $event->sheet->getStyle('A1:T'. $number)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                // }                
            },
        ];
    }


    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/img/viettel.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('A1');

        return $drawing;
    }


    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 40,
            'F' => 20,
            'G' => 10,
            'H' => 10,
            'I' => 10,
            'J' => 10,
            'K' => 10,
            'L' => 10,
            'M' => 10,
            'N' => 10,
            'O' => 10,
            'P' => 10,
            'Q' => 10,
            'R' => 10,
            'S' => 10,
            'T' => 10,
        ];
    }
}
