@extends('template')
@section('main-content')
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    Edit Daftar Barang
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('/barang/update', $barang->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="">Nama Barang</label>
                    <input type="text" name="nama" id="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Harga Barang</label>
                    <input type="number" name="harga" id="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Jenis Barang</label>
                    <select name="jenis_barang" id="" class="form-control">
                    <option value="">Pilih Jenis Barang</option>
                        @foreach ($jenisBarang as $jenis)
                            <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" id="" class="form-control">
                    <option value="">Pilih Status Barang</option>
                    <option value="Tersedia" {{ $barang->status == "Tersedia" ? "selected":"" }}>Tersedia</option>
                    <option value="Tidak Tersedia" {{ $barang->status == "Tidak Tersedia" ? "selected":"" }}>Tidak Tersedia</option>
                    </select>
                </div>
                <input type="submit" value="Tambahkan" class="btn btn-primary">
                </form>

            </div>
        </div>
    </div>
</div>
@endsection