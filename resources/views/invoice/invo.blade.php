<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Atas Nama {{ $transaksi->pesanan->nama_pembeli }} | {{ $transaksi->created_at }}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <style>
        #container {
            width: 700px;
            height: fit-content;
            margin: 0 auto;
        }

        .td-title {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="container">
        <h3 class="text-center mb-2 mt-4">Nota Pembayaran</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="2">Invoice #{{ $transaksi->id }}</th>
                    <th>Nama Pelanggan {{ $transaksi->pesanan->nama_pembeli }}</th>
                    <th>{{ $transaksi->created_at }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="td-title">Nama Barang</td>
                    <td class="td-title">Harga</td>
                    <td class="td-title">Jumlah</td>
                    <td class="td-title">Subtotal</td>
                </tr>
                @php
                    $total = 0;
                @endphp
                @foreach ($transaksi->pesanan->detail_pesanan as $detail)
                    <tr>
                        <td>{{ $detail->barang->nama }}</td>
                        <td>{{ $detail->barang->harga }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>{{ $detail->barang->harga * $detail->jumlah }}</td>
                    </tr>
                    @php
                        $total += $detail->barang->harga * $detail->jumlah
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="td-title">Total</td>
                    <td>{{ $total }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="td-title">Bayar</td>
                    <td>{{ $transaksi->bayar }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="td-title">Kembali</td>
                    <td>{{ $transaksi->bayar - $total }}</td>
                </tr>
            </tfoot>
        </table>
    </div> 
</body>
<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</html>