<?php

use Illuminate\Database\Seeder;
use App\JenisBarang;

class JenisBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisBarang::create(['nama' => 'Semen']);
        JenisBarang::create(['nama' => 'Paku']);
        JenisBarang::create(['nama' => 'Gembok']);
        JenisBarang::create(['nama' => 'Lem']);
        JenisBarang::create(['nama' => 'Cat Tembok']);
    }
}
