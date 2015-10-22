<?php namespace Atlas\Core\Installer\Contracts;

interface Installer
{
    /**
     * Check if the .env file is set and configured.
     *
     * @return bool
     */
    public function environmentIsConfigured();
    
    /**
     * Set the Environment Variables.
     *
     * @param array Environment Variables to be set
     * @return void
     */
    public function setEnv($variables);
    
    /**
     * Check if the Database is installed.
     *
     * @return bool
     */
    public function dbIsInstalled();
    
    /**
     * Get the Application Key from the database.
     *
     * @return string Application Key
     */
    public function getAppKey();
    
    /**
     * Create & fill the database.
     *
     * @return void
     */
    public function migrateDb();
    
    /**
     * Create the Super Admin User.
     *
     * @param array The Super Admin's details
     */
    public function setSuperAdmin($details);
}
