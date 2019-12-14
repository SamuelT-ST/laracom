<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToWeightInCouriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('couriers', function (Blueprint $table) {
            $table->decimal('to_weight')->nullable()->after('from_weight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('couriers', function (Blueprint $table) {
            $table->dropColumn('to_weight');
        });
    }
}
