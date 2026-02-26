<?php

namespace App\Http\Middleware;

use App\Models\Admin\Language;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check session for chosen language
        if (Session::has('locale')) {
            $code = Session::get('locale');
            $language = Language::where('code', $code)
                ->where('status', true)
                ->first();

            if ($language) {
                App::setLocale($code);
                view()->share('current_language', $language);
                Session::put('locale_dir', $language->direction ?? $language->dir ?? 'ltr');
            } else {
                // If language not found in DB, we still set the locale from session
                // This allows it to work with JSON files
                App::setLocale($code);
                Session::put('locale_dir', Session::get('locale_dir', 'ltr'));
                
                // Provide a dummy object for views that expect $current_language
                view()->share('current_language', (object)[
                    'code' => $code,
                    'name' => strtoupper($code),
                    'direction' => Session::get('locale_dir', 'ltr'),
                    'dir' => Session::get('locale_dir', 'ltr')
                ]);
            }
        } else {
            // Set default language
            $this->setDefaultLanguage();
        }

        return $next($request);
    }

    /**
     * Set default language
     */
    private function setDefaultLanguage()
    {
        $defaultLanguage = Language::where('status', true)->first();

        if (!$defaultLanguage) {
            $defaultLanguage = Language::first();
        }

        if ($defaultLanguage) {
            Session::put('locale', $defaultLanguage->code);
            Session::put('locale_dir', $defaultLanguage->direction ?? $defaultLanguage->dir ?? 'ltr');
            App::setLocale($defaultLanguage->code);
            view()->share('current_language', $defaultLanguage);
        } else {
            // Fallback to 'en' if no language in DB
            App::setLocale('en');
            Session::put('locale', 'en');
            Session::put('locale_dir', 'ltr');
        }
    }
}
