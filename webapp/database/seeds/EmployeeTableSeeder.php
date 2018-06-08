<?php

use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i=0; $i<=10; $i++) {
            DB::table('employee')
                ->insert([
                    'name' => $faker->name,
                    'created_at' => \Carbon\Carbon::now(),
                ]);
        }
    }
}
