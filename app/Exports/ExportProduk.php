<?php

namespace App\Exports;

use App\Models\Produk;

use Maatwebsite\Excel\Concerns\FromCollection;

class ExportProduk implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Produk::all();
    }
}
