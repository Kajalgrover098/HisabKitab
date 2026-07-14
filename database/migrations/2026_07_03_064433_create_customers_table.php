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
    Schema::create('customers', function (Blueprint $table) {

        $table->id();

        $table->foreignId('shopkeeper_id')
              ->constrained('shopkeepers')
              ->onDelete('cascade');

        $table->string('customer_name',100);

        $table->string('phone',10);

        $table->string('email')->nullable();

        $table->enum('gender',['Male','Female','Other'])->nullable();

        $table->text('address')->nullable();

        $table->timestamps();

        $table->softDeletes();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
