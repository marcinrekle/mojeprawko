<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OskTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(InstructorTableSeeder::class);
        $this->call(DrivesTableSeeder::class);
        $this->call(studentTableSeeder::class);
    }
}
