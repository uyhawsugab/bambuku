<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $table = 'detail_pesanan';
    protected $fillable = [
        'id_pesanan' , 'id_barang' , 'jumlah'
    ];

    const Dipesan = 'Dipesan';
    const Diantar = 'Sedang diantar';
    const Sudah = 'Sudah diantar';


    public function barang()
    {
        return $this->hasOne('App\Barang', 'id' , 'id_barang');
    }
}
