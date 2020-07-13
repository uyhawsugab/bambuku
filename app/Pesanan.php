<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = "pesanan";
    protected $fillable = [
        'nama_pembeli', 'alamat'
    ];

    const Proses = 'Dalam Proses';
    const Selesai = 'Selesai';


    public function detail_pesanan()
    {
        return $this->hasMany('App\DetailPesanan', 'id_pesanan' , 'id');
    }
}
