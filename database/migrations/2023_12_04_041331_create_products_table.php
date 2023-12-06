<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('category_id');
            $table->string('price');
            $table->longText('description');
            $table->string('item_condition');
            $table->string('item_type');
            $table->integer('publish_status')->default(0);
            $table->string('image')->nullable();
            $table->string('owner_name');
            $table->string('owner_phone');
            $table->string('owner_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
