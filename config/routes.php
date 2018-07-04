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
// Customer Create
$app->get('/customer/new/', 'App\Controller\CustomerController:new')->setName('new');
$app->post('/customer/new/', 'App\Controller\CustomerController:new')->setName('new');

$app->get('/customer/view/{id:[0-9]+}','App\Controller\CustomerController:view')->setName('view');
$app->get( '/customer/edit/{id:[0-9]+}', 'App\Controller\CustomerController:edit')->setName('edit');
$app->put( '/customer/edit/{id:[0-9]+}', 'App\Controller\CustomerController:edit')->setName('edit');
$app->delete('/customer/delete/{id:[0-9]+}', 'App\Controller\CustomerController:delete')->setName('delete');

// Product
$app->get('/product', 'App\Controller\ProductController:index')->setName('product');
$app->get('/product/new/{user_id:[0-9]+}','App\Controller\ProductController:repairWithCustomer')->setName('repairWithCustomer');
$app->post('/product/new/{user_id:[0-9]+}','App\Controller\ProductController:repairWithCustomer')->setName('repairWithCustomer');
$app->get('/product/update/{id:[0-9]+}', 'App\Controller\ProductController:update')->setName('update');
$app->put('/product/update/{id:[0-9]+}', 'App\Controller\ProductController:update')->setName('update');
$app->get('/product/update/status/{id:[0-9]+}', 'App\Controller\ProductController:updateStatus')->setName('updateStatus');
$app->put('/product/update/status/{id:[0-9]+}', 'App\Controller\ProductController:updateStatus')->setName('updateStatus');
//Part
$app->get('/part','App\Controller\AppController:index')->setName('part');

//Staff
$app->get('/admin/staff','App\Controller\StaffController:index')->setName('staff');

//Search Product
$app->post('/product/search', 'App\Controller\ProductController:filter')->setName('searchP');
//Search Customer
$app->post( '/customer/search', 'App\Controller\CustomerController:filter')->setName('searchC');
//Search Part
$app->post( '/part/search', 'App\Controller\AppController:parts')->setName('searchPart');