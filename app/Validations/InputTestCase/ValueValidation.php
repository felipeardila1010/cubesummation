<?php namespace App\Validations\InputTestCase;

use Lang;

abstract class ValueValidation
{
    protected $routeErrorMessages = 'cube.error.';
    protected $routeAttributesMessages = 'cube.attributes.';
    protected $indicatorAttribute = '/:attribute/';
    protected $nameErrorSizeArray = 'size_array';
    protected $nameErrorSizeValue = 'size_value';

    protected function validateSize($nameError ,$ruleSize)
    {
        if((count($this->value) != $ruleSize) || empty($this->value)) {
            throw new \Exception($this->getError($nameError, $ruleSize), 1);
        }
    }

    protected function validateSizeIterations($values ,$nameError ,$ruleSize)
    {
        foreach ($values as $value) {
            $this->value = $this->getArrayQuery($value);
            $this->validateSize($nameError ,$ruleSize);
        }

        return $values;
    }

    protected function validateSizeQueryIterations($values ,$nameError ,$ruleSize)
    {
        foreach ($values as $value) {
            $wordQuery = $this->getValueDividePosition($value ,0);

            if(in_array($wordQuery, $this->rulesQueries)){
                $sizeValue = $this->getPositionQuery($wordQuery, $this->rulesQueries);
                $this->value = $this->getArrayQuery($value);
                $this->validateSize($nameError, $sizeValue);
            }
            else{
                throw new \Exception($this->getError($this->nameErrorWordQuery, $this->getSeparateByCommas($this->rulesQueries)), 1);
            }
        }

        return $values;
    }

    protected function validateSizeAllQueriesIterations($values ,$nameError ,$nameErrorValue ,$rulesSizeNumberOperations, $rulesSizesQueries)
    {
        foreach ($values as $key => $value) {
            $this->value = $value;
            $ruleSize = $this->getValueDividePosition($rulesSizeNumberOperations[$key], 1);
            $this->validateSize($nameError ,$ruleSize);

            $this->validateSizeQueryIterations($value, $nameErrorValue, $rulesSizesQueries);
        }

        return $values;
    }

    protected function isRange($value, $min, $max)
    {
        if( ($min <= $value) && ($value <= $max) ){
            return true;
        }
        
        throw new \Exception($this->getError('constraint_cube','('.$min.' - '.$max.')'),1);
    }

    public function getPositionQuery($wordQuery, $rulesQueries)
    {
        $positionQuery = array_search($wordQuery, $rulesQueries);
        return $this->rulesSizesQueries[$positionQuery];
    }

    public function getArrayQuery($value)
    {
        return explode(' ', $value);
    }

    public function getValueDividePosition($value, $position)
    {
        return explode(' ', $value)[$position];
    }

    public function getValueQueryPosition($value, $position)
    {
        return $value[$position];
    }

    public function getValueFirstPosition($array)
    {
        return $array[0];
    }

    public function getSeparateByCommas($value)
    {
        return implode(',', $value);
    }
    
    protected function getError($error, $value_message = '')
    {
        $messageError = Lang::get($this->routeErrorMessages . $error). $value_message;
        $valueAttribute = Lang::get($this->routeAttributesMessages . $this->attribute);
        
        return preg_replace($this->indicatorAttribute, $valueAttribute, $messageError);
    }

    abstract public function constraintCubeSummation();
}