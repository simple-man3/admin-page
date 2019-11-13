<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_themes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name_dir');
            $table->string('name_theme');
            $table->string('name_author');
            $table->string('description_theme');
            $table->boolean('use_theme');

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
        Schema::dropIfExists('all_themes');
    }
}
