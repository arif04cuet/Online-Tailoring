<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesetAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_attribute_set', function (Blueprint $table) {

            $table->integer('attribute_id')->unsigned()->nullable();
            $table->foreign('attribute_id')->references('id')
                ->on('attributes')->onDelete('cascade');

            $table->integer('attribute_set_id')->unsigned()->nullable();
            $table->foreign('attribute_set_id')->references('id')
                ->on('attribute_sets')->onDelete('cascade');



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
        Schema::dropIfExists('attribute_attribute_set');
    }
}
