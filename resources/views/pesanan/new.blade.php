@extends('template')
@section('main-content')
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    Tambah Pesanan
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

                <form action="{{ url('/pesanan/new') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="">Nama Pembeli</label>
                    <input type="text" name="nama_pembeli" id="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea name="alamat" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <input type="submit" value="Tambahkan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection