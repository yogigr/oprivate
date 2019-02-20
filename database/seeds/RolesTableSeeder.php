<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$roles = [
    		[
    			'id' => 1,
    			'name' => 'Administrator'
    		],
    		[
    			'id' => 2,
    			'name' => 'Guru',
    		],
    		[
    			'id' => 3,
    			'name' => 'Siswa'
    		],
    	];

    	foreach ($roles as $role) {
    		Role::create([
    			'id' => $role['id'],
    			'name' => $role['name']
    		]);
    	}
    }
}
