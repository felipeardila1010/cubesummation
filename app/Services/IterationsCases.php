<?php namespace App\Services;

use App\Repositories\QuerySummationRepository as QuerySummation;
use App\Validations\CubeSummationValidation as CubeSummationValidation;

class IterationsCases{

    private $querySummation;
    private $cubeSummationValidation;
    private $response;

    function __construct(QuerySummation $querySummation, CubeSummationValidation $cubeSummationValidation) {
        $this->querySummation = $querySummation;
        $this->cubeSummationValidation = $cubeSummationValidation;
    }

	public function iterationsNumberTestCases($data, $numberCases, $valuesNM)
    {
    	for ($iterationtestcase = 0; $iterationtestcase < $numberCases; $iterationtestcase++) {
            $nm = $valuesNM[$iterationtestcase];
            $lengthCube = explode(' ', $nm)[0];
            $numberOperations = explode(' ', $nm)[1];
            $cube   = $this->querySummation->initCube($lengthCube);
            $query  = $this->querySummation->setQueries($data);
            $this->response .= " SALIDA DE VALORES N = ".$lengthCube." y M = ".$numberOperations."\n";
            $this->iterationsNumberOperations($iterationtestcase, $numberOperations, $query, $cube, $numberCases, $lengthCube);               
        }
        return $this->response;
    }

    public function iterationsNumberOperations($iterationtestcase, $numberOperations, $query, $cube, $numberCases, $lengthCube)
    {
        for ($iterationoperation = 0; $iterationoperation < $numberOperations ; $iterationoperation++) {
            $query_actual = explode(' ', $query[$iterationtestcase][$iterationoperation]);
            $word_query = $query_actual[0];
            
            if(stripos($word_query, "UPDATE") !== false){
                $queryUpdate = $this->querySummation->setDataUpdate($query_actual);
                $cube[$queryUpdate['x']][$queryUpdate['y']][$queryUpdate['z']] = $queryUpdate['W'];
            }
            else if(stripos($word_query, "QUERY") !== false){
                $this->response .= $this->cubeSummationValidation->validations($cube,
                                                            $numberCases,
                                                            $lengthCube,
                                                            $numberOperations,
                                                            $queryUpdate,
                                                            $query_actual,
                                                            $query_actual[1],
                                                            $query_actual[2],
                                                            $query_actual[3],
                                                            $query_actual[4],
                                                            $query_actual[5],
                                                            $query_actual[6]
                                                            );
            }
        }
    }
}
