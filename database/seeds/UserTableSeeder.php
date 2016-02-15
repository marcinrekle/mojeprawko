<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::all();
        foreach ($users as $user) {
            if (!$user->is_admin && $user->id > 2) { 
                $user->student()->save(factory(App\Student::class)->make());
            }
            
        }
    }
}
