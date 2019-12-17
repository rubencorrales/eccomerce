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

// formacion
    // get
    Route::get('/candidatos/formacion/borrar/{id}', 'FormacionController@delete')->name('borrarformacion');

    // post
    Route::post('storeFormacion', 'FormacionController@store');

// experiencia

    // get
    Route::get('/candidatos/experiencia/borrar/{id}', 'ExperienciaController@delete')->name('borrarexperiencia');
    Route::get('/candidatos/experiencia/mostrar/{id}', 'ExperienciaController@mostrar')->name('mostrarexperiencia');
    Route::get('/candidatos/perfil#nav-experiencia', 'ExperienciaController@index')->name('experiencia');

    // post
    Route::post('store_exp', 'ExperienciaController@store');
    Route::post('/candidatos/leerunregistro/{id}', 'ExperienciaController@leerUnRegistro')->name('leerexperiencia');


// cadindiatos

    // get
    Route::get('/candidatos/perfil#nav-formacion', 'CandidatoController@index')->name('formacion');
    Route::get('/candidatos/perfil', 'CandidatoController@index')->name('perfil');
    Route::get('/candidatos/avatar/{filename}', 'CandidatoController@getAvatar')->name('candidato.avatar');
    Route::get('/candidatos/documentos/{filename}', 'FormacionController@getDocumento')->name('candidato.documento');

    // post
    Route::post('candidatos/salvar_telefonos', 'CandidatoController@salvar_telefonos');
    Route::post('candidatos/subir_avatar', 'CandidatoController@subir_avatar');
    Route::post('store', 'CandidatoController@store');


    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');




