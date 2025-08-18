<?php

namespace App\Http\Controllers;

use App\Models\BusinessSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusinessSettingController extends Controller
{
    public function edit()
    {
        $settings = BusinessSetting::getSettings();
        return view('settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'footer_message' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $settings = BusinessSetting::getSettings();
        
        // Handle logo upload
        $logoPath = $settings->logo_path;
        if ($request->hasFile('logo')) {
            // Delete old logo if it's not the default
            if ($settings->logo_path !== 'favicon.svg' && Storage::disk('public')->exists($settings->logo_path)) {
                Storage::disk('public')->delete($settings->logo_path);
            }
            
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        $settings->update([
            'business_name' => $request->business_name,
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone,
            'logo_path' => $logoPath,
            'footer_message' => $request->footer_message
        ]);

        return redirect()->route('settings.edit')->with('success', 'Business settings updated successfully!');
    }
}
