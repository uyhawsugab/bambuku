<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesanan;
use App\Exports\PesananExport;
use App\DetailPesanan;
use Maatwebsite\Excel\Facades\Excel;

class PesananController extends Controller
{
    private function store(Request $request)
    {
        $pesanan = new Pesanan();
        $pesanan->nama_pembeli = $request->input('nama_pembeli');
        $pesanan->alamat = $request->input('alamat');
        $pesanan->save();

    }

    private function edit(Request $request, $id)
    {
        $pesanan = Pesanan::where('id', $id)->first();
        $pesanan->nama_pembeli = $request->input('nama_pembeli');
        $pesanan->alamat = $request->input('alamat');
        $pesanan->status = $request->input('status');
        $pesanan->save();
    }

    private function delete(Request $request)
    {
        $pesanan = Pesanan::where('id', $request->input('id'))->first();
        $pesanan->delete();
    }

    private function statusDetailState($id_pesanan)
    {
        $detail = DetailPesanan::where('id_pesanan', $id_pesanan)->get()->groupBy('status');

        if(!isset($detail['Dipesan']) && !isset($detail['Sedang diantar']))
        {
            return true;
        }else {
            return false;
        }
    }

    public function index()
    {
        $pesanans = Pesanan::with('user', 'detail_pesanan')->get();
        return view('pesanan.index', compact('pesanans'));
    }

    public function vStore()
    {
        return view('pesanan.store');
    }

    public function vEdit($id)
    {
        $pesanan = Pesanan::where('id', $id)->first();
        $status_detail = $this->statusDetailState($id);

        return view('pesanan.edit', compact('pesanan', 'status_detail'));
    }

    public function getDataWithJSON($id)
    {
        $pesanan = Pesanan::where('id', $id)->with('detail_pesanan')->first();
        return response()->json($pesanan, 200);
    }

    public function getTotal($id)
    {
        $pesanan = Pesanan::where('id', $id)->with('detail_pesanan')->first();
        $total = 0;

        foreach ($pesanan->detail_pesanan as $detail) {
            $total += $detail->barang->harga * $detail->jumlah;
        }

        return response()->json($total);
    }

    public function validateStore(Request $request)
    {
        $this->validate($request, [
            'nama_pelanggan' => 'required',
            'alamat' => 'required'
        ]);

        $id_pesanan = $this->store($request);
        return redirect()->route('detail.index', $id_pesanan);
    }

    public function validateEdit(Request $request , $id)
    {
        $this->validate($request, [
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'status' => 'required'
        ]);

        $this->edit($request, $id);
        return redirect('/pesanan/index')->with('pesanan_succ', 'Berhasil mengubah data');
    }

    public function validateDelete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $this->delete($request);
        return redirect('/pesanan/index')->with('pesanan_succ', 'Berhasil menghapus data');
    }

    public function exportToExcel()
    {
        return Excel::download(new PesananExport, 'Pesanan.xlsx');
    }
}
