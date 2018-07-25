<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductIdAttributeSetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attribute_sets', function (Blueprint $table) {

            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')
                ->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attribute_sets', function ($table) {
            $table->dropColumn('product_id');
        });
    }
}
