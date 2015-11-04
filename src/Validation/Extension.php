<?php namespace Atlas\Validation;

abstract class Extension
{
    protected $replacers = [];
    
    public function replace($message, $attribute, $rule, $parameters)
    {
        foreach ($this->replacers as $placeholder => $replacement) {
            $message = str_replace($placeholder, $replacement, $message);
        }
    }
}
