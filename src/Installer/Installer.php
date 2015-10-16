<?php namespace Atlas\Core\Installer;

use Atlas\Core\Installer\Contracts\Installer as InstallerContract;

class Installer implements InstallerContract
{

    /**
     * @inheritdoc
     */
    public function boot()
    {
        $this->registerRoutes();
    }

    protected function registerRoutes()
    {
        include __DIR__ . '/routes.php';
    }

}
