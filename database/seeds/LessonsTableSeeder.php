<?php

use App\User;
use App\Lesson;
use Illuminate\Database\Seeder;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::get()->each(function ($user) {
            $user->lessons()->attach(
                factory(Lesson::class)->create()
            );
        });
    }
}
