<?php

namespace App\Controller;


use App\Model\Status;
use Awurth\Slim\Helper\Controller\Controller;


class ProductController extends Controller
{
    public function index($request, $response)
    {
        $product = Status::join('product','repairStatus.product_id','=','product.id')
            ->join('customer','product.cust_id','=','customer.user_id')
            ->orderBy('product.id', 'DESC')
            ->get();
        return $this->render($response, 'app/productList.twig', [
            'products' => $product,
        ]);
    }
    public function update($request, $response)
    {
        $technician = Status::join('staff','repairStatus.staff_id','=','staff.id')
            ->join('product','repairStatus.product_id','=','product.id')
            ->where('product_id','=',20)
            ->first();
        return $this->render($response, 'app/productUpd.twig',[
            'technician' => $technician,
        ]);
    }
    public function repairWithCustomer($request, $response)
    {
        return $this->render($response, 'app/newRepair.twig');
    }
    public function WithCustomer($request, $response,$next)
    {
        return $next($response,$request);
    }
    public function updateStatus($request, $response)
    {
        $technician = Status::join('staff','repairStatus.staff_id','=','staff.id')
            ->join('product','repairStatus.product_id','=','product.id')
            ->where('product_id','=',20)
            ->first();

        return $this->render($response, 'app/productSta.twig',[
            'technician' => $technician,
        ]);

    }
    public function filter($request,$response)
    {
        // Search for a user based on customer name.
        if ($request->has('name')) {
            return $user->where('name', $request->input('name'))->get();
        }

        // Search for a user based on their company.
        if ($request->has('company')) {
            return $user->where('company', $request->input('company'))
                ->get();
        }

        // Search for a user based on their city.
        if ($request->has('city')) {
            return $user->where('city', $request->input('city'))->get();
        }
    }

}