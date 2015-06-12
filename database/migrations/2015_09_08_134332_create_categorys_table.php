<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');

            $table->string('name');
            $table->smallInteger('sort_order')->default('99');
            $table->string('filter_attr');

            $table->boolean('show_in_nav')->default(false);
            $table->boolean('is_show')->default(true);
            $table->string('thumb');

            $table->text('desc');

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
        Schema::drop('admins');
    }
}
