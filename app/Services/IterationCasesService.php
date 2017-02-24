<?php namespace App\Services;

use App\Entities\CubeSummationEntity;
use App\Validations\CubeSummationValidation;

class IterationCasesService{

    private $cubeSummationEntity;
    private $cubeSummationValidation;

    function __construct(CubeSummationEntity $cubeSummationEntity, CubeSummationValidation $cubeSummationValidation) {
        $this->cubeSummationEntity = $cubeSummationEntity;
        $this->cubeSummationValidation = $cubeSummationValidation;
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
            $this->cubeSummationValidation->querySelection($data, $queryActual, $wordQuery, $this->cubeSummationEntity);
        }
    }
}
