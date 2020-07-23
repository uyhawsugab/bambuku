@extends('template')
@section('main-content')
   <body>
    <div class="row">
        <div class="col-12">
            @if (Session::has('detail_succ'))
            <div class="alert alert-success mb-4" role="alert">
                <strong>{{ Session::get('detail_succ') }}</strong>
            </div>
            @endif
            <p class="mb-2">Berisi menu-menu yang dipesan meja nomer <b>{{ $detail_pesan->nama_pembeli }}</b> di tanggal <b>{{ $detail_pesan->created_at }}</b></p>
            <a href="{{ url('/pesanan/index') }}" class="btn btn-info">Kembali ke pesanan</a>
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="card-title">Detail Pesanan  
                        @if ( \App\Transaksi::where('id_pesanan', $detail_pesan->id)->exists() )
                            <a href="" class="btn btn-success disabled" style="float: right">Tambah</a>
                        @else
                            <a href="{{ route('detail.vstore', $detail_pesan->id) }}" class="btn btn-success mb-4" style="float: right">Tambah</a>
                        @endif</h4>
                    </div>
                    <div class="table-responsive">
                        <table id="multi_col_order"
                            class="table table-striped table-bordered display no-wrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($detail_pesan->detail_pesanan as $detail)
                                <tr>
                                    <td>{{ $detail->id }}</td>
                                    <td>{{ $detail->barang->nama }}</td>
                                    <td>{{ $detail->jumlah }}</td>
                                    <td>{{ $detail->barang->harga * $detail->jumlah }}</td>
                                    <td>{{ $detail->status }}</td>
                                    <td>
                                    @if (\App\Transaksi::where('id_pesanan', $detail_pesan->id)->exists())
                                        <a href="" class="btn btn-default disabled">Ubah</a>
                                        <a href="" class="btn btn-danger disabled">Hapus</a>
                                    @else
                                        <a href="{{ route('detail.vedit', [$detail_pesan->id, $detail->id]) }}" class="btn btn-default">Ubah</a>
                                        <a href="" data-target="#modelId" data-toggle="modal" onclick="prepare({{ $detail->id }})" class="btn btn-danger">Hapus</a>
                                    @endif
                                    </td>
                                </tr>
                                @php
                                    $total += $detail->barang->harga * $detail->jumlah
                                @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">Total</td>
                                    <td>{{ $total }}</td>
                                </tr>
                            </tfoot>
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
                        <h5 class="modal-title">Konfirmasi Hapus Menu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <form action="{{ url('pesanan/detail/delete') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="id" id="detailid" readonly>
                        <div class="modal-body">
                            Apakah anda yakin ingin menghapus pemesanan <b><span id="nama"></span></b>? Aksi ini tidak dapat di-<i>undo</i>
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
        function prepare(detailId) {
            var siteUrl = "{{ url('/pesanan/detail/json', 'id') }}"
            siteUrl = siteUrl.replace('id', detailId)

            $.getJSON(siteUrl, function (data) {
                $('#detailid').val(data.id)
                $('#nama').text(data.menu.nama)
            })
        }
</script> 
@endsection
