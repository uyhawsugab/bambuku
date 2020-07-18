<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesanan;
use App\Exports\TransaksiExport;
use App\Transaksi;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;


class TransaksiController extends Controller
{
    private function bayar(Request $request)
    {
        $transaksi = new Transaksi();
        $transaksi->id_pesanan = $request->input('id_pesanan');
        $transaksi->bayar = $request->input('bayar');
        $transaksi->save();

        return $transaksi->id;
    }

    private function total($id)
    {
        $pesanan = Pesanan::where('id', $id)->with('detail_pesanan')->first();
        $total = 0;

        foreach ($pesanan->detail_pesanan as $pesanan) {
            $total += $pesanan->barang->harga * $pesanan->jumlah;
        }

        return $total;
    }

    public function index()
    {
        $transaksi = Transaksi::with('pesanan')->get();
        return view('transaksi.index', compact('transaksi'));
    }

    public function viewBayar()
    {
        $pesanan = Pesanan::all();
        return view('Transaksi.bayar', compact('pesanan'));
    }

    public function validateBayar(Request $request)
    {
        $this->validate($request, [
            'id_pesanan' => 'required',
            'bayar' => 'required'
        ]);

        $total = $this->total($request->input('id_pesanan'));
        if ($request->input('bayar') < $total) {
            return redirect()->back()->with('transaksi_err' , 'Uang tidak cukup');
        }
        
        else {
            $transaksi_id = $this->bayar($request);
            return redirect()->route('transaksi.invoice', $transaksi_id);
        }
    }

    public function downloadInvo($id)
    {
        $transaksi = Transaksi::where('id', $id)->with('pesanan')->first();
        $invo = PDF::loadView('invoice.invo', compact('transaksi'))->setPaper('a4', 'landscape');
        return $invo->stream();
    }

    public function exportToExcel()
    {
        return Excel::download(new TransaksiExport, 'transaksi.xlsx');
    }
}
