# Belajar Laravel
Beberapa hal dalam framework laravel yang sedang saya pelajari, diantaranya explorasi tentang:
- Instalasi Laravel ✅
- Login ✅
- Simple CRUD ✅
- CRUD dengan Relational Table 
- Halaman Khusus berdasarkan level user (Admin dan User) ✅
Mengikuti tutorial [youtube](https://www.youtube.com/watch?v=FKEWlsNmkD0&t=4s)

---

## Instalasi Laravel
Mengikuti tutorial berdasarkan buku [Menyelami Framework Laravel](https://leanpub.com/bukularavel) oleh Rahmat Awaludin

## Login
Menemukan masalah `Specified key was too long error` karena XAMPP terbaru mariaDB nya versi dibawah 10.2.2 solve nya bisa cek ke [web ini](https://laravel-news.com/laravel-5-4-key-too-long-error)

## Simple CRUD
[Laravel 5.6 - Membuat CRUD Sederhana](http://indocoder.com/laravel-basic/laravel-5-6-basic-1-membuat-crud-sederhana/)

## CRUD dengan Relational Table
- [Penalaran Relasi Database](https://novay.github.io/blog/2014/04/15/penalaran-relasi-database)
- [Implementasi relasi di laravel dengan Eloquent](https://novay.github.io/blog/2014/04/16/implementasi-relasi-di-laravel-dengan-eloquent)
- Implementasi Database Seeder untuk testing melalui tutorial - [Menggunakan Seeder di Laravel](https://www.codepolitan.com/menggunakan-seeder-di-laravel-59f7249589e2f)
- Perintah untuk reset database disertai seed : `php artisan migrate:refresh --seed`
- Perintah membuat seeder dengan artisan `php artisan make:seeder UsersTableSeeder`
- Belajar membuat seeder dengan [Faker](https://github.com/fzaninotto/Faker) dari artikel ini [PHP Laravel 5 : database seeding with 'faker'](https://medium.com/@khunemz/php-laravel-5-database-seeding-with-faker-c7dcce5dabe2)
- Belajar membuat [seeder relasi](https://laracasts.com/discuss/channels/general-discussion/faker-and-relationship-tables) One to One
- Ternyata [deprecated untuk penggunaan lists()](https://laracasts.com/discuss/channels/laravel/lists-deprecated-replacement) berdasarkan id, jadi sekarang pakai `pluck` menjadi `$mahasiswa = Mahasiswa::pluck('id');`
- Akhirnya yang paling efektif untuk relasi one-to-one pakai ini
```
$faker = \Faker\Factory::create();

/* data mahasiswa */
foreach(range(1,10) as $index) {
    DB::table('mahasiswa')
        ->insert([
            'nama' => $faker->name,
            'nim' => $faker->randomNumber(8),
            'created_at' => \Carbon\Carbon::now(),
        ]);
}

$this->command->info('Berhasil menambah data mahasiswa!');

/* data wali */
$mahasiswa = App\Mahasiswa::pluck('id')->toArray();

foreach( range(1, count($mahasiswa) ) as $index ) {
	DB::table('wali')
        ->insert([
            'nama' => $faker->name,
            'id_mahasiswa' => $faker->unique()->randomElement($mahasiswa),
            'created_at' => \Carbon\Carbon::now(),
        ]);
}

$this->command->info('Berhasil menambah data Wali!');
```
- Cara menampilkan relasi one to one
```
Route::get('relasi-one-to-one', function() {
    # Temukan mahasiswa dengan NIM 1015015072
    $mahasiswa = App\Mahasiswa::where('nim', '=', '11760123')->first();

    # Tampilkan nama wali mahasiswa
    return $mahasiswa->wali->nama;
});
```
- Cara menampilkan relasi one to many
```
Route::get('relasi-one-to-many', function() {

    # Temukan dosen dengan yang bernama Elizabeth Fay
    $dosen = App\Dosen::where('nipd', '=', '49582134')->first();

    # Tampilkan seluruh data mahasiswa didikannya
    foreach ($dosen->mahasiswa as $temp)
        echo '<li> Nama : ' . $temp->nama . ' <strong>' . $temp->nim . '</strong></li>';
});
```
- Cara menggunakan faker untuk attach relasi many to many, ini lumayan susah euy, hampir 3 jam ngulik, best practice nya pakai cara ini, tapi ini baru bisa insert data, misalkan mau menjalankan `php artisan migrate:refresh --seed` pasti error constraint karena data foreign key nya masih nyangkut di table relasi, masih perlu di cek dibagian ini:
```
# Hubungkan Mahasiswa dengan Hobinya masing-masing
    $hobi = App\Hobi::pluck('id')->toArray();

    for ($i = 0; $i < 40; ++$i) {
        $id_mahasiswa = $faker->randomElement($mahasiswa);
        $id_hobi = $faker->randomElement( $hobi );

        $checkExist = DB::table('mahasiswa_hobi')
            ->whereIdMahasiswa($id_mahasiswa)
            ->whereIdHobi($id_hobi)
            ->count() > 0;

        if (!$checkExist) {
            $mahasiswa_hobi = App\Mahasiswa::find( $id_mahasiswa );
            $mahasiswa_hobi->hobi()->attach( $id_hobi );
        } else {
            $i--;  
        }
    }
```
- Masalah drop table saat migration refresh diatas akhirnya solved dengan menambahkan `$table->dropForeign('mahasiswa_id_dosen_foreign');` di bagian seeder function `down()`
```
public function down()
{
    Schema::table('mahasiswa', function($table) {
        $table->dropForeign('mahasiswa_id_dosen_foreign');
        $table->dropColumn('id_dosen');
    });
}
```
- Penambahan `belajar-relasi-table` untuk memudahkan preview dari masing-masing contoh Implementasi relasi table
```
Route::get('belajar-relasi-table', function() {
    $html = '';

    $html .= 
        '<h2>Belajar Relasi Table</h2>
        <ul>
            <li><a href="relasi-one-to-one">Relasi One to One</a></li>
            <li><a href="relasi-one-to-many">Relasi One to Many</a></li>
            <li><a href="relasi-many-to-many">Relasi Many to Many</a></li>
        </ul>';

    return $html;
});
```
- Bacaan untuk update relational table many to one atau many to many [Saving and Updating Laravel Relations](http://meigwilym.com/family-fortunes-saving-and-updating-laravel-relations/)

## Halaman Khusus berdasarkan level user (Admin dan User)
Mengikuti tutorial [youtube](https://www.youtube.com/watch?v=FKEWlsNmkD0&t=4s)
