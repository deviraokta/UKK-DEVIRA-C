<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('setting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();

        $setting->update([
            'denda_per_hari' => $request->denda_per_hari,
            'denda_hilang' => $request->denda_hilang,
        ]);

        return back()->with('success', 'Setting berhasil diupdate');
    }
}