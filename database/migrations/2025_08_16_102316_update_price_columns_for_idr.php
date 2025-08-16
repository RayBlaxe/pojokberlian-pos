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
        Schema::table('items', function (Blueprint $table) {
            $table->bigInteger('price')->change();
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->bigInteger('total_amount')->change();
            $table->bigInteger('tax_amount')->default(0)->change();
            $table->bigInteger('discount_amount')->default(0)->change();
        });

        Schema::table('sale_items', function (Blueprint $table) {
            $table->bigInteger('unit_price')->change();
            $table->bigInteger('total_price')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->change();
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->decimal('total_amount', 10, 2)->change();
            $table->decimal('tax_amount', 10, 2)->default(0)->change();
            $table->decimal('discount_amount', 10, 2)->default(0)->change();
        });

        Schema::table('sale_items', function (Blueprint $table) {
            $table->decimal('unit_price', 10, 2)->change();
            $table->decimal('total_price', 10, 2)->change();
        });
    }
};
