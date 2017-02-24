<?php  namespace App\Validations\InputTestCase;

use App\Validations\InputTestCase\ValueValidation;

class NumberTestCaseValidation extends ValueValidation
{
	protected $attribute;
	protected $value;
	protected $ruleSizeValue = 1;

	public function input($attribute, $value)
	{
		$this->attribute = $attribute;
		$this->value = $this->getArrayQuery($value[$attribute]);
		$this->validateSize($this->nameErrorSizeValue, $this->ruleSizeValue);
		$this->value = $value[$attribute];
		$this->constraintCubeSummation();
		return $this->value;
	}

	public function constraintCubeSummation()
	{
		return $this->isRange($this->value, 1, 50);
	}	
}