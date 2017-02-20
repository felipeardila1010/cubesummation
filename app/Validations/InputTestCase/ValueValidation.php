<?php namespace App\Validations\InputTestCase;

abstract class ValueValidation
{
    protected $errorMessages = 'validation.cube.error.';

    protected function validateSizeValue()
    {
        if((count($this->value) != $this->sizeValue) && !empty($this->value)) {
            throw new \Exception($this->getError("size_value", $this->sizeValue), 1);
        }        
    }
    
    protected function isRange($value, $min, $max)
    {
        if( ($min <= $value) && ($value <= $max) ){
            return true;
        }
        
        throw new \Exception($this->getError('constraint_cube','('.$min.' - '.$max.')'),1);
    }

    public function isQuery($queries)
    {
        foreach ($queries as $key => $query) {
            $wordQuery = $this->getValueDividePosition($query,0);
            $this->value = $this->getArrayQuery($query);

            if(in_array($wordQuery, $this->rulesQueries)){
                $this->sizeValue = $this->getPositionQuery($wordQuery, $this->rulesQueries);
                $this->validateSizeValue();
            }
            else{
                throw new \Exception($this->getError('query_name'), 1);
            }
        }
    }

    public function getPositionQuery($wordQuery, $rulesQueries)
    {
        $positionQuery = array_search($wordQuery, $this->rulesQueries);
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
    
    protected function getError($error, $value_message = '')
    {
        return $this->attribute . \Lang::get($this->errorMessages . $error). $value_message;
    }

    abstract public function constraintCubeSummation();
}