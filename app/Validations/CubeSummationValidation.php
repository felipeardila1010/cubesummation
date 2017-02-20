<?php namespace App\Validations;

use App\Validations\InputTestCase\NumberTestCaseValidation;

class CubeSummationValidation{

    private $cubeSummationEntity;

    public function querySelection($data, $queryActual, $wordQuery, $objCubeSummationEntity)
    {
        if(stripos($wordQuery, 'UPDATE') !== false){
            $objCubeSummationEntity->queryUpdate = $objCubeSummationEntity->setDataQueryUpdate($queryActual);
        }
        else if(stripos($wordQuery, 'QUERY') !== false){
            $sumCube = 0;
            $sumCube = $objCubeSummationEntity->sumQuery($queryActual);
            $objCubeSummationEntity->setResultQueries('validation.cube.output.result_queries', $sumCube);
        }
    }
}
