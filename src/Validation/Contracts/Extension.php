<?php namespace Atlas\Validation\Contracts;

interface Extension
{
    public function validate($attribute, $value, $parameters, $validator);
    
    public function replace($message, $attribute, $rule, $parameters);
}