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
        // Drop product_id foreign key and column from category table
        Schema::table('category', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
        });

        // Add category_id to product table
        Schema::table('product', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('price')->constrained('category')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });

        Schema::table('category', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('product')->cascadeOnDelete();
        });
    }
};
