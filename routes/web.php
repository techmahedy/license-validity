<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('', 'welcome');

Route::middleware(['guest'])->group(function () {
    Route::get('register',function(){
        return view()->exists('auth.register') ? 
            view('auth.register') : abort(404); 
    });
    Route::get('login',function(){
        return view()->exists('auth.login') ? 
            view('auth.login') : abort(404); 
    })->name('login');
    Route::post('register','AuthController@register')->name('register');
    Route::post('login','AuthController@login')->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('welcome',function(){
        return view()->exists('home.welcome') ? 
            view('home.welcome') : abort(404); 
    });
    Route::get('/logout',function(){
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');

    Route::get('license','LicenseController@index')->name('license');
    Route::post('license','LicenseController@saveLicense');
    Route::get('check/license','LicenseController@checkLicense')->name('check.license');
    Route::post('check/license','LicenseController@checkLicenseValidity');
});