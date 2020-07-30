<?php

/** @var Factory $factory */

use App\Models\User\ApiUser;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(ApiUser::class, static function (Faker $faker) {
    return [
        'name' => $faker->name,
        'token' => $faker->md5,
    ];
});
