@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Site Settings') }}
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Alpine Tabs Container -->
                    <div x-data="{ activeTab: 'general' }">
                        
                        <!-- Tab Navigation -->
                        <div class="border-b border-gray-200 mb-6">
                            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                <button type="button" @click="activeTab = 'general'" :class="{'border-indigo-500 text-indigo-600': activeTab === 'general', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'general'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                                    General Info
                                </button>
                                <button type="button" @click="activeTab = 'footer'" :class="{'border-indigo-500 text-indigo-600': activeTab === 'footer', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'footer'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                                    Footer Settings
                                </button>
                                <button type="button" @click="activeTab = 'about'" :class="{'border-indigo-500 text-indigo-600': activeTab === 'about', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'about'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                                    About Page
                                </button>
                                <button type="button" @click="activeTab = 'contact'" :class="{'border-indigo-500 text-indigo-600': activeTab === 'contact', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'contact'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                                    Contact Page
                                </button>
                            </nav>
                        </div>

                        <!-- Tab Contents -->
                        <div class="tab-content">
                            
                            <!-- General Tab -->
                            <div x-show="activeTab === 'general'" x-transition.opacity.duration.300ms>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Header Logo -->
                                    <div class="mb-4">
                                        <label for="header_logo" class="block text-sm font-medium text-gray-700">Header Logo</label>
                                        @if($setting->header_logo)
                                            <div class="mt-2 mb-2 p-2 bg-gray-800 inline-block rounded">
                                                <img src="{{ $setting->header_logo }}" alt="Logo" class="h-10 object-contain">
                                            </div>
                                        @endif
                                        <input type="file" name="header_logo" id="header_logo" class="mt-1 block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-indigo-50 file:text-indigo-700
                                            hover:file:bg-indigo-100" accept="image/*">
                                        @error('header_logo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Footer Tab -->
                            <div x-show="activeTab === 'footer'" x-transition.opacity.duration.300ms style="display: none;">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="mb-4 md:col-span-2">
                                        <label for="footer_logo" class="block text-sm font-medium text-gray-700">Footer Logo</label>
                                        @if($setting->footer_logo)
                                            <div class="mt-2 mb-2 p-2 bg-gray-800 inline-block rounded">
                                                <img src="{{ $setting->footer_logo }}" alt="Footer Logo" class="h-10 object-contain">
                                            </div>
                                        @endif
                                        <input type="file" name="footer_logo" id="footer_logo" class="mt-1 block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold
                                            file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*">
                                        @error('footer_logo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="footer_phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                        <input type="text" name="footer_phone" id="footer_phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('footer_phone', $setting->footer_phone) }}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="footer_email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" name="footer_email" id="footer_email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('footer_email', $setting->footer_email) }}">
                                    </div>
                                    <div class="mb-4 md:col-span-2">
                                        <h4 class="text-md font-medium text-gray-900 border-b border-gray-200 pb-2 mb-4">Social Media Links</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div>
                                                <label for="social_facebook" class="block text-xs font-medium text-gray-700">Facebook URL</label>
                                                <input type="url" name="social_facebook" id="social_facebook" placeholder="https://facebook.com/..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" value="{{ old('social_facebook', $setting->social_facebook) }}">
                                            </div>
                                            <div>
                                                <label for="social_youtube" class="block text-xs font-medium text-gray-700">YouTube URL</label>
                                                <input type="url" name="social_youtube" id="social_youtube" placeholder="https://youtube.com/..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" value="{{ old('social_youtube', $setting->social_youtube) }}">
                                            </div>
                                            <div>
                                                <label for="social_instagram" class="block text-xs font-medium text-gray-700">Instagram URL</label>
                                                <input type="url" name="social_instagram" id="social_instagram" placeholder="https://instagram.com/..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" value="{{ old('social_instagram', $setting->social_instagram) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4 md:col-span-2">
                                        <label for="footer_address" class="block text-sm font-medium text-gray-700">Address</label>
                                        <textarea name="footer_address" id="footer_address" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('footer_address', $setting->footer_address) }}</textarea>
                                    </div>
                                    <div class="mb-4 md:col-span-2">
                                        <label for="footer_description" class="block text-sm font-medium text-gray-700">Footer Description</label>
                                        <textarea name="footer_description" id="footer_description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('footer_description', $setting->footer_description) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- About Page Tab -->
                            <div x-show="activeTab === 'about'" x-transition.opacity.duration.300ms style="display: none;">
                                <div class="grid grid-cols-1 gap-6">
                                    <div class="mb-4">
                                        <label for="about_image" class="block text-sm font-medium text-gray-700">About Hero Image</label>
                                        @if($setting->about_image)
                                            <div class="mt-2 mb-2 p-2 bg-gray-100 inline-block rounded">
                                                <img src="{{ $setting->about_image }}" alt="About Image" class="h-20 object-cover">
                                            </div>
                                        @endif
                                        <input type="file" name="about_image" id="about_image" class="mt-1 block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold
                                            file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*">
                                    </div>
                                    <div class="mb-4">
                                        <label for="about_side_image" class="block text-sm font-medium text-gray-700">About Content/Side Image</label>
                                        @if($setting->about_side_image)
                                            <div class="mt-2 mb-2 p-2 bg-gray-100 inline-block rounded">
                                                <img src="{{ $setting->about_side_image }}" alt="About Side Image" class="h-20 object-cover">
                                            </div>
                                        @endif
                                        <input type="file" name="about_side_image" id="about_side_image" class="mt-1 block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold
                                            file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*">
                                    </div>
                                    <div class="mb-4">
                                        <label for="about_content" class="block text-sm font-medium text-gray-700 mb-2">About Content</label>
                                        <textarea name="about_content" id="about_content" rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('about_content', $setting->about_content) }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <h4 class="text-md font-medium text-gray-900 border-b border-gray-200 pb-2 mb-4">About Page Stats</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div class="border p-4 rounded-md border-gray-200 bg-gray-50">
                                                <h5 class="text-xs font-bold text-gray-500 uppercase mb-3">Stat 1</h5>
                                                <div class="mb-3">
                                                    <label for="stat_1_number" class="block text-xs font-medium text-gray-700">Number (e.g. 25)</label>
                                                    <input type="text" name="stat_1_number" id="stat_1_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" value="{{ old('stat_1_number', $setting->stat_1_number) }}">
                                                </div>
                                                <div>
                                                    <label for="stat_1_label" class="block text-xs font-medium text-gray-700">Label (e.g. Years of Excellence)</label>
                                                    <input type="text" name="stat_1_label" id="stat_1_label" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" value="{{ old('stat_1_label', $setting->stat_1_label) }}">
                                                </div>
                                            </div>
                                            <div class="border p-4 rounded-md border-gray-200 bg-gray-50">
                                                <h5 class="text-xs font-bold text-gray-500 uppercase mb-3">Stat 2</h5>
                                                <div class="mb-3">
                                                    <label for="stat_2_number" class="block text-xs font-medium text-gray-700">Number (e.g. 50)</label>
                                                    <input type="text" name="stat_2_number" id="stat_2_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" value="{{ old('stat_2_number', $setting->stat_2_number) }}">
                                                </div>
                                                <div>
                                                    <label for="stat_2_label" class="block text-xs font-medium text-gray-700">Label (e.g. Signature Projects)</label>
                                                    <input type="text" name="stat_2_label" id="stat_2_label" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" value="{{ old('stat_2_label', $setting->stat_2_label) }}">
                                                </div>
                                            </div>
                                            <div class="border p-4 rounded-md border-gray-200 bg-gray-50">
                                                <h5 class="text-xs font-bold text-gray-500 uppercase mb-3">Stat 3</h5>
                                                <div class="mb-3">
                                                    <label for="stat_3_number" class="block text-xs font-medium text-gray-700">Number (e.g. 100)</label>
                                                    <input type="text" name="stat_3_number" id="stat_3_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" value="{{ old('stat_3_number', $setting->stat_3_number) }}">
                                                </div>
                                                <div>
                                                    <label for="stat_3_label" class="block text-xs font-medium text-gray-700">Label (e.g. Happy Families)</label>
                                                    <input type="text" name="stat_3_label" id="stat_3_label" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" value="{{ old('stat_3_label', $setting->stat_3_label) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Page Tab -->
                            <div x-show="activeTab === 'contact'" x-transition.opacity.duration.300ms style="display: none;">
                                <div class="grid grid-cols-1 gap-6">
                                    <div class="mb-4">
                                        <label for="contact_image" class="block text-sm font-medium text-gray-700">Contact Hero Image</label>
                                        @if($setting->contact_image)
                                            <div class="mt-2 mb-2 p-2 bg-gray-100 inline-block rounded">
                                                <img src="{{ $setting->contact_image }}" alt="Contact Image" class="h-20 object-cover">
                                            </div>
                                        @endif
                                        <input type="file" name="contact_image" id="contact_image" class="mt-1 block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold
                                            file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*">
                                    </div>
                                    <div class="mb-4">
                                        <label for="contact_content" class="block text-sm font-medium text-gray-700 mb-2">Contact Details / Content</label>
                                        <textarea name="contact_content" id="contact_content" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('contact_content', $setting->contact_content) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end tabs content -->
                    </div> <!-- end alpine data -->

                    <div class="flex items-center justify-end mt-8 pt-4 border-t border-gray-200">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                            Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add CKEditor script and styles -->
<style>
    .ck-editor__editable_inline {
        min-height: 250px;
        max-height: 400px;
        overflow-y: auto !important;
    }
</style>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        ClassicEditor
            .create(document.querySelector('#about_content'), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ]
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#contact_content'), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'sourceEditing' ]
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>
@endsection
