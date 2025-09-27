<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/locale/{locale}', function ($locale) {
    // Set the locale in the session
    $locale = in_array($locale, ['en', 'ar']) ? $locale : 'en';
    session(['locale' => $locale]);
    app()->setLocale($locale);
    // Redirect back to the previous page
    return redirect()->back();
})->name('locale');
