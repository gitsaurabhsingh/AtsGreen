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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('location_map_image')->nullable();
            $table->string('site_plan_image')->nullable();
            $table->string('payment_plan_image')->nullable();
            $table->text('payment_plan_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'location_map_image',
                'site_plan_image',
                'payment_plan_image',
                'payment_plan_text'
            ]);
        });
    }
};
