<?php
namespace App\Http\Controllers;

use App\Repositories\QuerySummationRepository;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;

class CubeSummationController extends Controller
{

    private static $_ROUTEPOSTCUBESUMMATION = 'post';
    private $_cube;
    private $_numberCases;
    private $_lengthCube;
    private $_numberOperations;
    private $_x;
    private $_y;
    private $_z;
    private $_W;
    private $_response;
    private $_objQuerySummation;

    public function __construct (QuerySummationRepository $querySummation)
    { 
        $this->_objQuerySummation = $querySummation;
    }

    public function create ()
    {
        $routePost = route(self::$_ROUTEPOSTCUBESUMMATION);
        return view('index', compact($routePost) )->with( ['routePost' => $routePost] );
    }

    public function store (Request $request)
    {
        $this->_numberCases = (int) $request->input('T');
        $valuesNM = [$request->input('NyM1'), $request->input('NyM2')];
        $this->_response = "SALIDA DE NUMERO DE CASO DE PRUEBA (T) = ".$this->_numberCases."\n\n";

        for ($a=0; $a < $this->_numberCases; $a++) {

            $nm= $valuesNM[$a];
            $this->_lengthCube = (int) explode(' ', $nm)[0];
            $this->_numberOperations= (int) explode(' ', $nm)[1];
            $this->_cube[$this->_lengthCube][$this->_lengthCube][$this->_lengthCube];
            $this->_cube = $this->_objQuerySummation->initCube($this->_cube,$this->_lengthCube);
            $query[0] = [ $request->input('query1') ][0]; 
            $query[1] = [ $request->input('query2') ][0]; 

            $this->_response .= " SALIDA DE VALORES N = ".$this->_lengthCube." y M = ".$this->_numberOperations."\n";
            
            for ($j=0; $j < $this->_numberOperations ; $j++) {
                $query_actual = explode(' ', $query[$a][$j]);
                $word_query = $query_actual[0];
                
                if(stripos($word_query, "UPDATE") !== false){
                    $this->_x = $query_actual[1];
                    $this->_y = $query_actual[2];
                    $this->_z = $query_actual[3];
                    $this->_W = $query_actual[4];
                    $this->_cube[$this->_x][$this->_y][$this->_z] = $this->_W;
                }
                else if(stripos($word_query, "QUERY") !== false){
                    CubeSummationController::validations($query_actual,
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
        return Response::json(['response' => $this->_response]);
    }

    public function validations($query, $v1, $v2, $v3, $v4, $v5, $v6)
    {   
        $sumCube = 0;
        if( (1 <= $this->_numberCases) && ($this->_numberCases <= 50) ){
            if( (1 <= $this->_lengthCube) && ($this->_lengthCube <= 100) ){
                if( (1 <= $this->_numberOperations) && ($this->_numberOperations <= 1000) ){
                    if( (1 <= $v1) && ($v1 <= $v4) && ($v4 <= $this->_lengthCube) ){
                        if( (1 <= $v2) && ($v2 <= $v5) && ($v5 <= $this->_lengthCube) ){
                            if( (1 <= $v3) && ($v3 <= $v6) && ($v6 <= $this->_lengthCube) ){
                                if( ((1 <= $this->_x) && (1 <= $this->_y) && (1 <= $this->_z)) && (($this->_x <= $this->_lengthCube) && ($this->_y <= $this->_lengthCube) && ($this->_z <= $this->_lengthCube)) ){
                                    if( (pow(-10,9) <= $this->_W) && ($this->_W <= pow(10,9)) ){
                                        $sumCube = $this->_objQuerySummation->sumQuery($query, $this->_cube);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $this->_response .= "resultado: ".$sumCube."\n";
    }

}
