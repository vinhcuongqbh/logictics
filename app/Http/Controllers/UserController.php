<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportFile;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function export() 
    {
        $point = [
            [1, 2, 3],
            [2, 5, 9]
        ];

        $data = (object) array(
                'points' => $point,
            );
            
        $export = new ExportFile([$data]);
        return Excel::download($export, "abc.xlsx");
    }
}
