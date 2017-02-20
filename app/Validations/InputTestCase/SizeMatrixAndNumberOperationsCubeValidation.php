<?php  namespace App\Validations\InputTestCase;

use App\Validations\InputTestCase\ValueValidation;

class SizeMatrixAndNumberOperationsCubeValidation extends ValueValidation
{
	protected $attribute;
	protected $value;
	protected $sizeValue = 2;
	protected $sizes_matrix = [];

	public function input($attribute, $value, $parameters, $validator)
	{
		$this->attribute = $attribute;
		$this->value = $value;
		$this->constraintCubeSummation();
		return true;
	}

	public function constraintCubeSummation()
	{
		foreach ($this->value as $key => $value) {
			$this->value = $this->getArrayQuery($value);
			$size_matrix_and_number_operations = $this->value;
			$this->validateSizeValue();
			$size_matrix = $this->getValueQueryPosition($size_matrix_and_number_operations,0);
			$this->isRange($size_matrix, 1, 100);
			$sizes_matrix[] = $size_matrix;
			$number_operations = $this->getValueQueryPosition($size_matrix_and_number_operations,1);
			$this->isRange($number_operations, 1, 1000);
		}
		session(['size_matrix' => $sizes_matrix]);
	}	
}