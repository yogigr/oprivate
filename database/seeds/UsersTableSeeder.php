<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //admin
        $admin = User::create([
            'id' => 1,
            'name' => 'Adityar Praja',
            'email' => 'adityarp@gmail.com',
            'password' => bcrypt('secret'),
            'role_id' => 1,
            'is_active' => true
        ]);

        //students
        factory(App\User::class, 50)
        ->create([
            'role_id' => 3,
            'price' => null,
            'course_id' => null,
            'rated' => null
        ])->each(function($student){
            factory(App\Profile::class)->create(['user_id' => $student->id]);
            factory(App\Address::class)->create(['user_id' => $student->id]);
            factory(App\Geolocation::class)->create(['user_id' => $student->id]);
            factory(App\Contact::class)->create(['user_id' => $student->id]);
        });

        //teachers
        factory(App\User::class, 30)
        ->create([
            'role_id' => 2
        ])->each(function($teacher){
            factory(App\Profile::class)->create(['user_id' => $teacher->id]);
            factory(App\Address::class)->create(['user_id' => $teacher->id]);
            factory(App\Geolocation::class)->create(['user_id' => $teacher->id]);
            factory(App\Contact::class)->create(['user_id' => $teacher->id]);
            factory(App\Educational::class, 3)->create(['user_id' => $teacher->id]);
            factory(App\Achievement::class, 3)->create(['user_id' => $teacher->id]);
            factory(App\Schedule::class, 3)->create(['teacher_id' => $teacher->id]);
        });
    }
}
