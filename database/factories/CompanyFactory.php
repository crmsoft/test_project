<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'email' => $faker->companyEmail,
        'phone' => $faker->phoneNumber,
        'fax' => $faker->phoneNumber,
        'address' => $faker->address,
        'user_id' => function(){
            return \App\User::where('email','admin@admin.com')->first()->id;
        },
        'website' => 'https://www.'.str_random(5).'.com'
    ];
});
