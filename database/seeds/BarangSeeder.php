<?php

use Illuminate\Database\Seeder;
use App\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Barang::create([
            'nama' => 'Nippon Paint',
            'harga' => '40000',
            'id_jenis_barang' => 5,
            'status' => 'Tersedia'
        ]);

        Barang::create([
            'nama' => 'Semen 3 Roda',
            'harga' => '50000',
            'id_jenis_barang' => 1,
            'status' => 'Tersedia'
        ]);

        Barang::create([
            'nama' => 'Avitex',
            'harga' => '45000',
            'id_jenis_barang' => 5,
            'status' => 'Tersedia'
        ]);

        Barang::create([
            'nama' => 'Semen Gresik',
            'harga' => '40000',
            'id_jenis_barang' => 1,
            'status' => 'Tersedia'
        ]);

        Barang::create([
            'nama' => 'Mitsui Gembok Baja',
            'harga' => '67000',
            'id_jenis_barang' => 3,
            'status' => 'Tersedia'
        ]);

        Barang::create([
            'nama' => 'Gembok BETOX Baja',
            'harga' => '54000',
            'id_jenis_barang' => 3,
            'status' => 'Tersedia'
        ]);

        Barang::create([
            'nama' => 'Paku Kayu',
            'harga' => '5000',
            'id_jenis_barang' => 2,
            'status' => 'Tersedia'
        ]);

        Barang::create([
            'nama' => 'Lem Rajawali',
            'harga' => '19000',
            'id_jenis_barang' => 4,
            'status' => 'Tersedia'
        ]);

        Barang::create([
            'nama' => 'Lem Ge',
            'harga' => '12000',
            'id_jenis_barang' => 4,
            'status' => 'Tersedia'
        ]);
    }
}
