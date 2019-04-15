<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->float('current_price');
            $table->integer('qty');
            $table->string('featured_photo');
            $table->string('description');
            $table->string('condition');
            $table->string('return_policy');
            $table->integer('total_views');
            $table->integer('user_id');
            $table->boolean('is_active');
            $table->integer('ecat_id');
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
        Schema::dropIfExists('products');
    }
}
