<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ItemFormValidation;
use App\Http\Middleware\ImportFileValidation;

Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

Route::middleware('auth')->group(function () {
    Route::get('/', 'ItemController@index')->name('server-list');

    Route::prefix('server')->group(function() {
        Route::get('/history/{key?}', 'ImportController@history')->name('server-history-list');

        Route::get('/import', 'ImportController@import')->name('server-import');
        Route::post('/import', 'ImportController@importAction')
            ->middleware(ImportFileValidation::class)
            ->name('server-import-post');

        Route::get('/add', 'ItemController@add')->name('server-add');
        Route::post('/store', 'ItemController@store')
            ->middleware(ItemFormValidation::class)
            ->name('server-store');

        Route::get('/edit/{id}', 'ItemController@edit')->name('server-edit');
        Route::post('/update/{id}', 'ItemController@update')
            ->middleware(ItemFormValidation::class)
            ->name('server-update');

        Route::get('/view/{id}', 'ItemController@view')->name('server-view');
        Route::delete('/delete/{id}', 'ItemController@delete')->name('server-delete');
    });
});
