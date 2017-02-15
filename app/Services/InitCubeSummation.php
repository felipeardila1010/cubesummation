<?php namespace App\Services;

use App\Repositories\QuerySummationRepository as QuerySummation;
use App\Services\IterationsCases;

class InitCubeSummation{

	public $response;
	public $iterationCase;

	function __construct(IterationsCases $iterationCase) {
		$this->iterationCase = $iterationCase;
		$this->response = "";
	}

	public function init($data)
    {
        $numberCases 	  = $data['T'];
        $valuesNM 		  = $data['NyM'];
        $this->response = $this->iterationCase->iterationsNumberTestCases($data, $numberCases, $valuesNM);
        return $this->response;
    }
}
