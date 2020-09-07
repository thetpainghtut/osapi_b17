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
            $table->id();
            $table->string('codeno');
            $table->string('name');
            $table->text('photo');
            $table->integer('price');
            $table->integer('discount'); // 10(%)
            $table->text('description');
            
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('brand_id');

             // relationship ချိတ်ဆက်ပုံ 
            $table->foreign('subcategory_id')
                  ->references('id')->on('subcategories')
                  ->onDelete('cascade'); 
                  
            $table->foreign('brand_id')
                  ->references('id')->on('brands')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('items');
    }
}
