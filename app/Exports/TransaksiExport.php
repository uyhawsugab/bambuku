<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Transaksi;

class TransaksiExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Transaksi::with('pesanan')->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Nomor Pesanan',
            'Nama Pelanggan',
            'Total',
            'Bayar',
            'Kembalian',
            'Created at',
            'Updated at'
        ];
    }

    public function map($transaksi): array
    {
        $total = 0;
    }
}
