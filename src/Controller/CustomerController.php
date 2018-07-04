<?php

namespace App\Controller;


use Awurth\Slim\Helper\Controller\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

use App\Model\User;
use App\Model\Customer;
use App\Model\Product;

use Carbon\Carbon;

final class CustomerController extends Controller
{

    public function index(Request $request, Response $response)
    {
        $customers = Customer::all();
        return $this->render($response, 'app/customerList.twig', [
            'customers' => $customers,
        ]);
    }

    public function new(Request $request, Response $response)
    {
        if ($request->isPost()) {

            $name = $request->getParam('name');
            $icNo = $request->getParam('icNo');
            $address = $request->getParam('address');
            $phoneNo = $request->getParam('phoneNo');
            $email = $request->getParam('email');


            $customer = ([
                    'name' => $name,
                    'icNo' => $icNo,
                    'address' => $address,
                    'phoneNo' =>$phoneNo,
                    //'email' => $email,
                    'user_id' => 101,
                ]);

            Customer::create($customer);

//            $this->validator->request($request, [
//                'username' => V::length(3, 25)->alnum('_')->noWhitespace(),
//                'email' => V::noWhitespace()->email(),
//                'password' => [
//                    'rules' => V::noWhitespace()->length(6, 25),
//                    'messages' => [
//                        'length' => 'The password length must be between {{minValue}} and {{maxValue}} characters'
//                    ]
//                ],
//                'password_confirm' => [
//                    'rules' => V::equals($password),
//                    'messages' => [
//                        'equals' => 'Passwords don\'t match'
//                    ]
//                ]
//            ]);
//
//            if ($this->auth->findByCredentials(['login' => $username])) {
//                $this->validator->addError('username', 'This username is already used.');
//            }
//
            if ($this->auth->findByCredentials(['login' => $email])) {
                $this->validator->addError('email', 'This email is already used.');
            }
//
//            if ($this->validator->isValid()) {
//                /** @var \Cartalyst\Sentinel\Roles\EloquentRole $role */
//                $role = $this->auth->findRoleByName('User');
//
//                $user = $this->auth->registerAndActivate([
//                    'username' => $username,
//                    'email' => $email,
//                    'password' => $password,
//                    'permissions' => [
//                        'user.delete' => 0
////                    ]
////                ]);
                $this->flash('success', 'Customer account has been created.');
        }
        return $this->render($response, 'app/newCust.twig');
    }

    public function edit(Request $request,Response $response)
    {
        $route = $request->getAttribute('route');
        $id = $route->getArguments('id');

        $customer = Customer::where($id)->firstOrFail();

        $user = $customer->user;

        if ($request->isPost()) {

            $name = $request->getParam('name');
            $icNo = $request->getParam('icNo');
            $address = $request->getParam('address');
            $phoneNo = $request->getParam('phoneNo');
            $email = $request->getParam('email');


            $customerData = [
                'name' => $name,
                'icNo' => $icNo,
                'address' => $address,
                'phoneNo' =>$phoneNo,
                'email' => $email,
                'user_id' => $id,
            ];
            $customer->save;

            $this->flash('success', 'Customer account has been updated');
            return $this->redirect($response, 'customer');
        }

            return $this->render($response, 'app/editCust.twig', [
            'customer' => $customer,
            'user' => $user,
        ]);
    }

    public function view(Request $request,Response $response)
    {
        $route = $request->getAttribute('route');
        $id = $route->getArguments('id');

        $user = Customer::with('user')->where('user_id','=',$id)->firstOrFail();

        $product = Product::join('repairStatus','product.id','=','repairStatus.product_id')

            ->join('customer','product.cust_id','=','user_id')->where('user_id','=',$id)->get();

        $customer = $user->user;

        $date = Carbon::parse($user->user->last_login)->diffForHumans();

        return $this->render($response, 'app/viewCust.twig', [
            'user' => $user,
            'products' => $product,
            'customer' => $customer,
            'date' => $date,
        ]);
    }

    public function delete(Request $request, Response $response) {

        $route = $request->getAttribute('route');
        $id = $route->getArguments('id');

        if($request->isDelete())
        {
           User::with('product', 'customer')->where('id', '=', $id)->delete();
        }
        else{
            $this->flash('error', 'Error');
        }
        $this->flash('success', 'Customer account has been deleted');
        return $this->redirect($response, 'customer');
    }

}
