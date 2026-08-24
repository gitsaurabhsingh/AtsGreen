<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $setting = SiteSetting::firstOrCreate(
            ['id' => 1],
            [
                'hero_heading' => 'A Legacy of Excellence.',
                'hero_subheading' => 'Discover world-class luxury residences and commercial spaces crafted by ATS and ATS Homekraft.',
            ]
        );

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = SiteSetting::first();

        $data = $request->validate([
            'hero_heading' => 'nullable|string|max:255',
            'hero_subheading' => 'nullable|string',
            'header_logo' => 'nullable|image|max:2048',
            'footer_logo' => 'nullable|image|max:2048',
            'hero_bg_image' => 'nullable|image|max:4096',
            'footer_description' => 'nullable|string',
            'footer_address' => 'nullable|string',
            'footer_phone' => 'nullable|string|max:50',
            'footer_email' => 'nullable|email|max:100',
            'about_content' => 'nullable|string',
            'about_image' => 'nullable|image|max:4096',
            'contact_content' => 'nullable|string',
            'contact_image' => 'nullable|image|max:4096',
            'social_facebook' => 'nullable|url|max:255',
            'social_youtube' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'about_side_image' => 'nullable|image|max:4096',
            'stat_1_number' => 'nullable|string|max:50',
            'stat_1_label' => 'nullable|string|max:100',
            'stat_2_number' => 'nullable|string|max:50',
            'stat_2_label' => 'nullable|string|max:100',
            'stat_3_number' => 'nullable|string|max:50',
            'stat_3_label' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('header_logo')) {
            if ($setting->header_logo) {
                Storage::disk('public')->delete($setting->header_logo);
            }
            $data['header_logo'] = $request->file('header_logo')->store('settings', 'public');
        }

        if ($request->hasFile('footer_logo')) {
            if ($setting->footer_logo) {
                Storage::disk('public')->delete($setting->footer_logo);
            }
            $data['footer_logo'] = $request->file('footer_logo')->store('settings', 'public');
        }

        if ($request->hasFile('hero_bg_image')) {
            if ($setting->hero_bg_image) {
                Storage::disk('public')->delete($setting->hero_bg_image);
            }
            $data['hero_bg_image'] = $request->file('hero_bg_image')->store('settings', 'public');
        }

        if ($request->hasFile('about_image')) {
            if ($setting->about_image) {
                Storage::disk('public')->delete($setting->about_image);
            }
            $data['about_image'] = $request->file('about_image')->store('settings', 'public');
        }

        if ($request->hasFile('contact_image')) {
            if ($setting->contact_image) {
                Storage::disk('public')->delete($setting->contact_image);
            }
            $data['contact_image'] = $request->file('contact_image')->store('settings', 'public');
        }

        if ($request->hasFile('about_side_image')) {
            if ($setting->about_side_image) {
                Storage::disk('public')->delete($setting->about_side_image);
            }
            $data['about_side_image'] = $request->file('about_side_image')->store('settings', 'public');
        }

        $setting->update($data);

        return redirect()->back()->with('success', 'Site settings updated successfully.');
    }
}
