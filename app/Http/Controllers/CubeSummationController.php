<?php
namespace App\Http\Controllers;

use App\Http\Requests\CubeSummationRequest;
use App\Services\InputCubeSummationService;
use App\Services\IterationCasesService;

use Illuminate\Http\Request;
use Response;

class CubeSummationController extends Controller
{
    public $iterationCasesService;

    public function __construct (IterationCasesService $iterationCasesService)
    { 
        $this->iterationCasesService = $iterationCasesService;
    }

    public function create ()
    {
        return view('index');
    }

    public function store (CubeSummationRequest $request)
    {
        $resultQueries = $this->iterationCasesService->iterationsNumberTestCases($request->all());
        return view('store',compact('resultQueries'));
    }

}
