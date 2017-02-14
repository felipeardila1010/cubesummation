<?php namespace App\Entities;

class QuerySummation
{
    
    private $cube;

    public function initCube($lengthCube)
    {        
        $this->cube[$lengthCube][$lengthCube][$lengthCube];

        for ($i=0; $i <= $lengthCube; $i++) { 
            for ($j=0; $j <= $lengthCube; $j++) { 
                for ($k=0; $k <= $lengthCube; $k++) { 
                    $this->cube[$i][$j][$k] = 0;
                }
            }
        }
        return $this->cube;
    }

    public function setQueries($data)
    {
        $query[0] = $data['query1'];
        $query[1] = $data['query2'];
        return $query;
    }

    public function setDataUpdate($query_actual)
    {
        $queryUpdate['x'] = $query_actual[1];
        $queryUpdate['y'] = $query_actual[2];
        $queryUpdate['z'] = $query_actual[3];
        $queryUpdate['W'] = $query_actual[4];
        return $queryUpdate;
    }

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
}
