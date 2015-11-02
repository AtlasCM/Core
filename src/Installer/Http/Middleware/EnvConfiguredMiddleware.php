<?php namespace Atlas\Installer\Http\Middleware;

use Closure;
use Atlas\Installer\Contracts\Installer;

class EnvConfiguredMiddleware
{
    protected $installer;
    
    public function __construct(Installer $installer)
    {
        $this->installer = $installer;
    }
    
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $this->installer->environmentIsConfigured()) {
            return redirect()->route('atlas.installer::env.create');
        }
        
        return $next($request);
    }

}
