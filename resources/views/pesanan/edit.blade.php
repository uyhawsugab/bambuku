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

                <form action="{{ url('/pesanan/update', $pesanan->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="">Nama Pembeli</label>
                    <input type="text" name="nama_pembeli" id="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea name="alamat" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" id="" class="form-control">
                    <option value="">Pilih Status Barang</option>
                    <option value="Dalam proses" {{ $pesanan->status == \App\Pesanan::PROSES ? "selected":"" }}>Dalam proses</option>
                @if ($status_detail == true)
                    <option value="Selesai" {{ $pesanan->status == \App\Pesanan::SELESAI ? "selected":"" }}>Selesai</option>
                @endif
                    </select>
                </div>
                <input type="submit" value="Ubah" class="btn btn-primary">
                </form>

            </div>
        </div>
    </div>
</div>
@endsection