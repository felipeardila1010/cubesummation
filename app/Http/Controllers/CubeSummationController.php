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

    /*
    |--------------------------------------------------------------------------
    | CubeController Controller Function create()
    |--------------------------------------------------------------------------
    |
    | Redirecciona a la vista del formulario a realizar.
    |
    */
    public function create()
    {
        $route_post = route('post');
        return view('index',compact($route_post))->with([ 'route_post' => $route_post ]);
    }

    /*
    |--------------------------------------------------------------------------
    | CubeController Controller Function store(Request $request)
    |--------------------------------------------------------------------------
    |
    | La respuesta Post del formulario en la vista
    |
    */
    public function store(Request $request)
    {
        $this->T = (int) $request->input('T'); // Primer valor de entrada de numero de casos T
        $NyM = [$request->input('NyM1'),$request->input('NyM2')]; // Segundo valor de entrada siendo Arreglo de 2 valores insertados de N y M
        
        print_r("SALIDA DE NUMERO DE CASO DE PRUEBA (T) = ".$this->T."<br><br>");

        for ($a=0; $a < $this->T; $a++) { // Reiteracion de numeros de casos

            $nm = $NyM[$a]; // Separacion de valores de N y M
            
            $this->N = (int) explode(' ', $nm)[0]; // Separacion de valor N
            $this->M = (int) explode(' ', $nm)[1]; // Seperacion de valor M
            $this->N_matrix[$this->N][$this->N][$this->N]; // Matriz del Cubo N*N*N

            /*Inicialización de valores en 0 del Cubo */
            for ($i=0; $i <= $this->N; $i++) { 
                for ($j=0; $j <= $this->N; $j++) { 
                    for ($k=0; $k <= $this->N; $k++) { 
                        $this->N_matrix[$i][$j][$k] = 0;
                    }
                }
            }
            /*Fin*/

            /*Separación de consultas a realizar (Estaticas)*/
            $query[0] = [$request->input('query1'),$request->input('query2'),$request->input('query3'),$request->input('query4'),$request->input('query5')]; 
            $query[1] = [$request->input('query6'),$request->input('query7'),$request->input('query8'),$request->input('query9')]; 
            /*Fin*/

            print_r(" SALIDA DE VALORES N = ".$this->N." y M = ".$this->M."<br>");

            for ($j=0; $j < $this->M ; $j++) { // Reiteracion de numeros de operaciones
                $query_actual = explode(' ', $query[$a][$j]);
                $word_query = $query_actual[0];
                
                if(stripos($word_query, "UPDATE") !== false){ // Validación de consulta update
                    CubeSummationController::updateVector($query_actual[1],$query_actual[2],$query_actual[3],$query_actual[4]);
                }
                else if(stripos($word_query, "QUERY") !== false){ // Validación de consulta query
                    CubeSummationController::validations($query_actual,$query_actual[1],$query_actual[2],$query_actual[3],$query_actual[4],$query_actual[5],$query_actual[6]);
                }

            }
            
        }
    }

    /*
    |--------------------------------------------------------------------------
    | CubeController Controller Function updateVector($x,$y,$z,$W)
    |--------------------------------------------------------------------------
    |
    | Guarda los valores de x,y,z y N_matriz
    |
    */
    public function updateVector($x,$y,$z,$W)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->W = $W;
        $this->N_matrix[$x][$y][$z] = $W;
    }

    /*
    |--------------------------------------------------------------------------
    | CubeController Controller Function validations($query,$v1,$v2,$v3,$v4,$v5,$v6)
    |--------------------------------------------------------------------------
    |
    | Realiza todas las restricciones expuestas en el problema y redirige para la suma de los valores
    |
    */
    public function validations($query,$v1,$v2,$v3,$v4,$v5,$v6)
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

    /*
    |--------------------------------------------------------------------------
    | CubeController Controller Function sumQuery($query)
    |--------------------------------------------------------------------------
    |
    |Realiza la suma de los valores entre los valores del cubo sea el valor de los bloques cuyas coordenadas x está entre x1 y x2 (ambos inclusive), la |coordenada y entre Y1 e Y2 (ambos inclusive) y coordenada z entre Z1 y Z2 (ambos inclusive).
    |
    */
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
