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

        foreach($transaksi->pesanan->detail_pesanan as $detail) {
            $total += $detail->barang->harga * $detail->jumlah;
        }

        return [
            $transaksi->id,
            $transaksi->id_pesanan,
            $transaksi->pesanan->nama_pembeli,
            $total,
            $transaksi->bayar,
            $transaksi->bayar - $total,
            $transaksi->created_at,
            $transaksi->updated_at
        ];
    }
}
