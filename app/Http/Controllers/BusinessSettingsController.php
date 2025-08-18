<?php

namespace App\Http\Controllers;

use App\Models\BusinessSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusinessSettingsController extends Controller
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
            'phone' => 'required|string|max:20',
            'footer_message' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $settings = BusinessSetting::first();
        
        if (!$settings) {
            $settings = new BusinessSetting();
        }

        $settings->business_name = $request->business_name;
        $settings->address = $request->address;
        $settings->city = $request->city;
        $settings->phone = $request->phone;
        $settings->footer_message = $request->footer_message ?? 'Thank you for your purchase!\nPlease come again!';

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($settings->logo_path && Storage::exists('public/' . $settings->logo_path)) {
                Storage::delete('public/' . $settings->logo_path);
            }

            $logoPath = $request->file('logo')->store('logos', 'public');
            $settings->logo_path = $logoPath;
        }

        $settings->save();

        return redirect()->route('settings.edit')->with('success', 'Business settings updated successfully!');
    }
}
