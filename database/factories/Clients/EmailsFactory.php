<?php

/** @var Factory $factory */

use App\Models\Client\Email;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Email::class, static function (Faker $faker) {
    return [
        'email' => $faker->unique()->email,
    ];
});
