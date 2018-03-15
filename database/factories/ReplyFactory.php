<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Reply::class, function (Faker $faker) {
    //一个月内的随机时间
    $time = $faker->dateTimeThisMonth();
    return [
        'body'  => $faker->sentence(),
        'created_at'    =>  $time,
        'updated_at'    =>$time,
    ];
});
