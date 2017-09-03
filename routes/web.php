<?php
Route::resource('/painel/produtos', 'Painel\ProdutoController');

Route::get('/', 'Site\SiteController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
