<?php  namespace App\Validations\InputTestCase;

use App\Validations\InputTestCase\ValueValidation;

class QueryValidation extends ValueValidation
{
	protected $attribute;
	protected $value;
	protected $rulesQueries 		= ['QUERY','UPDATE'];
	protected $rulesSizesQueries 	= [7,5];
	protected $size_matrix;

	public function input($attribute, $value, $parameters, $validator)
	{
		$this->attribute = $attribute;
		$this->isQuery($value);
		$this->value = $value;
		$positionSizeMatrix = ($attribute == 'query1') ? 0 : 1;
		$this->size_matrix = $this->getValueQueryPosition(session('size_matrix'), $positionSizeMatrix);
		$this->constraintCubeSummation();
		return true;
	}

	public function constraintCubeSummation()
	{
		foreach ($this->value as $key_query => $query) {
			$queryActual = $this->getArrayQuery($query);
			$wordQuery = $this->getValueFirstPosition($queryActual);

			if(stripos($wordQuery, 'QUERY') !== false){
				$this->isRange($this->getValueQueryPosition($queryActual,1) , 1, $this->getValueQueryPosition($queryActual,4));
				$this->isRange($this->getValueQueryPosition($queryActual,4) , $this->getValueQueryPosition($queryActual,1), $this->size_matrix);

				$this->isRange($this->getValueQueryPosition($queryActual,2) , 1, $this->getValueQueryPosition($queryActual,5));
				$this->isRange($this->getValueQueryPosition($queryActual,5) , $this->getValueQueryPosition($queryActual,2), $this->size_matrix);
			
				$this->isRange($this->getValueQueryPosition($queryActual,3) , 1, $this->getValueQueryPosition($queryActual,6));
				$this->isRange($this->getValueQueryPosition($queryActual,6) , $this->getValueQueryPosition($queryActual,3), $this->size_matrix);
			}
			else{
				$this->isRange($this->getValueQueryPosition($queryActual,1) , 1, $this->size_matrix);
				$this->isRange($this->getValueQueryPosition($queryActual,2) , 1, $this->size_matrix);
				$this->isRange($this->getValueQueryPosition($queryActual,3) , 1, $this->size_matrix);
				$this->isRange($this->getValueQueryPosition($queryActual,4) , pow(-10,9), pow(10,9));
			}
		}
	}	
}