<?php

$app->get('/', 'app.controller:home')->setName('home');
$app->get('/dashboard', 'app.controller:dashboard')->setName('dashboard');

$app->group('', function () {
    $this->map(['GET', 'POST'], '/login', 'auth.controller:login')->setName('login');
    $this->map(['GET', 'POST'], '/register', 'auth.controller:register')->setName('register');
})->add($container['guest.middleware']);

$app->get('/logout', 'auth.controller:logout')
    ->add($container['auth.middleware']())
    ->setName('logout');

// Customer
$app->get('/customer', 'App\Controller\CustomerController:index')->setName('customer');
$app->get('/customer/new/', 'App\Controller\CustomerController:new')->setName('new');
$app->get('/customer/view/{user_id:[0-9]+}','App\Controller\CustomerController:view')->setName('view');
$app->get( '/customer/edit/{user_id:[0-9]+}', 'App\Controller\CustomerController:edit')->setName('edit');
$app->delete('/customer/delete/{user_id:[0-9]+}', 'App\Controller\CustomerController:destroy')->setName('destroy');

// Product
$app->get('/product', 'App\Controller\ProductController:index')->setName('product');
$app->get('/product/new/{user_id:[0-9]+}','App\Controller\ProductController:repairWithCustomer')->setName('repairWithCustomer');
$app->get('/product/update/{id:[0-9]+}', 'App\Controller\ProductController:update')->setName('update');
$app->get('/product/update/status/{id:[0-9]+}', 'App\Controller\ProductController:updateStatus')->setName('updateStatus');
//Part
$app->get('/part','App\Controller\Sparepart:index')->setName('part');

//Staff
$app->get('/admin/staff','App\Controller\StaffController:index')->setName('staff');
