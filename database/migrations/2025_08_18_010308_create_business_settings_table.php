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
        Schema::create('business_settings', function (Blueprint $table) {
            $table->id();
            $table->string('business_name')->default('Pojok Berlian Cafetaria');
            $table->text('address')->nullable();
            $table->string('city')->default('Bekasi, Jawa Barat');
            $table->string('phone')->default('(+62) 851 5642 8744');
            $table->string('logo_path')->default('favicon.svg');
            $table->text('footer_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_settings');
    }
};
