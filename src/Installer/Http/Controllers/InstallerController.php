<?php namespace Atlas\Installer\Http\Controllers;

use Exception;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Atlas\Routing\Controller;
use Atlas\Installer\Contracts\Installer;

class InstallerController extends Controller
{
    /**
     * Atlas Welcome page.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome(Installer $installer)
    {
        $env_configured = $installer->environmentIsConfigured();
        $db_configured = $installer->dbIsConfigured();
        $db_installed = $installer->dbIsInstalled();
        
        $route = $env_configured ? 'db.create' : 'env.create';
        
        return view('atlas.installer::welcome', compact('route'));
    }
    
    /**
     * Installer: Set up Environment in .env.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEnv()
    {
        return view('atlas.installer::env');
    }
    
    /**
     * Installer: Store Environment in .env.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeEnv(Request $request, Installer $installer)
    {
        $this->validate($request, [
            'env' => 'required|in:local,testing,staging,production',
        ]);
        
        $env = $request->input('env');
        
        $installer->setEnv([
            'ATLAS_INSTALLED' => true,
            'APP_ENV' => $env,
            'APP_DEBUG' => $env == 'production' ? false : true,
            'APP_KEY' => Str::random(32),
        ]);
        
        return redirect()->route('atlas.installer::db.create');
    }
    
    /**
     * Installer: Set up Database in .env.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDB(Installer $installer, $reconfigure = false)
    {
        // If a connection with the DB is available, ask if the user wants to use that connection.
        if (! $reconfigure && $installer->dbIsConfigured()) {
            $db_installed = $installer->dbIsInstalled();
            
            return view('atlas.installer::db.install.ask', compact($db_installed));
        }
        
        return view('atlas.installer::db.install');
    }
    
    /**
     * Installer: Store the Database Configuration in .env.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeDB(Request $request, Installer $installer)
    {
        $this->validate($request, [
            'DB_CONNECTION' => 'required',
            'DB_FILE' => 'required_if:DB_CONNECTION,sqlite',
        ]);
        
        DB_HOST=localhost
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
DB_FILE=database.sqlite
    }
}
