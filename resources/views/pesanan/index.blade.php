@extends('template')
@section('main-content')

<body>
    <div class="row">
        <div class="col-12">
            @if (Session::has('sukses'))
            <div class="alert alert-success mb-4" role="alert">
                <strong>{{ Session::get('sukses') }}</strong>
            </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="card-title">Daftar Pesanan  <a href={{ url('pesanan/new') }} class="btn btn-success btn-sm" style="float: right; margin-bottom:10px">Tambah</a></h4>
                    </div>
                    <div class="table-responsive">
                        <table id="multi_col_order"
                            class="table table-striped table-bordered display no-wrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Pembeli</th>
                                    <th>Alamat</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($pesanans as $pesanan)
                                    @foreach ($pesanan->detail_pesanan as $detail)
                                        @php
                                            $total += $detail->barang->harga * $detail->jumlah
                                        @endphp
                                    @endforeach
                                <tr>
                                    <td>{{ $pesanan->id }}</td>
                                    <td>{{ $pesanan->nama_pembeli }}</td>
                                    <td>{{ $pesanan->alamat }}</td>
                                    <td>{{ $total }}</td>
                                    <td>{{ $pesanan->status }}</td>
                                    <td>
                                        @if (!\App\Transaksi::where('id_pesanan', $pesanan->id)->exists())
                                            <a href="{{ url('/pesanan/update', $pesanan->id) }}" class="btn btn-default">Ubah</a>
                                            <a href="" class="btn btn-danger" data-toggle="modal" data-target="#modelId" onclick="prepare({{ $pesanan->id }})">Hapus</a>
                                        @else
                                            <a href="" class="btn btn-info disabled">Ubah</a>
                                            <a href="" class="btn btn-danger disabled">Hapus</a>
                                        @endif
                                        <a href="{{ route('detail.index', $pesanan->id) }}" class="btn btn-info">Detail</a>
                                    </td>
                                </tr>
                                @php
                                    $total = 0;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus Pelanggan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form action="{{ url('/pesanan/delete') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="id" id="pesananid" readonly>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus data pesanan: <b><span id="nomerpesanan"></span></b>? Aksi ini tidak dapat di-<i>undo</i>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <input type="submit" value="Hapus" class="btn btn-danger">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
 function prepare(pesananId) {
            var idPesanan = pesananId
            var siteUrl = "{{ url('/pesanan/json', 'id') }}"
            siteUrl = siteUrl.replace('id', idPesanan)

            $.getJSON(siteUrl, function (data) {
                $('#pesananid').val(data.id)
                $('#nomerpesanan').text(data.id)
            })
        }
</script>
@endsection