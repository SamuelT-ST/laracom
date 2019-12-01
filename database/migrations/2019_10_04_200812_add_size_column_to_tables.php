<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSizeColumnToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->integer('size')->nullable()->after('product_price');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->boolean('has_size')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->dropColumn('size');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('has_size');
        });
    }
}
