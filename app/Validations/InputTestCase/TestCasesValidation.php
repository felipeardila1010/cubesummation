<?php  namespace App\Validations\InputTestCase;

use App\Validations\InputTestCase\NumberTestCaseValidation;
use App\Validations\InputTestCase\SizeMatrixAndNumberOperationsCubeValidation;
use App\Validations\InputTestCase\QueryValidation;

use App\Validations\InputTestCase\ValueValidation;

class TestCasesValidation
{
	protected $numberTestCaseValidation;
	protected $sizeMatrixAndNumberOperationsValidation;
	protected $queryValidation;

	public function input($attribute, $value, $parameters, $validator)
	{
		try {
			$this->numberTestCaseValidation = new NumberTestCaseValidation();
			$numberTestCase = $this->numberTestCaseValidation->input('number_test_case', $value);
			$this->sizeMatrixAndNumberOperationsValidation = new SizeMatrixAndNumberOperationsCubeValidation(
						'size_matrix_and_number_operations', 
						$value, 
						$numberTestCase
					);
			$sizesMatrixAndNumberOperations = $this->sizeMatrixAndNumberOperationsValidation->getSizesMatrixAndNumberOperations();
			$this->queryValidation = new QueryValidation('queries', $value, $numberTestCase, $sizesMatrixAndNumberOperations);

			return true;

		} catch (\Exception $e) {
			$validator->addReplacer('test_cases', function ($message, $attribute, $rule, $parameters) use ($e) {
                return $e->getMessage();
            });
            
			return false;
		}
	}
}