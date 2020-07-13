<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $fillable = [
        'name','harga'
    ];

    public function jenisBarang()
    {
        return $this->hasOne('App\JenisBarang', 'id' , 'id_jenis_barang');
    }
}
