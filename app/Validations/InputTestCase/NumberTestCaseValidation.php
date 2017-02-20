<?php  namespace App\Validations\InputTestCase;

use App\Validations\InputTestCase\ValueValidation;

class NumberTestCaseValidation extends ValueValidation
{
	protected $attribute;
	protected $value;
	protected $sizeValue = 1;

	public function input($attribute, $value, $parameters, $validator)
	{
		$this->attribute = $attribute;
		$this->value = $value;
		$this->validateSizeValue();
		$this->constraintCubeSummation();
		return true;
	}

	public function constraintCubeSummation()
	{
		return $this->isRange($this->value, 1, 50);
	}	
}