<?php

namespace App\Controller;


use App\Model\Status;
use App\Model\Product;
use App\Model\Customer;

use Awurth\Slim\Helper\Controller\Controller;
use Respect\Validation\Validator as V;
use Slim\Http\Request;
use Slim\Http\Response;


class ProductController extends Controller
{
    public function index($request, $response)
    {
//        $product = Product::with('status')->get();

        $product = Product::join('customer', 'product.user_id', '=', 'customer.id')
            ->join('repairStatus', 'product.id', '=', 'repairStatus.product_id')
            ->orderBy('product.id','ASC')
            ->get();

//        $product = Customer::with('product','product.status')->get();
//        $product->status;
//        dd($brand);

        //$product = Product::with('status')->get();

        return $this->render($response, 'app/productList.twig', [
            'products' => $product,
        ]);
    }

    public function repairWithCustomer(Request $request, Response $response)
    {
        $route = $request->getAttribute('route');
        $id = $route->getArguments('id');

        if ($request->isPost()) {

            $brand = $request->getParam('brand');
            $model = $request->getParam('model');
            $date = $request->getParam('date');
            $userid = $request->getParam('user_id');

            $product = ([
                'id' => $userid,
                'brand' => $brand,
                'model' => $model,
                'created_at' => $date,
                'part_id' => null,
                'user_id' => $userid,
            ]);

            Product::create($product);

            $this->flash('success', 'New repair has been created.');
            return $this->redirect($response, 'view');
        }
        return $this->render($response, 'app/newRepair.twig',[
            'id' => $id,
        ]);
    }

    //
    public function update(Request $request, Response $response)
    {
        $route = $request->getAttribute('route');
        $id = $route->getArguments('id');

        $technician = Status::join('staff', 'repairStatus.staff_id', '=', 'staff.id')
            ->join('product', 'repairStatus.product_id', '=', 'product.id')
            ->where('product_id', '=', $id)
            ->first();




        if($request->isPut()){

            $staid = $request->getParam('id');
            $datef = $request->getParam('finished_date');
            $status = $request->getParam('status');
//            $staff = $request->getParam('staff_id');
//            $product = $request->getParam('product_id');

            settype($status,'boolean');


            $statusData = ([
                'id' => $staid,
                'finished_date' => $datef,
                'status' => $status,
//                'staff_id' => $staff,
//                'product_id' => $product,
            ]);

            $ss = Status::where($id)->first();
            $ss->update($statusData);

            $this->flash('success', 'Repair has been updated.');
            return $this->redirect($response, 'product');
        }
        return $this->render($response, 'app/productUpd.twig', [
            'technician' => $technician,
        ]);
    }


    public function updateStatus(Request $request, Response $response)
    {
        $route = $request->getAttribute('route');
        $id = $route->getArguments('id');

        $technician = Status::join('staff', 'repairStatus.staff_id', '=', 'staff.id')
            ->join('product', 'repairStatus.product_id', '=', 'product.id')
            ->where('product_id', '=', $id)
            ->first();

        if($request->isPut()) {

            $staid = $request->getParam('id');
            $date = $request->getParam('finished_date');
            $status = $request->getParam('staff_id');
            $product = $request->getParam('product_id');

            $statusData = ([
                'id' => $staid,
                'finished_date' => $date,
                'status' => $status,
                'staff_id' => $staff,
                'product_id' => $product,
            ]);

            $technician->update($statusData);
            $this->flash('success', 'Profile has been updated.');
            return $this->redirect($response, 'view');

        }
        return $this->render($response, 'app/productSta.twig', [
            'technician' => $technician,
        ]);
    }

    public function filter(Request $request, Response $response)
    {
        $method = 'brand';

        if ($request->isPost())
            $search = $request->getParam('search');

        $product = Status::join('staff', 'repairStatus.staff_id', '=', 'staff.id')
            ->join('product', 'repairStatus.product_id', '=', 'product.id')
            ->where($method,'=',$search)
            ->get();

        return $this->render($response, 'app/productList.twig', [
                'products' => $product,
            ]);
    }
}
//$product = Product::where($id)->firstOrFail();
//
//        if ($request->isPut()) {
//
//            $proid = $request->getParam('id');
//            $date = $request->getParam('finished_date');
//            $status = $request->getParam('staff_id');
//            $product = $request->getParam('product_id');
//
//            $productData = ([
//                'id' => $pro,
//                'finished_date' => $date,
//                'status' => $status,
//                'staff_id' => $staff,
//                'product_id' => $productid,
//            ]);
