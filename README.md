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
- Cara menampilkan gunakan
```
Route::get('relasi-1', function() {
    # Temukan mahasiswa dengan NIM 1015015072
    $mahasiswa = App\Mahasiswa::where('nim', '=', '11760123')->first();

    # Tampilkan nama wali mahasiswa
    return $mahasiswa->wali->nama;
});
```

## Halaman Khusus berdasarkan level user (Admin dan User)
Mengikuti tutorial [youtube](https://www.youtube.com/watch?v=FKEWlsNmkD0&t=4s)
