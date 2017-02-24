<?php  namespace App\Validations\InputTestCase;

use App\Validations\InputTestCase\NumberTestCaseValidation;
use App\Validations\InputTestCase\SizeMatrixAndNumberOperationsCubeValidation;
use App\Validations\InputTestCase\QueryValidation;

use App\Validations\InputTestCase\ValueValidation;

class TestCasesValidation extends ValueValidation
{
	protected $numberTestCaseValidation;
	protected $sizeMatrixAndNumberOperationsValidation;
	protected $QueryValidation;

	function __construct(NumberTestCaseValidation $numberTestCaseValidation) {
		$this->numberTestCaseValidation = $numberTestCaseValidation;

	}

	public function input($attribute, $value, $parameters, $validator)
	{
		$numberTestCase = $this->numberTestCaseValidation->input('number_test_case', $value);
		$this->sizeMatrixAndNumberOperationsValidation = new SizeMatrixAndNumberOperationsCubeValidation(
					'size_matrix_and_number_operations', 
					$value, 
					$numberTestCase
				);
		$sizesMatrixAndNumberOperations = $this->sizeMatrixAndNumberOperationsValidation->getSizesMatrixAndNumberOperations();
		$this->QueryValidation = new QueryValidation('queries', $value, $numberTestCase, $sizesMatrixAndNumberOperations);

		return true;
	}

	public function constraintCubeSummation() { }	
}