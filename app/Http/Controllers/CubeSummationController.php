<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class CubeSummationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function index()
    {
        $this->T = 1; // 1 VALOR DE ENTRADA (NUMERO DE CASOS DE PRUEBA)

        for ($i=0; $i < $this->T; $i++) { // NUMERO DE CASOS DE PRUEBA

            $nm = "4 5"; // 2 VALOR DE ENTRADA (NY M)
            //$nm = "2 4"; // 2 VALOR DE ENTRADA (NY M)
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

            for ($j=0; $j < $this->M ; $j++) { // NUMERO DE OPERACIONES
                $query = ["UPDATE 2 2 2 4","QUERY 1 1 1 3 3 3","UPDATE 1 1 1 23","QUERY 2 2 2 4 4 4","QUERY 1 1 1 3 3 3"]; // 3 VALOR DE ENTRADA (consultas)
                //$query = ["UPDATE 2 2 2 1","QUERY 1 1 1 1 1 1","QUERY 1 1 1 2 2 2","QUERY 2 2 2 2 2 2"]; // 3 VALOR DE ENTRADA (consultas)
                $query = explode(' ', $query[$j]);
                $word_query = $query[0];
                
                if(stripos($word_query, "UPDATE") !== false){
                    CubeSummationController::updateVector($query[1],$query[2],$query[3],$query[4]);
                }
                else if(stripos($word_query, "QUERY") !== false){
                    CubeSummationController::validations($query,$query[1],$query[2],$query[3],$query[4],$query[5],$query[6]);
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
        print_r("  valor: ".$this->sum);
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
