<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->enum('type', ['sale', 'rental', 'both'])->default('sale')->after('description');
            $table->decimal('rental_price', 15, 2)->nullable()->after('price');
            $table->boolean('is_available')->default(true)->after('is_visible');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['type', 'rental_price', 'is_available']);
        });
    }
};
