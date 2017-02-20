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
        $this->cubeSummationEntity->setResultQueries('validation.cube.output.number_test_case', $data['number_test_case']);

    	for ($iterationtestcase = 0; $iterationtestcase < $data['number_test_case']; $iterationtestcase++) {
            $data   = $this->cubeSummationEntity->getSizeMatrixAndNumberOperations($data, $iterationtestcase);
            $this->cubeSummationEntity->initCube($data['length_cube']);            
            $query  = $this->cubeSummationEntity->setQueries($data);
            $this->cubeSummationEntity->setResultQueries('validation.cube.output.size_matrix_and_number_operations', $data['length_cube'].' '.$data['number_operations']);
            $this->iterationsNumberOperations($data, $query, $iterationtestcase);
        }
        return $this->cubeSummationEntity->resultQueries;
    }

    public function iterationsNumberOperations($data, $query, $iterationtestcase)
    {
        for ($iterationoperation = 0; $iterationoperation < $data['number_operations'] ; $iterationoperation++) {
            $query_actual  = $this->cubeSummationEntity->getArrayQuery($query[$iterationtestcase][$iterationoperation]);
            $word_query = $this->cubeSummationEntity->getValueFirstPosition($query_actual);
            $this->cubeSummationValidation->querySelection($data, $query_actual, $word_query, $this->cubeSummationEntity);
        }
    }
}
