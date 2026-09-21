<?php

namespace App\Http\Controllers;

use App\Exports\activiteitenExport;
use Maatwebsite\Excel\Facades\Excel;


class ExcelController extends Controller
{
    public function index()
    {

        return Excel::download(new activiteitenExport, 'test.xlsx');
    }
}
