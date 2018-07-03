<?php
namespace App\Controller;

use Awurth\Slim\Helper\Controller\Controller;
use App\Model\Staff;
use Slim\Http\Request;
use Slim\Http\Response;

class StaffController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $staff = Staff::join('job','staff.job_id','=','job.jobid')->get();
        return $this->render($response, 'app/staffList.twig', [
            'staffs' => $staff,
        ]);
    }
}