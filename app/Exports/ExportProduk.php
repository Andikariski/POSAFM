<?php

namespace App\Exports;

use App\Models\Produk;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ExportProduk implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Produk::select('barcode_produk',
                              'nama_produk',
                              'stok_produk',
                              'harga_beli_produk',
                              'harga_jual_produk',
                              'margin',
                              'fkid_jenis_produk',
                              'fkid_tempat_produk',
                            )->orderBy('nama_produk','ASC')->get();
    }

    public function headings(): array
    {
        return ["KODE PRODUK",
                "NAMA PRODUK",
                "STOK PRODUK",
                "HARGA BELI",
                "HARGA JUAL",
                "MARGIN",
                "JENIS PRODUK",
                "TEMPAT PRODUK"];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1   => ['font' => [
                                'bold' => true,
                                'size' => 14]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 17,
            'B' => 30,            
            'C' => 17,            
            'D' => 15,            
            'E' => 15,            
            'F' => 12,            
            'G' => 17,            
            'H' => 20,            
        ];
    }
}
