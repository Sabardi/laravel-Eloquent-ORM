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
                'nim' => '1902219',
                'nama' => 'Rudi Permana',
                'tanggal_lahir' => '2000-08-22',
                'ipk' => 2.5
            ],
        );

        $mahasiswa = mahasiswa::create(

            [
                'nim' => '1902109',
                'nama' => 'Rudi Permana',
                'tanggal_lahir' => '2000-08-22',
                'ipk' => 2.5
            ]
        );

        $mahasiswa = mahasiswa::create(

            [
                'nim' => '1909',
                'nama' => 'Rudi Permana',
                'tanggal_lahir' => '2000-08-22',
                'ipk' => 2.5
            ]
        );
        dump($mahasiswa);
    }

    public function update(){
        $mahasiswa = mahasiswa::find(1);
        $mahasiswa -> nama = 'sabardibaharudin';
        $mahasiswa -> nim = '19003036';
        $mahasiswa->tanggal_lahir = '2002-01-01';
        $mahasiswa->ipk = 2.9;
        $mahasiswa ->save();

        dump($mahasiswa);
    }

    public function massUpdate(){
        mahasiswa::where('nim','19003036')->first()->update([
        'tanggal_lahir' =>'2000-04-20',
        'ipk' => 2.1
        ]);
        return "Berhasil di proses";
    }

    public function delete(){
        $mahasiswa = mahasiswa::find(3);
        $mahasiswa ->delete();
        dump($mahasiswa);
    }

    public function destroy(){
        $mahasiswa = mahasiswa::destroy(3);
        dump($mahasiswa);
    }

    public function massDelete(){
        $mahasiswa = mahasiswa::where('ipk', '>', 2)->delete();
        dump($mahasiswa);
    }

    public function all(){
        $mahasiswa = mahasiswa::all();
        foreach ($mahasiswa as $mahasiswa) {
            echo($mahasiswa->id). '<br>';
            echo($mahasiswa->nim). '<br>';
            echo($mahasiswa->nama). '<br>';
            echo($mahasiswa->tanggal_lahir). '<br>';
            echo($mahasiswa->ipk). '<br>';
            echo "<hr>";
        }
    }

    public function allView(){
        $mahasiswas = mahasiswa::all();
        return view('index', compact('mahasiswas'));
    }

    public function getWhere(){
        $mahasiswa = mahasiswa::where('ipk','<', '3')
        ->orderBy('nama', 'desc')
        ->get();

        return view('index', compact('mahasiswa'));
    }

    public function testWhere(){
        $mahasiswa = mahasiswa::where('nim','19021029')->get();

        dump($mahasiswa);
    }

    public function find(){
        $mahasiswa = mahasiswa::find(12);
        // $mahasiswa = Mahasiswa::find(8);
        return view('index',['mahasiswas' => [$mahasiswa]]);
        // return view('index', compact('mahasiswa'));

        dump($mahasiswa);
    }
}

