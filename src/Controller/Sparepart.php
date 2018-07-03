<?php

namespace App\Controller;

use App\Model\Part;
use Awurth\Slim\Helper\Controller\Controller;

class Sparepart extends Controller
{
    public function index($request, $response)
    {
        return $this->render($response, 'app/sparepart.twig',[
            'repairs' => Part::all(),
        ]);
    }
}