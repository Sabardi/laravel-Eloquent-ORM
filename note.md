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


4. Mengupdate Data
Eloquent ORM memproses data tabel menggunakan object. Untuk proses update, caranya
adalah kita harus cari Model object dari tabel, lalu ubah beberapa property dan simpan
kembali
 
     public function update(){
        $mahasiswa = mahasiswa::find(1);
        $mahasiswa -> nim = '19003036';
        $mahasiswa->tanggal_lahir = '2002-01-01';
        $mahasiswa->ipk = 2.9;
        $mahasiswa ->save();

        dump($mahasiswa);
    }
    
Method find() dipakai untuk mencari data
tabel berdasarkan kolom id. Artinya, perintah Mahasiswa::find(1) akan mengambil data di
tabel mahasiswas yang memiliki id = 1, lalu membuat object dari data tersebut. Object ini
selanjutnya disimpan ke dalam variabel $mahasiswa.

5. update menggunakan Mass Update
Proses update juga bisa dilakukan menggunakan teknik mass update.

    public function massUpdate(){
        mahasiswa::where('nim','19003036')->first()->update([
        'tanggal_lahir' =>'2000-04-20',
        'ipk' => 2.1
        ]);
        return "Berhasil di proses";
        }


Mahasiswa::where('nim','19003036')->first()
untuk mencari mahasiswa yang ingin di update

Teknik mass update juga butuh pengaturan property $fillable atau $guarded di file
model Mahasiswa.php. Jika anda menemukan error, cek apakah salah satu dari property
ini sudah ditambahkan atau belum.

6. Menghapus Data
Proses menghapus data dengan Eloquent sangat simple, cukup dengan mengakses method
delete() dari Model object. Namun sebelum itu kita harus cari terlebih dahulu Model object
yang ingin dihapus.

7. menggunakan Mass Delete
Mass delete adalah sebutan untuk cara menghapus data dari kumpulan Model object.
Kumpulan model object ini didapat dari hasil pencarian method where() 

    public function massDelete(){
        $mahasiswa = mahasiswa::where('ipk', '>', 2)->delete();
        dump($mahasiswa);
    }
8. Menampilkan Data
untuk menampilkan data dari database menggunakan 
* Method all(); ini akan mengambil semuda data yang ada di database 

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
    
* menggunakan method Method where()
Untuk mengambil sebagian data dari tabel, kita bisa memakai method where(). Cara
penggunaannya sama seperti method where() di materi Collection dan Que


Sedikit catatan, jika kita memakai method where() di dalam Eloquent, maka harus ada method
lain untuk mengaksesnya, seperti get(). Jika hanya menulis sampai where() saja, maka itu
akan menghasilkan Builder class, bukan collection dari class Model:
$mahasiswas = Mahasiswa::where('ipk','<','3');
Jika ditulis seperti ini, variabel $mahasiswas akan berisi Builder class, yakni class internal
Laravel untuk memproses Eloquent. Yang seharusnya kita tulis adalah:
$mahasiswas = Mahasiswa::where('ipk','<','3')->get();
Tambahan method get() di akhir ini kadang sering lupa ditulis, sehingga bisa terjadi error
    public function getWhere(){
        $mahasiswa = mahasiswa::where('ipk','<', '3')
        ->orderBy('nama', 'desc')
        ->get();

        return view('index', compact('mahasiswa'));
    }

* Method first()
Ketika kita membuat batasan menggunakan method where()->get(), hasilnya adalah sebuah
collection, meskipun itu hanya terdiri dari 1 object saja. Method first() bisa dipakai sebagai
pengganti method get() untuk mengambil element pertama dari hasil batasan where() ini.

    public function testWhere(){
        $mahasiswa = mahasiswa::where('nim','19021029')->get();

        dump($mahasiswa);
    }

* Method find()
    public function find(){
        $mahasiswa = mahasiswa::find(12);
        return view('index',['mahasiswas' => [$mahasiswa]]);
    }

Method latest()
Method latest() berguna untuk mengambil collection yang sudah di urutkan berdasarkan
tanggal pembuatan secara menurun, data paling akhir yang diinput akan ada di urutan
pertama.


Method find() bisa dipakai untuk mencari data Model berdasarkan kolom id. Hasil dari
method ini langsung berbentuk object, yang sama seperti method first()

9. Mengirim Data ke View
Menampilkan data langsung di controller terasa kurang pas, karena seharusnya data ini
dikirim ke view terlebih dahulu

    public function allView(){
        $mahasiswas = mahasiswa::all();
        return view('index', compact('mahasiswas'));
    }

