<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;


Manager::schema()->create('staff', function (Blueprint $table) {
    $table->increments('id')->autoIncrement();
    $table->string('name')->nullable();
    $table->string('phoneNo')->nullable();
    $table->string('address');
    $table->integer('job_id')->unsigned();
    $table->timestamps();
    $table->foreign('job_id')->references('jobid')->on('job')->onDelete('cascade')->disableForeignKeyConstraints();
});

Manager::schema()->create('customer', function (Blueprint $table) {
    $table->increments('id')->autoIncrement();
    $table->string('icNo');
    $table->string('name');
    $table->string('address');
    $table->string('phoneNo');
    $table->integer('user_id')->unsigned();
    $table->timestamps();
    $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade')->disableForeignKeyConstraints();
});

Manager::schema()->create('product', function (Blueprint $table) {
    $table->increments('id')->autoIncrement();
    $table->string('brand')->nullable();
    $table->string('model')->nullable();
    $table->integer('part_id')->unsigned();
    $table->integer('user_id')->unsigned();
    $table->timestamps();
    $table->foreign('user_id')->references('user_id')->on('customer')->onDelete('cascade')->disableForeignKeyConstraints();
    $table->foreign('part_id')->references('id')->on('repairPart')->onDelete('cascade')->disableForeignKeyConstraints();
});

Manager::schema()->create('job', function (Blueprint $table) {
    $table->increments('jobid');
    $table->string('desc')->nullable();
});

Manager::schema()->create('repairPart', function (Blueprint $table) {
    $table->increments('id')->autoIncrement();
    $table->string('manufacturer')->nullable();
    $table->string('type')->nullable();
    $table->float('price');
});

Manager::schema()->create('repairStatus', function (Blueprint $table) {
    $table->increments('id')->autoIncrement();
    $table->datetime('finished_date');
    $table->boolean('status');
    $table->integer('staff_id')->unsigned();
    $table->integer('product_id')->unsigned();
    $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade')->disableForeignKeyConstraints();
    $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade')->disableForeignKeyConstraints();
});
