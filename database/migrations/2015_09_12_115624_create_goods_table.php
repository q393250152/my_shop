<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->decimal('price',10,2);
            $table->integer('type_id');
            $table->text('img');
            $table->text('desc');
            $table->string('thumb');
            $table->tinyInteger('best');
            $table->tinyInteger('hot');
            $table->tinyInteger('new');
            $table->tinyInteger('onsale');
            $table->tinyInteger('promote');
            $table->tinyInteger('number');
            $table->tinyInteger('brand_id');
            $table->tinyInteger('category_id');
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
        Schema::drop('goods');
    }
}
