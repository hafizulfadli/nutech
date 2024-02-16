<?php

namespace App\Exports;

use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProdukExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
{
    return [
        'Nama Produk',
        'Harga Beli',
        'Harga Jual',
        'Stok',
        'Nama Kategori'
    ];
}

public function collection()
{
    return DB::table('produks')
            ->select('produks.nama_produk', 'produks.harga_beli', 'produks.harga_jual', 'produks.stok', 'kategoris.nama_kategori')
            ->join('kategoris', 'kategoris.id', '=', 'produks.id_kategori')
            ->get();
}
}
