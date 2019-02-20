<?php

use Illuminate\Database\Seeder;
use App\Course;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
        	['id' => 1,'name' => 'Matematika', 'short_name' => 'MTK', 'level_id' => 1],
            ['id' => 2,'name' => 'Matematika', 'short_name' => 'MTK', 'level_id' => 2],
            ['id' => 3,'name' => 'Matematika', 'short_name' => 'MTK', 'level_id' => 3],
        	['id' => 4,'name' => 'Bahasa Indonesia', 'short_name' => 'BIN', 'level_id' => 1],
            ['id' => 5,'name' => 'Bahasa Indonesia', 'short_name' => 'BIN', 'level_id' => 2],
            ['id' => 6,'name' => 'Bahasa Indonesia', 'short_name' => 'BIN', 'level_id' => 3],
            ['id' => 7,'name' => 'Bahasa Inggris', 'short_name' => 'BING', 'level_id' => 1],
            ['id' => 8,'name' => 'Bahasa Inggris', 'short_name' => 'BING', 'level_id' => 2],
            ['id' => 9,'name' => 'Bahasa Inggris', 'short_name' => 'BING', 'level_id' => 3],
            ['id' => 10,'name' => 'Ilmu Pengetahuan Alam', 'short_name' => 'IPA', 'level_id' => 1],
            ['id' => 11,'name' => 'Ilmu Pengetahuan Alam', 'short_name' => 'IPA', 'level_id' => 2],
            ['id' => 12,'name' => 'Ilmu Pengetahuan Alam', 'short_name' => 'IPA', 'level_id' => 3],
            ['id' => 13,'name' => 'Ilmu Pengetahuan Sosial', 'short_name' => 'IPS', 'level_id' => 1],
            ['id' => 14,'name' => 'Ilmu Pengetahuan Sosial', 'short_name' => 'IPS', 'level_id' => 2],
            ['id' => 15,'name' => 'Ilmu Pengetahuan Sosial', 'short_name' => 'IPS', 'level_id' => 3],
        ];

        foreach ($courses as $course) {
        	Course::create([
        		'id' => $course['id'],
        		'name' => $course['name'],
                'short_name' => $course['short_name'],
                'level_id' => $course['level_id']
        	]);
        }
    }
}
