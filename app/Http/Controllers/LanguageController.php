<?php

namespace App\Http\Controllers;

use App\Models\Admin\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function languageSwitch(Request $request)
    {
        $code = $request->language_switch;

        $language = Language::where("code", $code)
            ->where('status', true)
            ->first();

        // Even if not in DB, we allow common languages that have translation files
        $allowed_codes = ['en', 'es', 'fr', 'de', 'ar'];
        if (!$language && !in_array($code, $allowed_codes)) {
            return back()->with(['error' => ['Oops! Language Not Found!']]);
        }

        // Set session and locale
        Session::put('locale', $code);
        Session::put('locale_dir', $language ? ($language->direction ?? $language->dir ?? 'ltr') : 'ltr');

        // Apply locale immediately
        App::setLocale($code);

        $name = $language ? $language->name : strtoupper($code);
        return back()->with(['success' => ['Language switched to ' . $name]]);
    }
}
