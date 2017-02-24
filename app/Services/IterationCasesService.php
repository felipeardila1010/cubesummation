<?php namespace App\Services;

use App\Entities\CubeSummationEntity;

class IterationCasesService{

    private $cubeSummationEntity;

    function __construct(CubeSummationEntity $cubeSummationEntity) {
        $this->cubeSummationEntity = $cubeSummationEntity;        
    }

	public function iterationsNumberTestCases($data)
    {
        $this->cubeSummationEntity->setResultQueries('cube.output.number_test_case', $data['number_test_case']);

    	for ($iterationtestcase = 0; $iterationtestcase < $data['number_test_case']; $iterationtestcase++) {
            $data   = $this->cubeSummationEntity->getSizeMatrixAndNumberOperations($data, $iterationtestcase);
            $this->cubeSummationEntity->initCube($data['length_cube']);            
            $queries  = $this->cubeSummationEntity->getQueries($data);
            $this->cubeSummationEntity->setResultQueries('cube.output.size_matrix_and_number_operations', $data['length_cube'].' '.$data['number_operations']);
            $this->iterationsNumberOperations($data, $queries, $iterationtestcase);
        }
        
        return $this->cubeSummationEntity->resultQueries;
    }

    public function iterationsNumberOperations($data, $queries, $iterationtestcase)
    {
        for ($iterationoperation = 0; $iterationoperation < $data['number_operations'] ; $iterationoperation++) {
            $queryActual  = $this->cubeSummationEntity->getArrayQuery($queries[$iterationtestcase][$iterationoperation]);
            $wordQuery = $this->cubeSummationEntity->getValueFirstPosition($queryActual);
            $this->querySelection($data, $queryActual, $wordQuery);
        }
    }

    public function querySelection($data, $queryActual, $wordQuery)
    {
        if(stripos($wordQuery, 'UPDATE') !== false){
            $this->cubeSummationEntity->queryUpdate = $this->cubeSummationEntity->setDataQueryUpdate($queryActual);
        }
        else if(stripos($wordQuery, 'QUERY') !== false){
            $sumCube = 0;
            $sumCube = $this->cubeSummationEntity->sumQuery($queryActual);
            $this->cubeSummationEntity->setResultQueries('cube.output.result_queries', $sumCube);
        }
    }
}
