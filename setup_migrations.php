<?php
$dir = __DIR__ . '/database/migrations/';
$files = scandir($dir);

$schemas = [
    'brands' => "
            \$table->id();
            \$table->string('name');
            \$table->string('slug')->unique();
            \$table->string('logo')->nullable();
            \$table->text('description')->nullable();
            \$table->boolean('status')->default(1);
            \$table->string('meta_title')->nullable();
            \$table->text('meta_description')->nullable();
            \$table->text('meta_keywords')->nullable();
            \$table->timestamps();
            \$table->softDeletes();
",
    'projects' => "
            \$table->id();
            \$table->foreignId('brand_id')->constrained()->onDelete('cascade');
            \$table->string('project_name');
            \$table->string('slug')->unique();
            \$table->string('project_type')->nullable();
            \$table->string('location')->nullable();
            \$table->string('city')->nullable();
            \$table->string('locality')->nullable();
            \$table->string('state')->nullable();
            \$table->string('property_type')->nullable();
            \$table->string('status')->default('Upcoming');
            \$table->decimal('price_from', 15, 2)->nullable();
            \$table->decimal('price_to', 15, 2)->nullable();
            \$table->string('price_label')->nullable();
            \$table->string('rera_number')->nullable();
            \$table->string('rera_url')->nullable();
            \$table->string('total_area')->nullable();
            \$table->string('total_units')->nullable();
            \$table->string('total_towers')->nullable();
            \$table->string('tower_height')->nullable();
            \$table->string('possession_date')->nullable();
            \$table->string('launch_date')->nullable();
            \$table->longText('description')->nullable();
            \$table->text('short_description')->nullable();
            \$table->string('featured_image')->nullable();
            \$table->string('brochure')->nullable();
            \$table->string('latitude')->nullable();
            \$table->string('longitude')->nullable();
            \$table->text('map_embed_url')->nullable();
            \$table->string('meta_title')->nullable();
            \$table->text('meta_description')->nullable();
            \$table->text('meta_keywords')->nullable();
            \$table->string('canonical_url')->nullable();
            \$table->boolean('featured')->default(0);
            \$table->integer('sort_order')->default(0);
            \$table->timestamps();
            \$table->softDeletes();
",
    'floor_plans' => "
            \$table->id();
            \$table->foreignId('project_id')->constrained()->onDelete('cascade');
            \$table->string('title')->nullable();
            \$table->string('configuration')->nullable();
            \$table->string('area')->nullable();
            \$table->string('image')->nullable();
            \$table->text('description')->nullable();
            \$table->integer('sort_order')->default(0);
            \$table->boolean('status')->default(1);
            \$table->timestamps();
",
    'site_plans' => "
            \$table->id();
            \$table->foreignId('project_id')->constrained()->onDelete('cascade');
            \$table->string('title')->nullable();
            \$table->string('image')->nullable();
            \$table->text('description')->nullable();
            \$table->integer('sort_order')->default(0);
            \$table->boolean('status')->default(1);
            \$table->timestamps();
",
    'price_lists' => "
            \$table->id();
            \$table->foreignId('project_id')->constrained()->onDelete('cascade');
            \$table->string('title')->nullable();
            \$table->string('configuration')->nullable();
            \$table->string('area')->nullable();
            \$table->decimal('base_price', 15, 2)->nullable();
            \$table->decimal('additional_charges', 15, 2)->nullable();
            \$table->decimal('total_price', 15, 2)->nullable();
            \$table->string('payment_plan')->nullable();
            \$table->string('image')->nullable();
            \$table->integer('sort_order')->default(0);
            \$table->boolean('status')->default(1);
            \$table->timestamps();
",
    'faqs' => "
            \$table->id();
            \$table->foreignId('project_id')->constrained()->onDelete('cascade');
            \$table->text('question');
            \$table->text('answer');
            \$table->integer('sort_order')->default(0);
            \$table->boolean('status')->default(1);
            \$table->timestamps();
",
    'amenities' => "
            \$table->id();
            \$table->string('name');
            \$table->string('icon')->nullable();
            \$table->text('description')->nullable();
            \$table->boolean('status')->default(1);
            \$table->timestamps();
",
    'specifications' => "
            \$table->id();
            \$table->foreignId('project_id')->constrained()->onDelete('cascade');
            \$table->string('category')->nullable(); // e.g., Flooring, Kitchen
            \$table->string('title')->nullable();
            \$table->text('description')->nullable();
            \$table->integer('sort_order')->default(0);
            \$table->timestamps();
",
    'project_galleries' => "
            \$table->id();
            \$table->foreignId('project_id')->constrained()->onDelete('cascade');
            \$table->string('image');
            \$table->string('title')->nullable();
            \$table->string('alt_text')->nullable();
            \$table->integer('sort_order')->default(0);
            \$table->boolean('status')->default(1);
            \$table->timestamps();
",
    'nearby_locations' => "
            \$table->id();
            \$table->foreignId('project_id')->constrained()->onDelete('cascade');
            \$table->string('name');
            \$table->string('distance')->nullable();
            \$table->text('description')->nullable();
            \$table->integer('sort_order')->default(0);
            \$table->boolean('status')->default(1);
            \$table->timestamps();
",
    'leads' => "
            \$table->id();
            \$table->foreignId('project_id')->nullable()->constrained()->onDelete('set null');
            \$table->string('name');
            \$table->string('email')->nullable();
            \$table->string('phone');
            \$table->string('whatsapp')->nullable();
            \$table->text('message')->nullable();
            \$table->string('source')->nullable();
            \$table->string('status')->default('New');
            \$table->timestamps();
            \$table->softDeletes();
",
    'blogs' => "
            \$table->id();
            \$table->string('title');
            \$table->string('slug')->unique();
            \$table->text('excerpt')->nullable();
            \$table->longText('content')->nullable();
            \$table->string('featured_image')->nullable();
            \$table->string('author')->nullable();
            \$table->string('category')->nullable();
            \$table->string('meta_title')->nullable();
            \$table->text('meta_description')->nullable();
            \$table->text('meta_keywords')->nullable();
            \$table->string('canonical_url')->nullable();
            \$table->boolean('status')->default(1);
            \$table->timestamp('published_at')->nullable();
            \$table->timestamps();
            \$table->softDeletes();
",
    'project_amenity' => "
            \$table->foreignId('project_id')->constrained()->onDelete('cascade');
            \$table->foreignId('amenity_id')->constrained()->onDelete('cascade');
"
];

foreach ($files as $file) {
    if (strpos($file, 'create_') !== false && strpos($file, '_table.php') !== false) {
        $path = $dir . $file;
        $content = file_get_contents($path);
        
        foreach ($schemas as $table => $schema) {
            if (strpos($file, "create_{$table}_table.php") !== false) {
                // Find public function up
                $pattern = '/Schema::create\(\'' . $table . '\', function \(Blueprint \$table\) \{(.*?)\}\);/s';
                $replacement = "Schema::create('{$table}', function (Blueprint \$table) {\n{$schema}\n        });";
                $newContent = preg_replace($pattern, $replacement, $content);
                file_put_contents($path, $newContent);
                echo "Updated schema for {$table}\n";
                break;
            }
        }
    }
}
