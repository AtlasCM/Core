<?php

use Illuminate\Database\Seeder;

class AtlasMetaSeeder extends Seeder
{
    public function __construct()
    {
        $this->meta_table = Constants::db()->META_TABLE;
        $this->meta_key = Constants::db()->META_KEY;
        $this->meta_value = Constants::db()->META_VALUE;
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->meta_table)->insert([
            $this->meta_key => '__is_installed',
            $this->meta_value => true,
        ]);
    }
}
