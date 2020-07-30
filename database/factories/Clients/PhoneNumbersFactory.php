<?php

/** @var Factory $factory */

use App\Models\Client\PhoneNumber;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(PhoneNumber::class, static function (Faker $faker) {
    return [
        'number' => $faker->unique()->phoneNumber,
    ];
});
