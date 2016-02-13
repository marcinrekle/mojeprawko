<?php

use Illuminate\Database\Seeder;

class OskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Osk::class, 5)->create()->each(function($o) {
    		for ($i=0; $i < 15; $i++) {
    			$o->users()->save(factory(App\User::class)->make());
    		}
  		});
    }
}
