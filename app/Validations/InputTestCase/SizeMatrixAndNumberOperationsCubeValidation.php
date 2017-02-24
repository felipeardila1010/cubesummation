<?php  namespace App\Validations\InputTestCase;

use App\Validations\InputTestCase\ValueValidation;

class SizeMatrixAndNumberOperationsCubeValidation extends ValueValidation
{
	protected $attribute;
	protected $value;
	protected $ruleSizeArray;
	protected $ruleSizeValue = 2;

	function __construct($attribute, $value, $numberTestCase) {
		$this->ruleSizeArray = $numberTestCase;
		$this->attribute = $attribute;
		$this->value = $value[$attribute];
		$this->validateSize($this->nameErrorSizeArray, $this->ruleSizeArray);
		$this->value = $this->validateSizeIterations($this->value ,$this->nameErrorSizeValue ,$this->ruleSizeValue);
		$this->constraintCubeSummation();
	}

	public function constraintCubeSummation()
	{
		foreach ($this->value as $key => $value) {
			$sizeMatrix = $this->getValueDividePosition($value, 0);
			$this->isRange($sizeMatrix, 1, 100);
			$numberOperations = $this->getValueDividePosition($value, 1);
			$this->isRange($numberOperations, 1, 1000);
		}
	}	

	public function getSizesMatrixAndNumberOperations()
	{
		return $this->value;
	}
}