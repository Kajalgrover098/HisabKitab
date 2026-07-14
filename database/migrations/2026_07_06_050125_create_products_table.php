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

        $table->unsignedBigInteger('shopkeeper_id');

        $table->string('product_name');

        $table->string('product_code')->unique();

        $table->decimal('price', 10, 2);

        $table->integer('stock');

        $table->enum('status', ['Active', 'Inactive'])->default('Active');

        $table->timestamps();

        $table->foreign('shopkeeper_id')
              ->references('id')
              ->on('shopkeepers')
              ->onDelete('cascade');

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
