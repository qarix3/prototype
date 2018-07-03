<?php

namespace App\Controller;

use App\Model\Product;
use Awurth\Slim\Helper\Controller\Controller;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Model\Customer;
use App\Model\User;
use Carbon\Carbon;

final class CustomerController extends Controller
{

    public function index(Request $request, Response $response)
    {
        return $this->render($response, 'app/customerList.twig', [
            'customers' => Customer::all(),
        ]);
    }

    public function new($request, $response)
    {
        return $this->render($response, 'app/newCust.twig');
    }

    public function edit($request, $response)
    {
        $user = Customer::with('user')->where('user_id','=',1)->first();

        return $this->render($response, 'app/editCust.twig', [
            'customer' => $user,
        ]);
    }

    public function delete($request, $response) {
    }

    public function view($request, $response)
    {
        $user = Customer::with('user')->where('user_id','=',10)->first();

        $product = Product::join('repairStatus','product.id','=','repairStatus.product_id')
            ->join('customer','product.cust_id','=','user_id')->where('user_id','=',10)->get();
        $customer = $user->user;

        $date = Carbon::parse($user->user->last_login)->diffForHumans();

        return $this->render($response, 'app/viewCust.twig', [
            'user' => $user,
            'products' => $product,
            'customer' => $customer,
            'date' => $date,
        ]);
    }
}
