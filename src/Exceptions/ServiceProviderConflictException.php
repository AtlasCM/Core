<?php namespace Atlas\Exceptions;

use Exception;

class ServiceProviderConflictException extends Exception
{
    
    public function __construct($provider1, $provider2, $facade, $code = 0, Exception $previous = null)
    {
        $msg = $provider1 . ' and ' . $provider2 . ' are both trying to use a Facade named <strong>' . $facade . '</strong>';
        
        return parent::__construct($msg, $code, $previous);
    }
    
}
