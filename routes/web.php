<?php


Route::get('/', 'PortfolioController@index');

//Route::get('/test-single', 'PortfolioController@index');

Auth::routes();

Route::get('/admin', 'HomeController@index');

Route::post('add-item', 'PortfolioController@store');

Route::get('item/{slug}', [
    'as' => 'item', 'uses' => 'PortfolioController@show'
])->where('slug', '[A-Za-z0-9-_]+');
