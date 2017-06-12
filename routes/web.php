<?php

// CORS
header('Access-Control-Allow-Origin: http://secure-scrubland-50266.herokuapp.com');
header('Access-Control-Allow-Credentials: true');

Route::get('/', 'PortfolioController@index');

//Route::get('/test-single', 'PortfolioController@index');

Auth::routes();
//TEST ROUTES
Route::get('/404', function ()
{
    return view('errors.404');
});


// END TEST ROUTES
Route::get('/admin', ['middleware' => 'cors', 'uses' => 'HomeController@index']);
Route::post('add-item', ['middleware' => 'cors', 'uses' =>'PortfolioController@store']);
Route::get('/all-items', ['middleware' => 'cors', 'uses' =>'PortfolioController@allItems']);

Route::post('edit-item/{slug}', ['middleware' => 'cors', 'uses' =>'PortfolioController@edit']);

Route::get('item/{slug}', [
    'as' => 'item', 'uses' => 'PortfolioController@show'
])->where('slug', '[A-Za-z0-9-_]+');
