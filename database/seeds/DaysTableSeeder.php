<?php

use Illuminate\Database\Seeder;
use App\Day;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
        	[
        		'id' => 1,
        		'name' => 'Senin'
        	],
        	[
        		'id' => 2,
        		'name' => 'Selasa'
        	],
        	[
        		'id' => 3,
        		'name' => 'Rabu'
        	],
        	[
        		'id' => 4,
        		'name' => 'Kamis'
        	],
        	[
        		'id' => 5,
        		'name' => 'Jumat'
        	],
        	[
        		'id' => 6,
        		'name' => 'Sabtu'
        	],
        	[
        		'id' => 7,
        		'name' => 'Minggu'
        	],
        ];

        foreach ($days as $day) {
        	Day::create([
        		'id' => $day['id'],
        		'name' => $day['name']
        	]);
        }
    }
}
