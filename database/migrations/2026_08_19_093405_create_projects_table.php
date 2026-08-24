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
        Schema::create('projects', function (Blueprint $table) {

            $table->id();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->string('project_name');
            $table->string('slug')->unique();
            $table->string('project_type')->nullable();
            $table->string('location')->nullable();
            $table->string('city')->nullable();
            $table->string('locality')->nullable();
            $table->string('state')->nullable();
            $table->string('property_type')->nullable();
            $table->string('status')->default('Upcoming');
            $table->decimal('price_from', 15, 2)->nullable();
            $table->decimal('price_to', 15, 2)->nullable();
            $table->string('price_label')->nullable();
            $table->string('rera_number')->nullable();
            $table->string('rera_url')->nullable();
            $table->string('total_area')->nullable();
            $table->string('total_units')->nullable();
            $table->string('total_towers')->nullable();
            $table->string('tower_height')->nullable();
            $table->string('possession_date')->nullable();
            $table->string('launch_date')->nullable();
            $table->longText('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('brochure')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('map_embed_url')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('canonical_url')->nullable();
            $table->boolean('featured')->default(0);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
