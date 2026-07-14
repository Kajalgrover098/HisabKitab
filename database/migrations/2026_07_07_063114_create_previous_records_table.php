<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('previous_records', function (Blueprint $table) {

            $table->id();

            $table->foreignId('shopkeeper_id')->constrained()->onDelete('cascade');

            $table->foreignId('customer_id')->constrained()->onDelete('cascade');

            $table->decimal('total_amount',10,2);

            $table->decimal('paid_amount',10,2)->default(0);

            $table->decimal('due_amount',10,2);

            $table->string('type')->default('Opening Balance');

            $table->text('description')->nullable();

            $table->enum('status',['paid','partial','due'])->default('due');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('previous_records');
    }
};