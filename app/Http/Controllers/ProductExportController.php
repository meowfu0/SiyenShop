<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Exports\ProductsExportCSVXLSX;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Product;
use Illuminate\Support\Carbon;

class ProductExportController extends Controller
{
    private $shopName;

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

    public function __construct()
    {
        $this->shopName = 'Circuits'; // Filter by shop name
    }

    public function printProducts()
    {
        
        $products = Product::with(['category', 'status', 'visibility', 'shop'])
            ->whereHas('shop', function ($query) {
                $query->where('shop_name', $this->shopName);
            })
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'product_name' => $product->product_name,
                    'retail_price' => $product->retail_price,
                    'supplier_price' => $product->supplier_price,
                    'category_name' => $product->category->category_name ?? 'N/A',
                    'stocks' => $product->stocks,
                    'visibility_name' => $product->visibility->visibility_name ?? 'N/A',
                    'status_name' => $product->status->status_name ?? 'N/A',
                    'stock_level' => $this->getStockLevel($product->stocks),
                ];
            });

            return view('printlayout.printProduct', [
                'shop_name' => $this->shopName,
                'date' => Carbon::now()->toFormattedDateString(),
                'products' => $products,
            ]);
    }
    private function getStockLevel($stocks)
    {
        if ($stocks == 0) {
            return 'No Stock';
        } elseif ($stocks <= 10) {
            return 'Low Stock';
        } else {
            return 'In Stock';
        }
    }
}
