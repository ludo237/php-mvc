<?php

namespace Arcadia;

use Arcadia\Exceptions\ValidationException;

abstract class Model
{
    abstract public function rules() : array;
    
    protected function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            // check if the current input key exists in the model
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
    
    /**
     * @param \Arcadia\Request $request
     *
     * @throws \Arcadia\Exceptions\ValidationException
     */
    public function validate(Request $request) : void
    {
        $this->hydrate($request->body());
        
        $errors = [];
        foreach ($this->rules() as $attribute => $rules) {
            // Get the attribute value using PHP magic
            $attributeValue = $this->{$attribute};
            
            foreach ($rules as $rule) {
                [$name, $value] = array_pad(explode(":", $rule), 2, null);
                
                // I know this is stupid ass long and dumb but for alpha it works
                if ($name === "required" && !$attributeValue) {
                    $errors[$attribute][] = "The field {$attribute} is required";
                }
                
                if ($name === "email" && filter_var($attributeValue, FILTER_VALIDATE_EMAIL)) {
                    $errors[$attribute][] = "The field {$attribute} is not a valid Email address";
                }
                
                if ($name === "min" && strlen($attributeValue) < $value) {
                    $errors[$attribute][] = "The field {$attribute} must be at least {$value} characters";
                }
                
                if ($name === "max" && strlen($attributeValue) > $value) {
                    $errors[$attribute][] = "The field {$attribute} must be below {$value} characters";
                }
                
                if ($name === "match" && $this->{$value} !== $attributeValue) {
                    $errors[$attribute][] = "The field {$attribute} does not match the field {$value}";
                }
            }
        }
        
        if (count($errors) > 0) {
            throw new ValidationException("The given data was invalid", $errors);
        }
    }
    
    public function toArray() : array
    {
        // TODO is this the best approach?
        return (array)$this;
    }
}
