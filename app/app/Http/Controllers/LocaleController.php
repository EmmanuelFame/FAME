<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function change(Request $request)
{
    $locale = $request->input('locale');
    if (in_array($locale, ['en', 'ru'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }

    return redirect()->back();
}

}
