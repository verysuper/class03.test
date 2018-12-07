<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchandisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchandises', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('merchandise_no',50)->unique();//商品編號
            $table->string('name',100)->unique();//中文名稱
            $table->string('name_en',100)->unique();//英文名稱
            $table->string('image',50)->nullable();//商品圖片
            $table->text('info')->nullable();//商品資訊中文
            $table->text('info_en')->nullable();//商品資訊英文
            $table->integer('category_id')->index();//類別id
            $table->integer('remain_qty')->unsigned();//剩餘數量
            $table->enum('display', [0, 1])->default('0');//上下架
            $table->integer('created_by_id');//建立者
            $table->integer('updated_by_id');//修改者
            $table->integer('view')->unsigned();//查看次數
            $table->decimal('price', 10, 2);//價錢
            $table->integer('brand_id');//品牌id
            $table->integer('vendor_id');//供應商id
            $table->integer('highly_qty')->unsigned();//商品評價數量
            $table->enum('destroy', [0, 1])->default('0');//註銷商品(備)
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
        Schema::dropIfExists('merchandises');
    }
}
