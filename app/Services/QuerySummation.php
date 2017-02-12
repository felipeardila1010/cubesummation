<?php namespace App\Services;

use App\Entities\QuerySummation;

class QuerySummation extends QuerySummation{

	public function sumQuery($query, $cube)
    {
    	$sumCube = 0;
      	for ($i=$query[1]; $i <= $query[4] ; $i++) { 
            for ($j=$query[2]; $j <= $query[5]; $j++) { 
                for ($k=$query[3]; $k <= $query[6]; $k++) { 
                    $sumCube += $cube[$i][$j][$k];
                }
            }
        }

        return $sumCube;
    }

    public function initCube($cube,$lengthCube)
    {
        for ($i=0; $i <= $lengthCube; $i++) { 
            for ($j=0; $j <= $lengthCube; $j++) { 
                for ($k=0; $k <= $lengthCube; $k++) { 
                    $cube[$i][$j][$k] = 0;
                }
            }
        }
        return $cube;
    }
}
