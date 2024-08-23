<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Name of the product
            $table->string('location'); // Location field for the product
            $table->timestamps(); // This will add `created_at` and `updated_at` fields
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
