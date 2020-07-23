@extends('template')
@section('main-content')
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    Tambah Detail Pesanan
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

                <form action="{{ route('detail.store') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="">Nama Barang</label>
                    <select name="id_barang" id="" class="form-control">
                        <option value="">-- Pilih barang --</option>
                        @foreach ($barang as $brg)
                            <option value="{{ $brg->id }}">{{ $brg->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Jumlah</label>
                    <input type="number" name="jumlah" id="" class="form-control">
                </div>
                <input type="submit" value="Tambahkan" class="btn btn-primary">
                </form>
                @if (Session::has('detail'))
                    <form action="{{ route('detail.insert', $id_pesanan) }}" method="post">
                        {{ csrf_field() }}
                        <input type="submit" value="Simpan {{ '('. count(Session::get('detail')) .')' }}" class="btn btn-success">
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection