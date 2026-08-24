{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
{!! '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' !!}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('frontend.about') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('frontend.contact') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('frontend.blogs') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>

    @foreach($brands as $brand)
        <url>
            <loc>{{ route('frontend.dynamic', $brand->slug) }}</loc>
            <lastmod>{{ $brand->updated_at ? $brand->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
        
        @foreach($projectTypes as $type)
            <url>
                <loc>{{ route('frontend.dynamic.type', ['slug' => $brand->slug, 'type' => strtolower($type->name)]) }}</loc>
                <lastmod>{{ now()->toAtomString() }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>
        @endforeach
    @endforeach

    @foreach($projects as $project)
        <url>
            <loc>{{ route('frontend.dynamic', $project->slug) }}</loc>
            <lastmod>{{ $project->updated_at ? $project->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach

    @foreach($blogs as $blog)
        <url>
            <loc>{{ route('frontend.blog_detail', ['category_slug' => $blog->blogCategory->slug ?? 'uncategorized', 'slug' => $blog->slug]) }}</loc>
            <lastmod>{{ $blog->updated_at ? $blog->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach
{!! '</urlset>' !!}
