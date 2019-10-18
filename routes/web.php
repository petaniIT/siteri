<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('akademik')->name('akademik.')->group(function (){
	// Route::redirect('/', '/akademik/dashboard');
	Route::get('/', 'akademikController@dashboard')->name('dashboard');

	Route::get('/skripsi', 'SkSkripsiController@index')->name('skripsi.index');
	Route::get('/skripsi/create','SkSkripsiController@create')->name('skripsi.create');
	Route::post('/skripsi', 'SkSkripsiController@store')->name('skripsi.store');
	Route::get('/skripsi/{id_sk_akademik}', 'SkSkripsiController@show')->name('skripsi.show');
	Route::get('/skripsi/{id_sk_akademik}/edit','SkSkripsiController@edit')->name('skripsi.edit');
	Route::put('/skripsi/{id_sk_akademik}/update','SkSkripsiController@update')->name('skripsi.update');
	Route::delete('/skripsi/delete/{id_sk_akademik?}', 'SkSkripsiController@destroy')->name('skripsi.destroy');

	Route::get('/sempro', 'SkSemproController@index')->name('sempro.index');
	Route::get('/sempro/create', 'SkSemproController@create')->name('sempro.create');
	Route::post('/sempro', 'SkSemproController@store')->name('sempro.store');
	Route::get('/sempro/{id_sk_akademik}', 'SkSemproController@show')->name('sempro.show');
	Route::get('/sempro/{id_sk_akademik}/edit', 'SkSemproController@edit')->name('sempro.edit');
	Route::put('/sempro/{id_sk_akademik}/update', 'SkSemproController@update')->name('sempro.update');
	Route::delete('/sempro/delete/{id_sk_akademik?}', 'SkSemproController@destroy')->name('sempro.destroy');
});

Route::prefix('ktu')->name('ktu.')->group(function ()
{
	Route::get('/', function() {
	    return view('ktu.dashboard');
	});
	Route::get('/sk-skripsi', 'SkSkripsiController@ktu_index_skripsi')->name('sk-skripsi.index');
	Route::get('/sk-skripsi/{id_sk_akademik}', 'SkSkripsiController@ktu_show')->name('sk-skripsi.show');
	Route::put('/sk-skripsi/verif/{id_sk_akademik}', 'SkSkripsiController@ktu_verif')->name('sk-skripsi.verif');

	Route::get('/sk-sempro', 'SkSemproController@ktu_index_sempro')->name('sk-sempro.index');
	Route::get('/sk-sempro/{id_sk_akademik}', 'SkSemproController@ktu_show')->name('sk-sempro.show');
	Route::put('/sk-sempro/verif/{id_sk_akademik}', 'SkSemproController@ktu_verif')->name('sk-sempro.verif');

});

Route::prefix('dekan')->name('dekan.')->group(function()
{
	Route::get('/', function()
	{
		return view('dekan.dashboard');
	});
	Route::get('/sk-skripsi', 'SkSkripsiController@dekan_index_skripsi')->name('sk-skripsi.index');
	Route::get('/sk-skripsi/{id_sk_akademik}', 'SkSkripsiController@dekan_show')->name('sk-skripsi.show');
	Route::put('/sk-skripsi/verif/{id_sk_akademik}', 'SkSkripsiController@dekan_verif')->name('sk-skripsi.verif');

	Route::get('/sk-sempro', 'SkSemproController@dekan_index_sempro')->name('sk-sempro.index');
	Route::get('/sk-sempro/{id_sk_akademik}', 'SkSemproController@dekan_show')->name('sk-sempro.show');
	Route::put('/sk-sempro/verif/{id_sk_akademik}', 'SkSemproController@dekan_verif')->name('sk-sempro.verif');
});

Route::prefix('keuangan')->name('keuangan.')->group(function()
{
	Route::get('/', function() {
	    return view('keuangan.dashboard');
	});

	Route::get('/honor-skripsi/', 'honorSkripsiController@index')->name('honor-skripsi.index');
	Route::get('/honor-skripsi/pilih-sk', 'honorSkripsiController@pilih_sk')->name('honor-skripsi.pilih-sk');
	Route::get('/honor-skripsi/create/{id_sk_akademik}', 'honorSkripsiController@create')->name('honor-skripsi.create');
	Route::post('/honor-skripsi/store', 'honorSkripsiController@store')->name('honor-skripsi.store');
	Route::get('/honor-skripsi/{id_sk_honor}','honorSkripsiController@show')->name('honor-skripsi.show');
	Route::get('/honor-skripsi/{id_sk_honor}/edit','honorSkripsiController@edit')->name('honor-skripsi.edit');
	Route::put('/honor-skripsi/{id_sk_honor}/update','honorSkripsiController@update')->name('honor-skripsi.update');
	Route::delete('/honor-skripsi/delete/{id_sk_honor?}', 'honorSkripsiController@destroy')->name('honor-skripsi.destroy');

	Route::get('/honor-sempro/', 'honorSemproController@index')->name('honor-sempro.index');
	Route::get('/honor-sempro/pilih-sk', 'honorSemproController@pilih_sk')->name('honor-sempro.pilih-sk');
	Route::get('/honor-sempro/create/{id_sk_akademik}', 'honorSemproController@create')->name('honor-sempro.create');
	Route::post('/honor-sempro/store', 'honorSemproController@store')->name('honor-sempro.store');
	Route::get('/honor-sempro/{id_sk_honor}', 'honorSemproController@show')->name('honor-sempro.show');
	Route::get('/honor-sempro/{id_sk_honor}/edit', 'honorSemproController@edit')->name('honor-sempro.edit');
	Route::put('/honor-sempro/{id_sk_honor}/update', 'honorSemproController@update')->name('honor-sempro.update');
	Route::delete('/honor-sempro/delete/{id_sk_honor?}', 'honorSemproController@destroy')->name('honor-sempro.destroy');

});

Route::prefix('bpp')->name('bpp.')->group(function()
{
	Route::get('/', function() {
	    return view('bpp.dashboard');
	});
	Route::get('/honor-skripsi', 'honorSkripsiController@bpp_index')->name('honor-skripsi.index');
	Route::get('/honor-skripsi/{id_sk_honor}', 'honorSkripsiController@bpp_show')->name('honor-skripsi.show');
	Route::put('/honor-skripsi/verif/{id_sk_honor}', 'honorSkripsiController@bpp_verif')->name('honor-skripsi.verif');

	Route::get('/honor-sempro', 'honorSemproController@bpp_index')->name('honor-sempro.index');
	Route::get('/honor-sempro/{id_sk_honor}', 'honorSemproController@bpp_show')->name('honor-sempro.show');
	Route::put('/honor-sempro/verif/{id_sk_honor}', 'honorSemproController@bpp_verif')->name('honor-sempro.verif');

});
