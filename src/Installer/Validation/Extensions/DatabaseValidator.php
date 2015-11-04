<?php namespace Atlas\Installer\Validation\Extensions;

use Atlas\Validation\Extension;
use Atlas\Installer\Contracts\Installer;
use Atlas\Validation\Contracts\Extension as ExtensionContract;

class DatabaseValidator extends Extension implements ExtensionContract
{
    protected $installer;
    
    public function __construct(Installer $installer)
    {
        $this->installer = $installer;
    }
    
    public function validate($attribute, $value, $parameters, $validator)
    {
        $data = $validator->getData();
            
        $connection = array_get($data, array_shift($parameters));
        
        config([
            'database.default' => $connection,
        ]);
        
        if ($connection == 'sqlite') {
            list($file_field) = $parameters;
            
            config([
                'database.connections.' . $connection . '.database' => database_path(array_get($data, $file_field)),
            ]);
        } else {
            list($host_field, $database_field, $username_field, $password_field) = $parameters;
            
            config([
                'database.connections.' . $connection . '.database' => array_get($data, $database_field),
                'database.connections.' . $connection . '.host' => array_get($data, $host_field),
                'database.connections.' . $connection . '.username' => array_get($data, $username_field),
                'database.connections.' . $connection . '.password' => array_get($data, $password_field),
            ]);
        }
        
        return $this->installer->dbIsConfigured();
    }
    
    public function replace($message, $attribute, $rule, $parameters)
    {
        $connection = request(array_shift($parameters));
        
        if ($connection == 'sqlite') {
            list($file_field) = $parameters;
            $database = request($file_field);
        } else {
            list($host_field, $database_field) = $parameters;
            $database = request($database_field);
        }
        
        return str_replace(':database', $database, $message);
    }
}