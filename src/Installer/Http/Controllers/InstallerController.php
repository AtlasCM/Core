<?php namespace Atlas\Installer\Http\Controllers;

use Exception;

use Atlas\Routing\Controller;

use Atlas\Installer\Contracts\Installer;

class InstallerController extends Controller
{
    /**
     * Atlas Welcome page.
     *
     * @return Response
     */
    public function welcome(Installer $installer)
    {
        $env_configured = $installer->environmentIsConfigured();
        $db_configured = $installer->dbIsConfigured();
        $db_installed = $installer->dbIsInstalled();
        
        $route = $env_configured ? 'db.create' : 'env.create';
        
        return view('atlas.installer::welcome', compact('route'));
    }
    
    public function createEnv(Installer $installer)
    {
        $installer->setEnv([]);
        return;
        return view('atlas.installer::environment');
    }
    
    public function storeEnv()
    {
        // redirect to next step
    }
}
