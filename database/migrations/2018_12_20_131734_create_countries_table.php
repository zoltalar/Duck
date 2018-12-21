<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 50);
            $table->string('code', 2);
            $table->timestamps();

            $table->unique('name');
            $table->unique('code');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
