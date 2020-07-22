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
                        <h4 class="card-title">Daftar Barang  <a href={{ url('barang/new') }} class="btn btn-success btn-sm" style="float: right; margin-bottom:10px">Tambah</a></h4>
                    </div>
                    <div class="table-responsive">
                        <table id="multi_col_order"
                            class="table table-striped table-bordered display no-wrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Jenis Barang</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barang as $brg)
                                <tr>
                                    <td>{{ $brg->id }}</td>
                                    <td>{{ $brg->nama }}</td>
                                    <td>{{ $brg->harga }}</td>
                                    <td>{{ $brg->jenisBarang->nama }}</td>
                                    <td>{{ $brg->status }}</td>
                                    <td>
                                        <a href="{{ url('/barang/update', $brg->id) }}" class="btn btn-default">Ubah</a>
                                            <a href="" class="btn btn-danger" data-toggle="modal" data-target="#modelId" onclick="prepare({{ $brg->id }})">Hapus</a>
                                    </td>
                                </tr>
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
                    <h5 class="modal-title">Konfirmasi Hapus Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form action="{{ url('/barang/delete') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="id" id="barangid" readonly>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus <b><span id="jenis"></span></b>: <b><span id="nama"></span></b>? Aksi ini tidak dapat di-<i>undo</i>
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
  function prepare(barangId) {
            var idBarang = barangId
            var siteUrl = "{{ url('/barang/json', 'id') }}"
            siteUrl = siteUrl.replace('id', idBarang)

            $.getJSON(siteUrl, function (data) {
                $('#barangid').val(data.id)
                $('#jenis').text(data.jenis_barang.nama)
                $('#nama').text(data.nama)
            })
        }
</script>
@endsection