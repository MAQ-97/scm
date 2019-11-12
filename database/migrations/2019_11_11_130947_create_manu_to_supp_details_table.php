<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManuToSuppDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manu_to_supp_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('manuToSupp_id');
            $table->unsignedInteger('product_id');
            $table->integer('quantity');
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manu_to_supp_details');
    }
}
