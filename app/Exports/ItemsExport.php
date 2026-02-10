<?php
namespace App\Exports;

use App\Models\MasterItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ItemsExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return MasterItem::with('categories')->get();
    }

    public function map($item): array
    {
        static $number = 0;
        $number++;
        return [
            $number,
            $item->nama,
            $item->categories->pluck('name')->implode(', '),
            $item->supplier,
            $item->harga_beli,
            $item->laba,
            ceil(($item->harga_beli*(100+$item->laba))/100)
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Kategori',
            'Nama Items',
            'Nama Supplier',
            'Harga',
            'Laba',
            'Harga Jual'
        ];
    }
}