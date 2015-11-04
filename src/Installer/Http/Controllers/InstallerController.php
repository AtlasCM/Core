<?php namespace Atlas\Installer\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Atlas\Routing\Controller;
use Atlas\Installer\Contracts\Installer;

class InstallerController extends Controller
{
    /**
     * Atlas Welcome page.
     *
     * @param  \Atlas\Installer\Contracts\Installer  $installer
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
     * Installer: Determine wheter to use simple or dev mode for installation.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMode()
    {
        return view('atlas.installer::mode');
    }
    
    /**
     * Installer: Determine wheter to use simple or dev mode for installation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Atlas\Installer\Contracts\Installer  $installer
     * @return \Illuminate\Http\Response
     */
    public function storeMode(Request $request, Installer $installer)
    {
        $this->validate($request, [
            'mode' => 'required|in:dev,simple',
        ]);
        
        $mode = $request->input('mode');
        $request->session()->put('atlas.installer::mode', $mode);
        
        $env_configured = $installer->environmentIsConfigured();
        $db_configured = $installer->dbIsConfigured();
        $db_installed = $installer->dbIsInstalled();
        
        $route = $env_configured ? ($mode == 'simple' ? ($db_configured ? ($db_installed ? 'admin.create' : 'db.install') : 'db.create') : 'db.create') : 'env.create';
        
        return redirect()->route('atlas.installer::' . $route);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Atlas\Installer\Contracts\Installer  $installer
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
        
        $mode = $request->session()->get('atlas.installer::mode');
        
        $db_configured = $installer->dbIsConfigured();
        $db_installed = $installer->dbIsInstalled();
        
        $route = ($mode == 'simple' ? ($db_configured ? ($db_installed ? 'admin.create' : 'db.install') : 'db.create') : 'db.create');
        
        return redirect()->route('atlas.installer::' . $route);
    }
    
    /**
     * Installer: Set up Database in .env.
     *
     * @param  \Atlas\Installer\Contracts\Installer  $installer
     * @param  bool  $reconfigure  Whether or not to reconfigure the database when a valid connection was automatically detected.
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
     * @param \Illuminate\Http\Request  $request
     * @param \Atlas\Installer\Contracts\Installer  $installer
     * @return \Illuminate\Http\Response
     */
    public function storeDB(Request $request, Installer $installer)
    {
        $this->validate($request, [
            'DB_CONNECTION' => 'required|in:sqlite,mysql,pgsql,sqlsrv',
            'DB_PREFIX' => 'regex:/^[a-zA-Z_][a-zA-Z0-9_]*$/',
            'DB_FILE' => 'required_if:DB_CONNECTION,sqlite|regex:/^[\\w\\/\\.-]+\\.sqlite$/|database:DB_CONNECTION,DB_FILE',
            'DB_HOST' => 'required_unless:DB_CONNECTION,sqlite',
            'DB_DATABASE' => 'required_unless:DB_CONNECTION,sqlite|database:DB_CONNECTION,DB_HOST,DB_DATABASE,DB_USERNAME,DB_PASSWORD',
            'DB_USERNAME' => 'required_unless:DB_CONNECTION,sqlite',
            'DB_PASSWORD' => 'required_unless:DB_CONNECTION,sqlite',
        ]);
        
        if ($request->input('DB_CONNECTION') == 'sqlite') {
            $installer->setEnv(collect($request->only(['DB_CONNECTION', 'DB_FILE', 'DB_PREFIX']))->filter(function ($item) {
                return $item !== '';
            }));
        } else {
            $installer->setEnv(collect($request->only(['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD', 'DB_PREFIX']))->filter(function ($item) {
                return $item !== '';
            }));
        }
        
        $mode = $request->input('mode');
        $db_installed = $installer->dbIsInstalled();
        
        $route = ($mode == 'simple' ? ($db_installed ? 'admin.create' : 'db.install') : 'db.install');
        
        return redirect()->route('atlas.installer::' . $route);
    }
    
    /**
     * Installer: @todo: refactor.
     *
     * @return \Illuminate\Http\Response
     */
    public function installDb()
    {
        return 'install db';
    }
    
    public function migrateDb()
    {
        return 'migrate db';
    }
}
