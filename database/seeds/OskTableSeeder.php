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
        factory(App\Osk::class, 2)->create()->each(function($o) {
    		for ($i=0; $i < 10; $i++) {
    			$o->users()->save(factory(App\User::class)->make());
    		}
  		});
    }
}
