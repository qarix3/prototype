<?php

namespace App\Controller;

use Awurth\Slim\Helper\Controller\Controller;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Model\Part;
use App\Model\User;

class AppController extends Controller
{
    public function home(Request $request, Response $response)
    {    $userTable = User::with('customer')->orderBy('user.id','DESC')
        ->first();

        return $this->render($response, 'app/home.twig',[
            'user' => $userTable,
        ]);
    }

    public function dashboard(Request $request, Response $response)
    {
        return $this->render($response, 'app/dashboard.twig');
    }

    public function index($request, $response)
    {
        return $this->render($response, 'app/sparepart.twig',[
            'repairs' => Part::all(),
        ]);
    }

    public function parts(Request $request, Response $response)
    {
        if($request->isPost()) {
            $search = $request->getParam('search');
            $type = 'id';
        }

        $repairs = Part::where($type,'=',$search)->get();

        return $this->render($response, 'app/sparepart.twig',[
            'repairs' => $repairs,
        ]);

    }

}
