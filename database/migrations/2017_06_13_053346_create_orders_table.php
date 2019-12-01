<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference')->unique();
            $table->integer('courier_id')->unsigned()->index();
            $table->foreign('courier_id')->references('id')->on('couriers');
            $table->integer('customer_id')->nullable()->unsigned()->index();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('billing_address_id')->nullable()->unsigned()->index();
            $table->foreign('billing_address_id')->references('id')->on('addresses');
            $table->integer('shipping_address_id')->nullable()->unsigned()->index();
            $table->foreign('shipping_address_id')->references('id')->on('addresses');
            $table->integer('order_status_id')->unsigned()->index();
            $table->foreign('order_status_id')->references('id')->on('order_statuses');
            $table->integer('payment_method_id')->unsigned()->index();
            $table->decimal('discounts')->nullable()->default(0.00);
            $table->decimal('total_products');
            $table->decimal('tax')->default(0.00);
            $table->decimal('total');
            $table->decimal('total_paid')->default(0.00);
            $table->string('invoice')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_company')->nullable();
            $table->string('customer_ico')->nullable();
            $table->string('customer_dic')->nullable();
            $table->string('billing_address_1')->nullable();
            $table->string('billing_address_2')->nullable();
            $table->string('billing_zip')->nullable();
            $table->string('billing_city')->nullable();
            $table->integer('billing_country')->nullable();
            $table->string('billing_phone')->nullable();
            $table->string('shipping_address_1')->nullable();
            $table->string('shipping_address_2')->nullable();
            $table->string('shipping_zip')->nullable();
            $table->string('shipping_city')->nullable();
            $table->integer('shipping_country')->nullable();
            $table->string('shipping_phone')->nullable();

            $table->string("shipping_customer_name")->nullable();
            $table->string("shipping_customer_email")->nullable();
            $table->string("shipping_customer_company")->nullable();
            $table->string("shipping_customer_ico")->nullable();
            $table->string("shipping_customer_dic")->nullable();
            $table->boolean("same_addresses")->default(true);

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
        Schema::dropIfExists('orders');
    }
}
