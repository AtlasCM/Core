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
        
        return view('atlas.installer::welcome', compact('env_configured', 'db_configured', 'db_installed'));
    }
    
    
}
