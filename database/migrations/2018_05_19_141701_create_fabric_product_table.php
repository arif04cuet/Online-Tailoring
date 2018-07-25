<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFabricProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fabric_product', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('fabric_id')->unsigned()->nullable();
            $table->foreign('fabric_id')->references('id')
                ->on('fabrics')->onDelete('cascade');

            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')
                ->on('products')->onDelete('cascade');



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
        Schema::dropIfExists('fabric_product');
    }
}
