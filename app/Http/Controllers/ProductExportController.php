<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Exports\ProductsExportCSVXLSX;
use Maatwebsite\Excel\Facades\Excel;

class ProductExportController extends Controller
{
    public function exportCSV()
    {
        return Excel::download(new ProductsExportCSVXLSX, 'products.csv');
    }

    public function exportXLSX()
    {
        return Excel::download(new ProductsExportCSVXLSX, 'products.xlsx');
    }

    public function exportPDF()
    {
        return (new ProductsExport())->exportPDF();
    }
}
