<?php
namespace App\Http\Controllers;

use App\Services\InitCubeSummation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;

class CubeSummationController extends Controller
{

    private $initCube;

    public function __construct (InitCubeSummation $initCube)
    { 
        $this->initCube = $initCube;
    }

    public function create ()
    {
        $routePost = route('post');
        return view('index', compact($routePost) )->with( ['routePost' => $routePost] );
    }

    public function store (Request $request)
    {
        $response = $this->initCube->init($request->all());
        return Response::json(['response' => $response]);
    }

}
