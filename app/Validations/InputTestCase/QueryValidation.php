<?php  namespace App\Validations\InputTestCase;

use App\Validations\InputTestCase\ValueValidation;

class QueryValidation extends ValueValidation
{
	protected $attribute;
	protected $value;
	protected $nameErrorSizeNumberOperations = 'size_number_operations';
	protected $nameErrorSizeValueQueries = 'size_value_queries';
	protected $nameErrorWordQuery = 'word_query';
	protected $rulesQueries 		= ['QUERY','UPDATE'];
	protected $rulesSizesQueries 	= [7,5];
	protected $sizesMatrixAndNumberOperations;

	function __construct($attribute, $value, $numberTestCase, $sizesMatrixAndNumberOperations) {
		$this->sizesMatrixAndNumberOperations = $sizesMatrixAndNumberOperations;
		$this->attribute = $attribute;
		$this->value = $value[$attribute];
		$this->value = $this->validateSizeAllQueriesIterations(
				$this->value, 
				$this->nameErrorSizeNumberOperations, 
				$this->nameErrorSizeValueQueries, 
				$this->sizesMatrixAndNumberOperations, 
				$this->rulesSizesQueries
				);
		$this->constraintCubeSummation();
	}

	public function constraintCubeSummation()
	{
		foreach ($this->value as $key_queries => $queries) {
			$valueSizeMatrix = $this->getValueDividePosition($this->sizesMatrixAndNumberOperations[$key_queries], 0);
			$this->IterationByQuery($queries, $valueSizeMatrix);
		}
	}

	public function IterationByQuery($queries, $valueSizeMatrix)
	{
		foreach ($queries as $key_query => $query) {
			$queryActual = $this->getArrayQuery($query);
			$wordQuery = $this->getValueFirstPosition($queryActual);

			if(stripos($wordQuery, 'QUERY') !== false){
				$this->isRange($this->getValueQueryPosition($queryActual, 1) , 1, $this->getValueQueryPosition($queryActual, 4));
				$this->isRange($this->getValueQueryPosition($queryActual, 4) , $this->getValueQueryPosition($queryActual,1), $valueSizeMatrix);

				$this->isRange($this->getValueQueryPosition($queryActual, 2) , 1, $this->getValueQueryPosition($queryActual, 5));
				$this->isRange($this->getValueQueryPosition($queryActual, 5) , $this->getValueQueryPosition($queryActual, 2), $valueSizeMatrix);
			
				$this->isRange($this->getValueQueryPosition($queryActual, 3) , 1, $this->getValueQueryPosition($queryActual, 6));
				$this->isRange($this->getValueQueryPosition($queryActual, 6) , $this->getValueQueryPosition($queryActual, 3), $valueSizeMatrix);
			}
			else{
				$this->isRange($this->getValueQueryPosition($queryActual, 1) , 1, $valueSizeMatrix);
				$this->isRange($this->getValueQueryPosition($queryActual, 2) , 1, $valueSizeMatrix);
				$this->isRange($this->getValueQueryPosition($queryActual, 3) , 1, $valueSizeMatrix);
				$this->isRange($this->getValueQueryPosition($queryActual, 4) , pow(-10,9), pow(10,9));
			}

		}

	}	
}