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
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

use Config;

class ExportFile implements FromArray, WithHeadings, WithStyles, WithEvents, WithDrawings, ShouldAutoSize
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

    public function headings() :array {
        return [
            "STT", 
            "Mã tra cứu", 
            "Tên Người nhận (*)", 
            "Số ĐT Người nhận (*)", 
            "Địa chỉ nhận (*)",
            "Tên hàng hóa (*)",
            "Số lượng",
            "Trọng lượng (gram)",
            "Giá trị hàng (VND) (*)",
            "Tiền thu hộ COD (VND)",
            "Dịch vụ (*)",
            "Dịch vụ cộng thêm",
            "Thu tiền xem hàng",
            "Dài (cm)",
            "Rộng (cm)",
            "Cao (cm)",
            "Người trả cước",
            "Ghi chú",
            "Yêu cầu khác",
            "Thời gian giao",
        ];
    }
    
    public function styles(Worksheet $sheet)
    {
        $sheet->setCellValue('D2', 'TẬP ĐOÀN CÔNG NGHIỆP - VIỄN THÔNG QUÂN ĐỘI');
        $sheet->setCellValue('D3', 'TỔNG CÔNG TY CỔ PHẦN BƯU CHÍNH VIETTEL');
        $sheet->setCellValue('F5', 'DANH SÁCH ĐƠN HÀNG');   
        
        return [
            // Styling an entire column.
            'C'  => [
                'font' => ['size' => 16],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                ],
            ],
        ];
    }

    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class => function (AfterSheet $event) {
    //             $cellRange = 'A1:T1000';
    //             $event->sheet->getDelegate()
    //                 ->getStyle($cellRange)
    //                 ->getFont()->setName('Times New Roman')
    //                 ->setSize(10);   
    //         }
    //     ];
    // }

    public function registerEvents(): array
    {        
        $styleArray = [
            'font' => [
                'bold' => false,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
        ];

        $styleArray2 = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
            ],
        ];
        
        return [
            AfterSheet::class => function(AfterSheet $event) use ($styleArray)
            {
                $cellRange = 'A1:A500';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10)->setName("Times New Roman");
                $event->sheet->getStyle($cellRange)->ApplyFromArray($styleArray);
            },

            AfterSheet::class => function(AfterSheet $event) use ($styleArray2)
            {
                $cellRange = 'A3:T3';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10)->setName("Times New Roman");
                $event->sheet->getStyle($cellRange)->ApplyFromArray($styleArray2);
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

    
}
