<?php namespace App\Validations;

use App\Repositories\QuerySummationRepository as QuerySummation;

class CubeSummationValidation{

    private $querySummation;

    function __construct(QuerySummation $querySummation) {
        $this->querySummation = $querySummation;
    }

	public function validations($cube, $numberCases, $lengthCube, $numberOperations, $queryUpdate, $query, $v1, $v2, $v3, $v4, $v5, $v6)
    {   
        $sumCube = 0;
        if( (1 <= $numberCases) && ($numberCases <= 50) ){
            if( (1 <= $lengthCube) && ($lengthCube <= 100) ){
                if( (1 <= $numberOperations) && ($numberOperations <= 1000) ){
                    if( (1 <= $v1) && ($v1 <= $v4) && ($v4 <= $lengthCube) ){
                        if( (1 <= $v2) && ($v2 <= $v5) && ($v5 <= $lengthCube) ){
                            if( (1 <= $v3) && ($v3 <= $v6) && ($v6 <= $lengthCube) ){
                                if( ((1 <= $queryUpdate['x']) && (1 <= $queryUpdate['y']) && (1 <= $queryUpdate['z'])) && (($queryUpdate['x'] <= $lengthCube) && ($queryUpdate['y'] <= $lengthCube) && ($queryUpdate['z'] <= $lengthCube)) ){
                                    if( (pow(-10,9) <= $queryUpdate['W']) && ($queryUpdate['W'] <= pow(10,9)) ){
                                        $sumCube = $this->querySummation->sumQuery($query, $cube);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return "resultado: ".$sumCube."\n";
    }
}
