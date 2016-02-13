<?php

use Illuminate\Database\Seeder;

class studentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $students = App\Student::all();
        foreach ($students as $student) {
            for ($i=0; $i < 10; $i++) { 
                $student->hours()->save(factory(App\Hour::class)->make());
            }
            for ($i=0; $i < 3; $i++) { 
                $student->payments()->save(factory(App\Payment::class)->make());
            }
        }
    }
}
