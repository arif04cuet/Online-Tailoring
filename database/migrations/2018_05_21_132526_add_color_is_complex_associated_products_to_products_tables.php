<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColorIsComplexAssociatedProductsToProductsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {

            $table->string('color')->nullable();
            $table->boolean('is_complex')->default(0);
            $table->string('associated_products')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function ($table) {
            $table->dropColumn('color');
            $table->dropColumn('is_complex');
            $table->dropColumn('associated_products');
        });
    }
}
