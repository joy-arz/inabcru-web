<?php

use Illuminate\Support\Facades\Route;

function getTranslations(string $locale): array {
    $file = base_path("resources/lang/{$locale}.json");
    if (file_exists($file)) {
        return json_decode(file_get_contents($file), true);
    }
    return [];
}

function trans_for(string $key, ?string $locale = null): string {
    $locale = $locale ?? app()->getLocale();
    static $translations = [];
    
    if (!isset($translations[$locale])) {
        $translations[$locale] = getTranslations($locale);
    }
    
    $keys = explode('.', $key);
    $value = $translations[$locale] ?? [];
    
    foreach ($keys as $k) {
        if (!isset($value[$k])) {
            return $key;
        }
        $value = $value[$k];
    }
    
    return $value;
}

Route::get('/', function () {
    return redirect('/id');
});

Route::get('/{locale}', function ($locale) {
    if (!in_array($locale, ['id', 'en'])) {
        return redirect('/id');
    }
    app()->setLocale($locale);
    return view('pages.home', ['locale' => $locale]);
})->where('locale', 'id|en');

Route::get('/{locale}/{page}', function ($locale, $page) {
    if (!in_array($locale, ['id', 'en'])) {
        return redirect('/id');
    }
    app()->setLocale($locale);

    $validPages = ['about', 'team', 'donate', 'publications', 'vision-mission', 'programs', 'news', 'impact', 'contact'];

    if (in_array($page, $validPages)) {
        return view("pages.{$page}", ['locale' => $locale]);
    }

    return redirect("/{$locale}");
})->where('locale', 'id|en');