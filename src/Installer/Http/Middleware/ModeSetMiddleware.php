<?php namespace Atlas\Installer\Http\Middleware;

use Closure;
use Atlas\Installer\Contracts\Installer;

class ModeSetMiddleware
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
        if (! $request->session()->has('atlas.installer::mode')) {
            return redirect()->route('atlas.installer::mode.create');
        }
        
        return $next($request);
    }

}
