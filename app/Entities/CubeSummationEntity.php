<?php namespace App\Entities;

use Lang;

class CubeSummationEntity
{
    public $cube;
    public $queryUpdate;
    public $resultQueries;

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
    }

    public function divideValues($value, $position)
    {
        return explode(' ', $value)[$position];
    }

    public function sumQuery($query)
    {
        $sumCube = 0;
        for ($i=$query[1]; $i <= $query[4] ; $i++) { 
            for ($j=$query[2]; $j <= $query[5]; $j++) { 
                for ($k=$query[3]; $k <= $query[6]; $k++) { 
                    $sumCube += $this->cube[$i][$j][$k];
                }
            }
        }
        return $sumCube;
    }

    public function getArrayQuery($value)
    {
        return explode(' ', $value);
    }

    public function getValueFirstPosition($array)
    {
        return $array[0];
    }

    public function getSizeMatrixAndNumberOperations($data, $iterationtestcase)
    {
        $size_matrix_and_number_operations = $data['size_matrix_and_number_operations'][$iterationtestcase];
        $data['length_cube'] = $this->divideValues($size_matrix_and_number_operations, 0);
        $data['number_operations'] = $this->divideValues($size_matrix_and_number_operations, 1);
        return $data;
    }

    public function setQueries($data)
    {
        $query[0] = $data['query1'];
        $query[1] = $data['query2'];
        return $query;
    }

    public function setDataQueryUpdate($query_actual)
    {
        $queryUpdate['x'] = $query_actual[1];
        $queryUpdate['y'] = $query_actual[2];
        $queryUpdate['z'] = $query_actual[3];
        $queryUpdate['W'] = $query_actual[4];
        $this->cube[$queryUpdate['x']][$queryUpdate['y']][$queryUpdate['z']] = $queryUpdate['W'];
        return $queryUpdate;
    }

    public function setResultQueries($message, $value)
    {
        $this->resultQueries[] = Lang::get($message).' '.$value;
    }
}
