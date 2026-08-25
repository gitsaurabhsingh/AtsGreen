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
            $table->unsignedBigInteger('brand_id')->nullable()->after('id');
            $table->string('project_type')->nullable()->after('title');
            $table->string('location')->nullable()->after('project_type');
            $table->string('city')->nullable()->after('location');
            $table->string('locality')->nullable()->after('city');
            $table->string('state')->nullable()->after('locality');
            $table->string('property_type')->nullable()->after('state');
            $table->string('status')->nullable()->after('property_type');
            
            $table->string('price_from')->nullable()->after('price');
            $table->string('price_to')->nullable()->after('price_from');
            $table->string('price_label')->nullable()->after('price_to');
            
            $table->string('rera_number')->nullable()->after('is_active');
            $table->string('rera_url')->nullable()->after('rera_number');
            $table->string('rera_qr')->nullable()->after('rera_url');
            
            $table->string('total_area')->nullable()->after('area');
            $table->string('total_units')->nullable()->after('total_area');
            $table->string('total_towers')->nullable()->after('total_units');
            $table->string('tower_height')->nullable()->after('total_towers');
            
            $table->date('possession_date')->nullable();
            $table->date('launch_date')->nullable();
            
            $table->text('short_description')->nullable()->after('description');
            
            $table->string('featured_image')->nullable()->after('image');
            $table->string('brochure')->nullable()->after('featured_image');
            
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('map_embed_url')->nullable();
            
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('canonical_url')->nullable();
            
            $table->boolean('featured')->default(0);
            $table->integer('sort_order')->default(0);
            
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
        Schema::table('resale_properties', function (Blueprint $table) {
            $table->dropColumn([
                'brand_id', 'project_type', 'location', 'city', 'locality', 'state', 'property_type', 'status',
                'price_from', 'price_to', 'price_label', 'rera_number', 'rera_url', 'rera_qr',
                'total_area', 'total_units', 'total_towers', 'tower_height', 'possession_date', 'launch_date',
                'short_description', 'featured_image', 'brochure', 'latitude', 'longitude', 'map_embed_url',
                'meta_title', 'meta_description', 'meta_keywords', 'canonical_url', 'featured', 'sort_order',
                'location_map_image', 'site_plan_image', 'payment_plan_image', 'payment_plan_text'
            ]);
        });
    }
};
