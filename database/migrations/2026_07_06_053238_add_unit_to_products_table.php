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
    Schema::table('products', function (Blueprint $table) {
        $table->enum('unit', [
            'Piece',
            'Kg',
            'Gram',
            'Litre',
            'Ml',
            'Packet',
            'Dozen'
        ])->after('price');
    });
}

public function down(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('unit');
    });
}

    /**
     * Reverse the migrations.
     */
   
};
