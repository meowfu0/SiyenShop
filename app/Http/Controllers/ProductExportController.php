<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductExportController extends Controller
{
    public function exportCSV()
    {
        return Excel::download(new ProductsExport, 'products.csv');
    }

    public function exportXLSX()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function exportPDF()
    {
        return Excel::download(new ProductsExport, 'products.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }
}
