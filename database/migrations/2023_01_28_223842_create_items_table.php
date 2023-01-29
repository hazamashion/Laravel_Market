<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('id');
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->string('name')->comment('商品名');
            $table->string('description', 1000)->comment('商品の説明');
            $table->unsignedBigInteger('category_id')->comment('カテゴリID');
            $table->integer('price')->comment('価格');
            $table->string('image', 100)->comment('商品画像ファイル');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
