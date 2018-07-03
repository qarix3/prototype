<?php

use Faker\Generator;
use App\Model\Staff;

$this->factory->define(Staff::class, function (Generator $faker) {

        return [
            'name'=> $faker->name,
            'phoneNo'=> $faker->phoneNumber,
            'address'=> $faker->address,
            'jobId' => 1,
        ];
    });