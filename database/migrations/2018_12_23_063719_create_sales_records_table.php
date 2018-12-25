<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();//fk
            $table->text('customer_name');//customer name
            $table->text('product_description');//product description
            $table->string('record_image',255)->nullable();//商品圖片
            $table->string('customer_id')->nullable();//review id for customer
            $table->string('product_id')->nullable();//review id for product
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
        Schema::dropIfExists('sales_records');
    }
}
