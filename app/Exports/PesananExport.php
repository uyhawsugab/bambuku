<?php

namespace App\Exports;

use App\Pesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class PesananExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pesanan::with('detail_pesanan')->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama Pelanggan',
            'Alamat',
            'Barang yang dibeli',
            'Jumlah',
            'Created at',
            'Updated at',
        ];
    }

    public function map($pesanan): array
    {
        return[
            $pesanan->id,
            $pesanan->nama_pelanggan,
            $pesanan->alamat,
            $pesanan->detail_pesanan->map(function ($detail) {
                return $detail->barang->nama;
            }),
            $pesanan->detail_pesanan->jumlah,
            $pesanan->created_at,
            $pesanan->updated_at,
        ];
    }
}
