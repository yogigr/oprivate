<?php

use Illuminate\Database\Seeder;
use App\Level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
        	['id' => 1, 'name' => 'Sekolah Dasar', 'short_name' => 'SD'],
        	['id' => 2, 'name' => 'Sekolah Menengah Pertama', 'short_name' => 'SMP'],
        	['id' => 3, 'name' => 'Sekolah Menengah Atas', 'short_name' => 'SMA'],
        ];

        foreach ($levels as $level) {
        	Level::create([
        		'id' => $level['id'],
        		'name' => $level['name'],
        		'short_name' => $level['short_name']
        	]);
        }
    }
}
