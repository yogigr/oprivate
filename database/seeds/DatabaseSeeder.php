<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProvincesTableSeeder::class,
            CitiesTableSeeder::class,
            LevelsTableSeeder::class,
            CoursesTableSeeder::class,
        	RolesTableSeeder::class,
            DaysTableSeeder::class,
            TimesTableSeeder::class,
            UsersTableSeeder::class,
        ]);
    }
}
