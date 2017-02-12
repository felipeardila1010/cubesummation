<?php namespace App\Entities;

use App\Services\QuerySummation as QuerySummationService;

class QuerySummation
{

	private $_objQuerySummationService;

    public function sumQuery($query, $cube)
    {
    	$this->_objQuerySummationService = new QuerySummationService;
    	return $this->_objQuerySummationService->sumQuery($query,$cube);
    }

    public function initCube($cube, $lengthCube)
    {
    	$this->_objQuerySummationService = new QuerySummationService;
    	return $this->_objQuerySummationService->initCube($cube, $lengthCube);
    }

}
