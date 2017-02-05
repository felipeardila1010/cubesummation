<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CubeSummationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CubeController Controller
    |--------------------------------------------------------------------------
    |
    | Estre controlador captura los datos estaticos ingresados para realizar el
    | procedimiento.
    | 
    |
    */

    private $N_matrix;
    private $T;
    private $N;
    private $M;
    private $W;
    private $x;
    private $y;
    private $z;
    private $sum;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function create()
    {
        $route_post = route('post');
        return view('index',compact($route_post))->with([ 'route_post' => $route_post ]);
    }

    public function store(Request $request)
    {
        $NyM = [$request->input('NyM1'),$request->input('NyM2')];
        $this->T = (int) $request->input('T'); // 1 VALOR DE ENTRADA (NUMERO DE CASOS DE PRUEBA)
        
        print_r("SALIDA DE NUMERO DE CASO DE PRUEBA (T) = ".$this->T."<br><br>");
        for ($a=0; $a < $this->T; $a++) { // NUMERO DE CASOS DE PRUEBA

            $nm = $NyM[$a]; // 2 VALOR DE ENTRADA (NY M)
            
            $this->N = (int) explode(' ', $nm)[0]; // SEPARACION DEL VALOR N
            $this->M = (int) explode(' ', $nm)[1]; // SEPARACION DEL VALOR M (NUMERO DE OPERACIONES)
            $this->N_matrix[$this->N][$this->N][$this->N];
            for ($i=0; $i <= $this->N; $i++) { 
                for ($j=0; $j <= $this->N; $j++) { 
                    for ($k=0; $k <= $this->N; $k++) { 
                        $this->N_matrix[$i][$j][$k] = 0;
                    }
                }
            }

            $query[0] = [$request->input('query1'),$request->input('query2'),$request->input('query3'),$request->input('query4'),$request->input('query5')]; 
            $query[1] = [$request->input('query6'),$request->input('query7'),$request->input('query8'),$request->input('query9')]; 

            print_r(" SALIDA DE VALORES N = ".$this->N." y M = ".$this->M."<br>");

            for ($j=0; $j < $this->M ; $j++) { // NUMERO DE OPERACIONES
                $query_actual = explode(' ', $query[$a][$j]);
                $word_query = $query_actual[0];
                
                if(stripos($word_query, "UPDATE") !== false){
                    CubeSummationController::updateVector($query_actual[1],$query_actual[2],$query_actual[3],$query_actual[4]);
                }
                else if(stripos($word_query, "QUERY") !== false){
                    CubeSummationController::validations($query_actual,$query_actual[1],$query_actual[2],$query_actual[3],$query_actual[4],$query_actual[5],$query_actual[6]);
                }

            }
            
        }
    }

    public function updateVector($x,$y,$z,$W)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->W = $W;
        $this->N_matrix[$x][$y][$z] = $W;
    }

    public function validations($query,$v1,$v2,$v3,$v4,$v5 = null,$v6 = null)
    {   
        // CONSTRAINS
        if( (1 <= $this->T) && ($this->T <= 50) ){
            if( (1 <= $this->N) && ($this->N <= 100) ){
                if( (1 <= $this->M) && ($this->M <= 1000) ){
                    if( (1 <= $v1) && ($v1 <= $v4) && ($v4 <= $this->N) ){
                        if( (1 <= $v2) && ($v2 <= $v5) && ($v5 <= $this->N) ){
                            if( (1 <= $v3) && ($v3 <= $v6) && ($v6 <= $this->N) ){
                                if( ((1 <= $this->x) && (1 <= $this->y) && (1 <= $this->z)) && (($this->x <= $this->N) && ($this->y <= $this->N) && ($this->z <= $this->N)) ){
                                    if( (pow(-10,9) <= $this->W) && ($this->W <= pow(10,9)) ){
                                        CubeSummationController::sumQuery($query);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        print_r("resultado: <b>".$this->sum."</b>");
        print_r("<br>");
        $this->sum = 0;
    }

    public function sumQuery($query)
    {
        for ($i=$query[1]; $i <= $query[4] ; $i++) { 
            for ($j=$query[2]; $j <= $query[5]; $j++) { 
                for ($k=$query[3]; $k <= $query[6]; $k++) { 
                    $this->sum += $this->N_matrix[$i][$j][$k];
                }
            }
        }
    }

}
