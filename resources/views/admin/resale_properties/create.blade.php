@extends('layouts.admin')

@section('header', 'Add New Resale Property')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 max-w-4xl">
    <div class="mb-6">
        <a href="{{ route('admin.resale-properties.index') }}" class="text-blue-600 hover:text-blue-900">&larr; Back to Resale Properties</a>
    </div>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.resale-properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="md:col-span-2">
                <label for="project_id" class="block text-sm font-medium text-gray-700 mb-1">Parent Project <span class="text-red-500">*</span></label>
                <select name="project_id" id="project_id" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50 px-3 py-2 border">
                    <option value="">Select Parent Project</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->project_name }}</option>
                    @endforeach
                </select>
                @error('project_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="resale_category_id" class="block text-sm font-medium text-gray-700 mb-1">Resale Category</label>
                <select name="resale_category_id" id="resale_category_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50 px-3 py-2 border">
                    <option value="">-- Select Category (Optional) --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('resale_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('resale_category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title / Resale Project Name <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50 px-3 py-2 border" value="{{ old('title') }}">
                @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>



            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <input type="text" name="status" id="status" placeholder="e.g. New Launch, Ready to Move" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50 px-3 py-2 border" value="{{ old('status') }}">
                @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>


            <div>
                <label for="locality" class="block text-sm font-medium text-gray-700 mb-1">Locality</label>
                <input type="text" name="locality" id="locality" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50 px-3 py-2 border" value="{{ old('locality') }}">
                @error('locality') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="rera_number" class="block text-sm font-medium text-gray-700 mb-1">RERA Number</label>
                <input type="text" name="rera_number" id="rera_number" placeholder="e.g. UPRERAPRJ12345" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50 px-3 py-2 border" value="{{ old('rera_number') }}">
                @error('rera_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="rera_qr" class="block text-sm font-medium text-gray-700 mb-1">RERA QR Code (Image)</label>
                <input type="file" name="rera_qr" id="rera_qr" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-brand file:text-white hover:file:bg-brand-dark border border-gray-300 rounded-md">
                @error('rera_qr') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="price_label" class="block text-sm font-medium text-gray-700 mb-1">Price Label</label>
                <input type="text" name="price_label" id="price_label" placeholder="e.g. â‚¹ 2.5 Cr*" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50 px-3 py-2 border" value="{{ old('price_label') }}">
                @error('price_label') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center mt-6">
                <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="h-4 w-4 text-brand focus:ring-brand border-gray-300 rounded">
                <label for="featured" class="ml-2 block text-sm text-gray-900">
                    Feature on Homepage
                </label>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-6 mt-6 mb-6">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Project Details</h4>
            
            <div class="mb-6">
                <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">Short Description</label>
                <textarea name="short_description" id="short_description" rows="2" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50 px-3 py-2 border">{{ old('short_description') }}</textarea>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Full Description</label>
                <textarea name="description" id="description" rows="5" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50 px-3 py-2 border">{{ old('description') }}</textarea>
            </div>

            <h4 class="text-lg font-semibold text-gray-800 mb-4 mt-6">Property Details</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                    <input type="text" name="price" id="price" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50 px-3 py-2 border" value="{{ old('price') }}">
                </div>
                <div>
                    <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Area</label>
                    <input type="text" name="area" id="area" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50 px-3 py-2 border" value="{{ old('area') }}">
                </div>
                <div>
                    <label for="bedrooms" class="block text-sm font-medium text-gray-700 mb-1">Bedrooms</label>
                    <input type="text" name="bedrooms" id="bedrooms" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50 px-3 py-2 border" value="{{ old('bedrooms') }}">
                </div>
                <div>
                    <label for="bathrooms" class="block text-sm font-medium text-gray-700 mb-1">Bathrooms</label>
                    <input type="text" name="bathrooms" id="bathrooms" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50 px-3 py-2 border" value="{{ old('bathrooms') }}">
                </div>
                <div>
                    <label for="contact_name" class="block text-sm font-medium text-gray-700 mb-1">Contact Name</label>
                    <input type="text" name="contact_name" id="contact_name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50 px-3 py-2 border" value="{{ old('contact_name') }}">
                </div>
                <div>
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-1">Contact Phone</label>
                    <input type="text" name="contact_phone" id="contact_phone" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50 px-3 py-2 border" value="{{ old('contact_phone') }}">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-1">Banner Image (Hero)</label>
                    <input type="file" name="featured_image" id="featured_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-brand file:text-white hover:file:bg-brand-dark border border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="location_map_image" class="block text-sm font-medium text-gray-700 mb-1">Location Map (Image)</label>
                    <input type="file" name="location_map_image" id="location_map_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-brand file:text-white hover:file:bg-brand-dark border border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="site_plan_image" class="block text-sm font-medium text-gray-700 mb-1">Site Plan (Image)</label>
                    <input type="file" name="site_plan_image" id="site_plan_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-brand file:text-white hover:file:bg-brand-dark border border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="payment_plan_image" class="block text-sm font-medium text-gray-700 mb-1">Payment Plan (Image)</label>
                    <input type="file" name="payment_plan_image" id="payment_plan_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-brand file:text-white hover:file:bg-brand-dark border border-gray-300 rounded-md">
                </div>
            </div>

            <div class="mb-6">
                <label for="payment_plan_text" class="block text-sm font-medium text-gray-700 mb-1">Payment Plan (Text)</label>
                <textarea name="payment_plan_text" id="payment_plan_text" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50 px-3 py-2 border" placeholder="Alternatively, describe the payment plan here...">{{ old('payment_plan_text') }}</textarea>
            </div>
        </div>

        <!-- Floor Plans Section -->
        <div class="border-t border-gray-100 pt-6 mt-6 mb-6">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Floor Plans Gallery</h4>
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                <label for="floor_plans" class="block text-sm font-medium text-gray-700 mb-2">Upload Multiple Images</label>
                <input type="file" name="floor_plans[]" id="floor_plans" accept="image/*" multiple class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-brand file:text-white hover:file:bg-brand-dark border border-gray-300 rounded-md bg-white p-2">
                <p class="text-xs text-gray-500 mt-2">Hold down the Ctrl (Windows) or Command (Mac) button to select multiple files at once. The image filenames will be automatically used as the Floor Plan titles.</p>
                @error('floor_plans') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                @error('floor_plans.*') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- FAQs Dynamic Section -->
        <div class="border-t border-gray-100 pt-6 mt-6 mb-6" x-data="{ faqs: [] }">
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-lg font-semibold text-gray-800">FAQs</h4>
                <button type="button" @click="faqs.push({ id: Date.now() })" class="px-3 py-1 text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition">+ Add FAQ</button>
            </div>
            
            <template x-for="(faq, index) in faqs" :key="faq.id">
                <div class="mb-4 bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-xs font-medium text-gray-700">Question <span class="text-red-500">*</span></label>
                        <button type="button" @click="faqs.splice(index, 1)" class="text-red-500 hover:text-red-700 text-xs">Remove</button>
                    </div>
                    <input type="text" :name="'faqs['+index+'][question]'" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50 px-3 py-2 border text-sm mb-3">
                    
                    <label class="block text-xs font-medium text-gray-700 mb-1">Answer <span class="text-red-500">*</span></label>
                    <textarea :name="'faqs['+index+'][answer]'" rows="2" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50 px-3 py-2 border text-sm"></textarea>
                </div>
            </template>
            <p x-show="faqs.length === 0" class="text-sm text-gray-500 italic">No FAQs added yet.</p>
        </div>

        <div class="flex justify-end gap-3 mt-8 border-t pt-4">
            <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-brand text-white rounded-md hover:bg-brand-dark transition">Save Project</button>
        </div>
    </form>
</div>

<!-- TinyMCE HTML Editor -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
<script>
  tinymce.init({
    selector: '#description',
    height: 300,
    menubar: false,
    plugins: [
      'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
      'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
      'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
    ],
    toolbar: 'undo redo | blocks | ' +
    'bold italic forecolor | alignleft aligncenter ' +
    'alignright alignjustify | bullist numlist outdent indent | ' +
    'removeformat | help',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
  });
</script>
@endsection
