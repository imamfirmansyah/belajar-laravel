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
            DB::table('dosen')
                ->insert([
                    'nama' => $faker->name,
                    'nipd' => $faker->randomNumber(8),
                    'created_at' => \Carbon\Carbon::now(),
                ]);
        }

        $this->command->info('Berhasil menambah data dosen!');

        /* data mahasiswa */
        $dosen = App\Dosen::pluck('id')->toArray();

        foreach(range(1,10) as $index) {
            DB::table('mahasiswa')
                ->insert([
                    'nama' => $faker->name,
                    'nim' => $faker->randomNumber(8),
                    'id_dosen' => $faker->randomElement($dosen),
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
    }
}
