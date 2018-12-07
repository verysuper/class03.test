<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('category_no',50)->unique();//類別編號
            $table->string('name',100)->unique();//中文名稱
            $table->string('name_en',100)->unique();//英文名稱
            $table->string('image',50)->nullable();//類別圖片
            $table->text('info')->nullable();//類別資訊中文
            $table->text('info_en')->nullable();//類別資訊英文
            $table->integer('parent_id')->index();//父id
            $table->enum('display', [0, 1])->default('0');//顯示
            $table->integer('created_by_id');//建立者
            $table->integer('updated_by_id');//修改者
            $table->integer('view')->unsigned();//查看次數
            $table->integer('layer')->default(0);//層
            $table->integer('sub_qty')->unsigned();//子數量
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
        Schema::dropIfExists('categories');
    }
}
