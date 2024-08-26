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
            $table->text('description')->nullable();
            $table->foreignId('category_id');
            $table->decimal('supplier_price');
            $table->decimal('price');
            $table->unsignedBigInteger('product_size_id');
            $table->string('color');
            $table->unsignedInteger('quantity')->default(0);
            $table->string('thumbnail_url')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 = Dont show, 1 = show');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('product_size_id')->references('id')->on('product_sizes')->onDelete('cascade');
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
