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
        $route = $request->getAttribute('route');
        $id = $route->getArguments('id');

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
                    'user_id' => $id,
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
//            if ($this->auth->findByCredentials(['login' => $email])) {
//                $this->validator->addError('email', 'This email is already used.');
//            }
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
                return $this->redirect($response, 'home');
        }
        return $this->render($response, 'app/newCust.twig');
    }

    public function edit(Request $request,Response $response)
    {
        $route = $request->getAttribute('route');
        $id = $route->getArguments('id');

        $customer = Customer::where($id)->firstOrFail();

        $user = $customer->user;

        if ($request->isPut()) {

            $name = $request->getParam('name');
            $icNo = $request->getParam('icNo');
            $address = $request->getParam('address');
            $phoneNo = $request->getParam('phoneNo');
            $email = $request->getParam('email');
            $userid = $request->getParam('user_id');

            $customerData = [
                'name' => $name,
                'icNo' => $icNo,
                'address' => $address,
                'phoneNo' =>$phoneNo,
                'email' => $email,
                'user_id' => $userid,
            ];

            $customer->update($customerData);

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

        //$user = User::with('product', 'customer')->where('id', '=', $id)->first();

        $customer = Customer::with('user')
            ->where('user_id','=',$id)
            ->firstOrFail();

       $product = Product::join('customer','product.user_id','=','customer.id')
           ->join('repairStatus','product.id','=','repairStatus.product_id')
           ->join('repairPart','product.part_id','=','repairPart.id')
           ->where('customer.id','=',$id)
           ->get();

       $user = $customer->user;

       $date = Carbon::parse($customer->user->last_login)->diffForHumans();

        return $this->render($response, 'app/viewCust.twig', [
            'user' => $user,
            'customer' => $customer,
            'date' => $date,
            'product' => $product,
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





    public function filter(Request $request, Response $response)
    {
        $method = 'icNo';

        if($request->isPost()) {
            $search = $request->getParam('search');
        }

        $customer = Customer::where($method,'=',$search)->get();

        return $this->render($response, 'app/customerList.twig', [
            'customers' => $customer,
        ]);
    }
}
