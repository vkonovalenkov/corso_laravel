<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsAlbumCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('album_categories');
        Schema::create('album_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_name',64)->unique();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::dropIfExists('album_category');
        Schema::create('album_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('album_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->unique(['album_id','category_id']);
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
        //Schema::dropIfExists('models_album_categories');
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('album_category');
        Schema::dropIfExists('album_categories');
    }
}
