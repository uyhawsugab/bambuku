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

    private function delete(Request $request)
    {
        $detail = DetailPesanan::where('id', $request->input('id'))->first();
        $detail->delete();
    }

    public function index($id_pesanan)
    {
        $detail_pesanan = Pesanan::where('id', $id_pesanan)->with('detail_pesanan')->first();
        return view('detail.index', compact('detail_pesanan' , 'id_pesanan'));
    }

    public function vStore($id_pesanan)
    {
        $barang = Barang::where('status' , 'Tersedia')->get();
        return view('detail.store', compact('barang', 'id_pesanan'));
    }

    public function vEdit($id_pesanan, $id)
    {
        $detail = DetailPesanan::where('id', $id)->with('barang')->first();
        $barang = Barang::where('status', 'Tersedia')->get();
        return view('detail.edit', compact('detail', 'barang', 'id_pesanan'));
    }

    public function validateStore(Request $request, $id_pesanan)
    {
        $this->validate($request, [
            'id_barang' => 'required',
            'jumlah' => 'required|numeric'
        ]);

        $this->store($request, $id_pesanan);
        return redirect()->back();
    }

    public function massInsert($id_pesanan)
    {
        DetailPesanan::insert(Session::get('detail'));
        $jmlh_detail = count(Session::get('detail'));

        Session::forget('detail');
        return redirect()->route('detail.index', $id_pesanan)->with('detail_succ', 'Berhasil menambah' . $jmlh_detail . 'item detail pesanan!');
    }

    public function validateEdit(Request $request, $id, $id_pesanan)
    {
        $this->validate($request, [
            'id_barang' => 'required',
            'jumlah' => 'required',
            'status' => 'required'
        ]);

        $this->edit($request, $id);
        return redirect()->route('detail.index', $id_pesanan)->with('detail_succ', 'Berhasil mengubah data');
    }

    public function validateDelete(Request $request)
    {
        $this->validate($request, [
            'id' =>'required'
        ]);

        $this->delete($request);
        return redirect()->back()->with('detail_succ', 'Berhasil menghapus data');
    }

    public function getDataWithJSON($id)
    {
        $detail = DetailPesanan::where('id', $id)->with('barang')->first();
        return response()->json($detail);
    }
}
