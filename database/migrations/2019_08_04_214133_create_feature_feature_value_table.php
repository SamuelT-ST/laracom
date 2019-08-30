<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatureFeatureValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_feature_value', function (Blueprint $table) {
            $table->integer('feature_id');
            $table->integer('feature_value_id');
            $table->foreign('feature_id')->references('id')->on('features')->onDelete('cascade');
            $table->foreign('feature_value_id')->references('id')->on('feature_values')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feature_feature_value');
    }
}
