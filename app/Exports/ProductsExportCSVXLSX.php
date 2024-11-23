<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithStyles;

// class ProductsExportCSVXLSX implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         //
//     }
// }

class ProductsExportCSVXLSX implements FromArray, WithHeadings, WithTitle, WithCustomStartCell, WithStyles
{
    private $shopName;

    public function __construct()
    {
        $this->shopName = 'Circuits'; // Filter by shop name
    }

    public function array(): array
    {
        // Fetch products from the shop 'Circuits'
        return Product::with(['category', 'status', 'visibility', 'shop'])
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
            })
            ->toArray();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Price',
            'Supplier Price',
            'Category',
            'Available Stocks',
            'Visibility',
            'Status',
            'Stock Level',
        ];
    }

     public function title(): string
    {
        return 'Products';
    }

    public function startCell(): string
    {
        return 'A5';
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->setCellValue('A1', 'Products');
        $sheet->setCellValue('A2', "Shop: {$this->shopName}");
        $sheet->setCellValue('A3', 'Date: ' . Carbon::now()->toDateString());

        $sheet->mergeCells('A1:J1');
        $sheet->mergeCells('A2:J2');
        $sheet->mergeCells('A3:J3');

        $sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true);
        $sheet->getStyle('A2:A3')->getFont()->setSize(12);

        return [
            'A5:J5' => ['font' => ['bold' => true]],
        ];
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
