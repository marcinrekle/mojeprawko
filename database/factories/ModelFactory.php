<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' 			=> $faker->name,
        'email' 		=> $faker->safeEmail,
        'password' 		=> bcrypt(str_random(10)),
        'social_id' 	=> $faker->numberBetween($min = 100000000, $max = 9999999999),
        'avatar' 		=> $faker->imageUrl($width = 30, $height = 30),
        'remember_token'=> str_random(10),
        'social_token' 	=> str_random(10),
        'osk_id' 		=> $faker->numberBetween($min = 1, $max = 5),
        'is_admin' 		=> '0',

    ];
});

$factory->define(App\Osk::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'slug' => $faker->slug,
        'description' => $faker->text() ,

    ];
});

$factory->define(App\Payment::class, function (Faker\Generator $faker) {
    return [
        'amount' => $faker->numberBetween(50,800),
    ];
});

$factory->define(App\Hour::class, function (Faker\Generator $faker) {
    return [
        'count' 		=> $faker->numberBetween(1,2.5),
        'drive_date'	=> $faker->dateTimeBetween($startDate = '-3 months', $endDate = '+1 months'),
    ];
});

$factory->define(App\Student::class,function (Faker\Generator $faker){
	return[
		'hours_count' 	=> 30,
		'cost'			=> 1400,
	];
});
