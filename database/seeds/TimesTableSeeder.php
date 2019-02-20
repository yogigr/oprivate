<?php

use Illuminate\Database\Seeder;
use App\Time;

class TimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $times = [
        	[
        		'id' => 1,
        		'name' => '07.00'
        	],
        	[
        		'id' => 2,
        		'name' => '08.00'
        	],
        	[
        		'id' => 3,
        		'name' => '09.00'
        	],
        	[
        		'id' => 7,
        		'name' => '10.00'
        	],
        	[
        		'id' => 8,
        		'name' => '11.00'
        	],
        	[
        		'id' => 9,
        		'name' => '12.00'
        	],
        	[
        		'id' => 10,
        		'name' => '13.00'
        	],
        	[
        		'id' => 11,
        		'name' => '14.00'
        	],
        	[
        		'id' => 12,
        		'name' => '15.00'
        	],
        	[
        		'id' => 13,
        		'name' => '16.00'
        	],
        	[
        		'id' => 14,
        		'name' => '17.00'
        	],
        ];

        foreach ($times as $time) {
        	Time::create([
        		'id' => $time['id'],
        		'name' => $time['name']
        	]);
        }
    }
}
