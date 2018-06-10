<?php

use Illuminate\Database\Seeder;

class RelasiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Kosongin isi tabel
		DB::table('mahasiswa')->delete();
		DB::table('wali')->delete();

        $faker = \Faker\Factory::create();

        /* data dosen */
        foreach(range(1,3) as $index) {
            DB::table('dosen')->insert(
                [
                    'nama' => $faker->name,
                    'nipd' => $faker->randomNumber(8),
                    'created_at' => \Carbon\Carbon::now(),
                ]
            );
        }

        $this->command->info('Berhasil menambah data dosen!');

        /* data mahasiswa */
        $dosen = App\Dosen::pluck('id')->toArray();

        foreach(range(1,10) as $index) {
            DB::table('mahasiswa')->insert(
                [
                    'nama' => $faker->name,
                    'nim' => $faker->randomNumber(8),
                    'id_dosen' => $faker->randomElement($dosen),
                    'created_at' => \Carbon\Carbon::now(),
                ]
            );
        }

        $this->command->info('Berhasil menambah data mahasiswa!');

        /* data wali */
        $mahasiswa = App\Mahasiswa::pluck('id')->toArray();

        foreach( range(1, count($mahasiswa) ) as $index ) {
        	DB::table('wali')->insert(
                [
                    'nama' => $faker->name,
                    'id_mahasiswa' => $faker->unique()->randomElement($mahasiswa),
                    'created_at' => \Carbon\Carbon::now(),
                ]
            );
        }

        $this->command->info('Berhasil menambah data Wali!');

        /***********************************
         *** SIAPKAN SEEDER HOBI DISINI  ***
         ***********************************/

        # Bersihkan tabel yang dibutuhkan
        DB::table('hobi')->delete();
        DB::table('mahasiswa_hobi')->delete();

        foreach(range(1,5) as $index) {
            DB::table('hobi')->insert(
                [
                    'hobi' => $faker->name,
                    'created_at' => \Carbon\Carbon::now(),
                ]
            );
        }

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

        # Tampilkan pesan ini bila berhasil diisi
        $this->command->info('Mahasiswa beserta Hobi telah diisi!');
    }
}
