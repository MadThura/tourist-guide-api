<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::first();
        return view('admin.setting.index', [
            'setting' => $setting
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'nullable|string|max:100',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'contact_address' => 'nullable|string|max:255',
            'footer_text' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048'
        ]);

        $setting = Setting::first();

        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            $setting->logo = $request->file('logo')->store('images/settings', 'public');
        }

        $setting->update($request->only([
            'app_name',
            'contact_email',
            'contact_phone',
            'contact_address',
            'footer_text'
        ]));

        return back()->with('success', 'Settings updated successfully.');
    }
}
