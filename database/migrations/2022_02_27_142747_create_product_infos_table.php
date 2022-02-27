<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('size')->nullable();
            $table->unsignedInteger('calories')->nullable();
            $table->unsignedInteger('protien')->nullable();
            $table->unsignedInteger('sugar')->nullable();
            $table->unsignedInteger('fibre')->nullable();
            $table->unsignedInteger('fat')->nullable();
            $table->unsignedInteger('saturated')->nullable();
            $table->unsignedInteger('vitaminA')->nullable();
            $table->unsignedInteger('vitaminC')->nullable(); 

            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
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
        Schema::dropIfExists('product_infos');
    }
}
