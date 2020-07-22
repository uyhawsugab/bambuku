<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JenisBarang;
use App\Barang;

class BarangController extends Controller
{
    private function store(Request $request)
    {
        $barang = new Barang();
        $barang->nama = $request->input('nama');
        $barang->harga = $request->input('harga');
        $barang->id_jenis_barang = $request->input('jenis_barang');
        $barang->save();
    }

    private function edit(Request $request, $id)
    {
        $barang = Barang::where('id', $id)->first();
        $barang->nama = $request->input('nama');
        $barang->harga = $request->input('harga');
        $barang->id_jenis_barang = $request->input('jenis_barang');
        $barang->status = $request->input('status');
        $barang->save();
    }

    private function delete(Request $request)
    {
        $barang = Barang::where('id' , $request->input('id'))->first();
        $barang->delete();
    }

    public function home()
    {
        $barang = Barang::with('jenisBarang')->get();
        return view('barang.index', compact('barang'));
    }

    public function vAdd()
    {
        $jenisBarang = JenisBarang::all();
        return view('barang.new', compact('jenisBarang'));
    }

    public function vEdit($id)
    {
        $barang =  Barang::where('id', $id)->with('jenisBarang')->first();
        $jenisBarang = JenisBarang::all();
        return view('barang.edit', compact('barang', 'jenisBarang'));
    }

    public function validateAdd(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
            'jenis_barang' => 'required',
        ]);

        $this->store($request);
        return redirect('/barang/index')->with('sukses', 'Berhasil Menambah Barang');
    }

    public function validateEdit(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required|numeric',
            'jenis_barang' => 'required|numeric',
            'status' => 'required'
        ]);

        $this->edit($request, $id);
        return redirect('/barang/index')->with('sukses', 'Berhasil mengubah data menu!');
    }

    public function validateDelete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $this->delete($request);
        return redirect()->back()->with('sukses', 'Berhasil menghapus barang!');
    }

    public function getWithJson($id)
    {
        $menu = Barang::where('id', $id)->with('jenisBarang')->first();
        return response()->json($menu);
    }



}
