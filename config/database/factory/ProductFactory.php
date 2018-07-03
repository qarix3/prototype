<?php

use Faker\Generator;
use App\Model\Product;

$this->factory->define(Product::class, function (Generator $faker) {
        return [
            'brand'    => $faker->company,
            'model'    => $faker->countryCode,
        ];
    });