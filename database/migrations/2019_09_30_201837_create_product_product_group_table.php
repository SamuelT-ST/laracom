<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductProductGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_product_group', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_group_id');
            $table->integer('product_id');
            $table->foreign('product_group_id')->references('id')->on('product_groups')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('position')->nullable();
            $table->integer('from_dimensions')->nullable();
            $table->integer('to_dimensions')->nullable();
            $table->string('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_product_group');
    }
}
