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
        Schema::table('resale_properties', function (Blueprint $table) {
            $table->foreignId('resale_category_id')->nullable()->after('project_id')->constrained('resale_categories')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resale_properties', function (Blueprint $table) {
            $table->dropForeign(['resale_category_id']);
            $table->dropColumn('resale_category_id');
        });
    }
};
