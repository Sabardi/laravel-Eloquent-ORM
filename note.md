# apa itu orm ?
ORM adalah singkatan dari "Object-Relational Mapping". Ini adalah teknik yang digunakan untuk memetakan objek dari bahasa pemrograman ke struktur data yang disimpan dalam database relasional.

database terdiri dari kumpulan tabel yang saling
terhubung. Di dalam setiap tabel, data disimpan dalam bentuk baris dan kolom. ORM dipakai
untuk mengubah baris dan kolom ini menjadi sebuah object. Nantinya, setiap kolom akan
menjadi property dari object tersebut dan cara  melakukan inputan nya pun sedikit berbeda


bisa menggunakan database sebelum nya


1. Pembuatan Model
perintah untuk membuat model ialah php artisan 
,,make:model

2. Pengaksesan Model
Pembuatan kode program dengan Eloquent ORM tetap di lakukan dari controller. Hanya saja sekarang kita butuh mengakses Model,
 cara nya yaitu menambakan kode ini
use App\Models\mahasiswa;

    public function cekObject(){
        $mahasiswa = new mahasiswa();
        dump($mahasiswa);
    }

3. Menginput Data
Proses menginput data menggunakan Eloquent ORM cukup sederhana. Caranya, buat object
dari model Mahasiswa, input data ke dalam atribut yang bersesuaian dengan nama kolom tabel,
dan terakhir jalankan method save().

    public function insert(){
        $mahasiswa = new Mahasiswa();
        $mahasiswa -> nim = '19003036';
        $mahasiswa -> nama = 'sabardian';
        $mahasiswa -> tanggal_lahir = '2001-12-31';
        $mahasiswa -> ipk = 3.5;
        $mahasiswa ->save();

        dump($mahasiswa);
    }
4. Mass Assignment
Alternatif cara lain untuk proses input menggunakan Eloquent adalah dengan teknik mass
assignment. Disebut seperti ini karena kita bisa mengisi banyak property untuk object
Mahasiswa dalam sekali proses

Cara input mass assignment dilakukan dengan mengakses static method create() dari Model
object. Karena kita menggunakan model Mahasiswa, maka pemanggilan method ini adalah
dengan perintah Mahasiswa::create(). Data yang akan diinput ditulis sebagai associative
array dan menjadi argument dari method Mahasiswa::create()

Associative array yang ada di baris 8 – 11 inilah yang menjadi alasan kenapa disebut sebagai
mass assignment. Karena seharusnya kita men-set satu per satu nilai ini ke dalam property
object Mahasiswa:
$mahasiswa->nim = '19021044';
$mahasiswa->nama = 'Rudi Permana';
$mahasiswa->tanggal_lahir = '2000-08-22';
$mahasiswa->ipk = 2.5;

Dengan method Mahasiswa::create(), kode di atas diganti menjadi associative array.
Teknik seperti ini akan berguna untuk pemrosesan form karena bawaan Laravel inputan form
sudah dalam bentuk associative array. 
# SABAR YA error  kita pake nanti saat menggunakan  ini nanti

tampil pesan error dengan keterangan Add [nim] to fillable property to allow mass
assignment on [App\Models\Mahasiswa]. Error ini terjadi karena Laravel membatasi akses ke
sebuah tabel ketika di proses menggunakan mass assignment. 

Pembatasan ini dibuat karena mass assignment sering dipakai dengan nilai yang langsung
berasal dari form. Sehingga untuk mencegah kemungkinan terjadi 'manipulasi data', Laravel
mewajibkan programmer untuk menulis nama kolom apa saja yang boleh diinput.
Dalam contoh ini, saya harus mendaftarkan kolom 'nim', 'nama', 'tanggal_lahir' dan 'ipk' ke
dalam property $fillable yang ada di model Mahasiswa. Property ini memang tidak ada
sebelumnya dan harus kita tambah manual.

tambah file kode ini

    protected $fillable = ['nim','nama','tanggal_lahir','ipk'];

# note buat kita
Cara lain untuk mengizinkan nama kolom bisa diakses dari mass assignment adalah
menggunakan property $guarded.
Berbeda dengan $fillable, $guarded dipakai untuk menulis nama kolom apa saja yang tidak
boleh diisi. Sebagai contoh, jika saya memutuskan kolom ipk tidak boleh diisi menggunakan
mass assignment, bisa menulis kode berikut:
protected $guarded = ['ipk'];
Akibatnya, pada saat proses input dilakukan, nilai untuk kolom ipk akan terhalang dan tidak
bisa sampai ke database meskipun sudah tertulis dalam controller.
Salah satu teknik yang sering dipakai adalah mengisi array kosong ke dalam $guarded:
protected $guarded = [];
Jika ditulis seperti ini, maka tidak ada pembatasan apapun ke dalam tabel. Artinya, semua
kolom bisa di proses dengan mass assignment, termasuk seandainya kita mengubah struktur
tabel (mengubah atau menambah kolom baru). Ini terdengar sedikit berbahaya, tapi dengan
teknik tertentu pada saat pemrosesan form nanti, masalah ini bisa diatasi.

protected $guarded = [];
