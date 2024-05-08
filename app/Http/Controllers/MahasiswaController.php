<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mahasiswa;
class MahasiswaController extends Controller
{
    //
    public function cekObject(){
        $mahasiswa = new mahasiswa();
        dump($mahasiswa);
    }

    public function insert(){
        $mahasiswa = new Mahasiswa();
        $mahasiswa -> nim = '19003036';
        $mahasiswa -> nama = 'sabardian';
        $mahasiswa -> tanggal_lahir = '2001-12-31';
        $mahasiswa -> ipk = 3.5;
        $mahasiswa ->save();

        dump($mahasiswa);
    }

    public function massAssignment(){
        $mahasiswa = mahasiswa::create(
            [
                'nim' => '19021029',
                'nama' => 'Rudi Permana',
                'tanggal_lahir' => '2000-08-22',
                'ipk' => 2.5
            ],
            [
                'nim' => '19021309',
                'nama' => 'Rudi Permana',
                'tanggal_lahir' => '2000-08-22',
                'ipk' => 2.5
            ],
            [
                'nim' => '19042109',
                'nama' => 'Rudi Permana',
                'tanggal_lahir' => '2000-08-22',
                'ipk' => 2.5
            ]
        );
        dump($mahasiswa);
    }
}
