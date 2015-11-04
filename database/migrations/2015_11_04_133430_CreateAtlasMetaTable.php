<?php

use Illuminate\Support\Str;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtlasMetaTable extends Migration
{
    public function __construct()
    {
        $this->meta_table = Constants::db()->META_TABLE;
        $this->meta_key = Constants::db()->META_KEY;
        $this->meta_value = Constants::db()->META_VALUE;
    }
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->meta_table, function (Blueprint $table) {
            $table->increments(Str::snake($this->meta_table) . '_id');
            $table->string($this->meta_key);
            $table->text($this->meta_value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop($this->meta_table);
    }
}
