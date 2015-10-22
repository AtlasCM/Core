<?php namespace App\Http\Controllers;

use Atlas\Routing\Controller;

class InstallerController extends Controller
{
    /**
     * Atlas Welcome page.
     *
     * @return Response
     */
    public function welcome()
    {
        return view('atlas.installer::welcome');
    }
}
