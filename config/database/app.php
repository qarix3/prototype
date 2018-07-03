<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;


Manager::schema()->create('staff', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name')->nullable();
    $table->string('phoneNo')->nullable();
    $table->string('address');
    $table->integer('job_id')->unsigned();
    $table->timestamps();
    $table->foreign('job_id')->references('jobid')->on('job');
});

Manager::schema()->create('customer', function (Blueprint $table) {
    $table->string('icNo')->unique();
    $table->string('name');
    $table->string('address');
    $table->string('phoneNo');
    $table->integer('user_id')->unsigned();
    $table->timestamps();
    $table->foreign('user_id')->references('id')->on('user');
});

Manager::schema()->create('product', function (Blueprint $table) {
    $table->increments('id');
    $table->string('brand')->nullable();
    $table->string('model')->nullable();
    $table->integer('part_id')->unsigned();
    $table->integer('cust_id')->unsigned();
    $table->timestamps();
    $table->foreign('cust_id')->references('user_id')->on('customer');
    $table->foreign('part_id')->references('id')->on('repairPart');
});

Manager::schema()->create('job', function (Blueprint $table) {
    $table->increments('jobid');
    $table->string('desc')->nullable();
});

Manager::schema()->create('repairPart', function (Blueprint $table) {
    $table->increments('id');
    $table->string('manufacturer')->nullable();
    $table->string('type')->nullable();
    $table->float('price');
});

Manager::schema()->create('repairStatus', function (Blueprint $table) {
    $table->increments('id');
    $table->datetime('finished_date');
    $table->boolean('status');
    $table->integer('staff_id')->unsigned();
    $table->integer('product_id')->unsigned();
    $table->foreign('staff_id')->references('id')->on('staff');
    $table->foreign('product_id')->references('id')->on('product');
});

