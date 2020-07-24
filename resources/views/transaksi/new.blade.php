@extends('template')
@section('main-content')
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    Tambah Transaki
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                        </ul>
                    </div>
                @elseif(Session::has('transaksi_err'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ Session::get('transaksi_err') }}</strong>
                    </div>
                @endif

                <form action="{{ url('/transaksi/bayar') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="">Nomor Pesanan</label>
                    <select name="id_pesanan" id="pesanan" class="form-control" onchange="prepare()">
                        <option value="">-- Nomor Pesanan --</option>
                        @foreach ($pesanan as $psn)
                            @if ($psn->status == \App\Pesanan::PROSES)
                                @if (!\App\Transaksi::where('id_pesanan', $psn->id)->exists())
                                    <option value="{{ $psn->id }}">Nomor Pesanan : {{ $psn->id }}, Nama Pembeli : {{ $psn->nama_pembeli }}, Waktu : {{ $psn->created_at }}</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Total</label>
                  <input type="text" name="total" id="total" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="">Bayar</label>
                    <input type="number" name="bayar" class="form-control">
                </div>
                <input type="submit" value="Bayar" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
<script>
        function prepare() {
            var idPesanan = $('#pesanan').val()
            var siteUrl = "{{ url('/pesanan/total', 'id') }}"
            siteUrl = siteUrl.replace('id', idPesanan)

            $.getJSON(siteUrl, function (data) {
                $('#total').val(data)
            })
        }
    </script>
@endsection