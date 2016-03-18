<?php

use Illuminate\Database\Seeder;

class InstructorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instructors')->insert([
            'user_id' => 2,
        ]);
        DB::table('instructors')->insert([
            'user_id' => 3,
        ]);
        $instructors = App\Instructor::all();
        foreach ($instructors as $instructor) {
            for ($i=1; $i < 21 ; $i++) { 
                $instructor->drives()->save(factory(App\Drive::class)->make());
            }
        }
    }
}
