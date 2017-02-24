<?php
namespace App\Http\Controllers;

use App\Http\Requests\CubeSummationRequest;
use App\Services\InputCubeSummationService;
use App\Services\IterationCasesService;

use Illuminate\Http\Request;

class CubeSummationController extends Controller
{
    public $iterationCasesService;

    public function __construct (IterationCasesService $iterationCasesService)
    { 
        $this->iterationCasesService = $iterationCasesService;
    }

    public function storeJson (CubeSummationRequest $request)
    {
        $resultQueries = $this->iterationCasesService->iterationsNumberTestCases($request->all()['test_cases']);
        return response()->json($resultQueries);
    }

}
