<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailPesanan;
use App\Pesanan;
use App\Barang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class DetailPesananController extends Controller
{
    private function store(Request $request , $id_pesanan)
    {
        $detail = [
            'id_pesanan' => $id_pesanan,
            'id_barang' => $request->input('id_barang'),
            'jumlah' => $request->input('jumlah'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        Session::push('detail', $detail);
    }

    private function edit(Request $request, $id)
    {
        $detail = DetailPesanan::where('id' , $id)->first();
        $detail->id_barang = $request->input('id_barang');
        $detail->jumlah = $request->input('jumlah');
        $detail->status = $request->input('status');
        $detail->save();
    }
}
