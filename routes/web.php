<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/website', 'SiteController@index')->name('website');

Route::get('/', function () {
	//return redirect()->route('home');
	
	return redirect()->route('website');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::post('fotoPerfil', 'ProfileController@fotoPerfil')->name('fotoPerfil');

});

Route::group(['middleware' => 'auth', 'namespace' => 'usuarios'], function () {
	Route::resource('/usuario', 'UsuariosController');
	Route::get('/usuarioEditar', 'UsuariosController@editar')->name('editUsuario');
	Route::post('/updateUsuario', 'UsuariosController@updateUsuario')->name('updateUsuario');
	Route::get('/usuarioInativar', 'UsuariosController@inativar')->name('inativarUsuario');
	Route::get('/cadastrarUsuario', 'UsuariosController@cadastrarUsuario')->name('cadastrarUsuario');
	
});

Route::group(['middleware' => 'auth', 'namespace' => 'clientes'], function () {
	Route::resource('/cliente', 'ClienteController');
	Route::get('/cadCliente', 'ClienteController@cadCliente')->name('cadCliente');
	Route::get('/editCliente', 'ClienteController@editCliente')->name('editCliente');
	Route::post('/updateCliente', 'ClienteController@updateCliente')->name('updateCliente');
	
});

Route::group(['middleware' => 'auth', 'namespace' => 'produtos'], function () {
	Route::get('/cadProduto', 'ProdutoController@cadastro')->name('cad_produto');
	
});

Route::group(['middleware' => 'auth', 'namespace' => 'propostas'], function () {
	Route::resource('/proposta', 'PropostaController');
	Route::get('/historico', 'PropostaController@historico')->name('historico');
	Route::get('/gerenciaPontos', 'PropostaController@gerenciaPontos')->name('gerenciaPontos');
	Route::post('/storePontos', 'PropostaController@storePontos')->name('storePontos');
	Route::get('/finalizaProposta', 'PropostaController@finalizar')->name('finalizar');
	Route::get('/novaProposta', 'PropostaController@novaProposta')->name('novaProposta');
	Route::resource('/propostaLog', 'PropostaLogController');
	Route::post('/anexos', 'PropostaLogController@anexos')->name('anexos');
	Route::post('/anexos_finalizados', 'PropostaLogController@anexos_finalizados')->name('anexos_finalizados');
	Route::get('/anexos_finalizados', 'PropostaLogController@anexos_finalizados')->name('anexos_finalizados');
	Route::post('/atribuiPontos', 'PropostaController@atribuiPontos')->name('atribuiPontos');
	
	
});

Route::group(['middleware' => 'auth', 'namespace' => 'relatorios'], function () {
	Route::get('/relatorioOperacional', 'operacionalController@index')->name('relatorioOperacional');
	Route::get('/relatorioOperacionalI', 'operacionalController@impressaoRelatorioOp')->name('relatorioOperacionalI');
	Route::post('/relatorioOperacionalFontes', 'operacionalController@fontes')->name('relatorioOperacionalFontes');
	Route::get('/relatorioAdministrativo', 'administrativoController@index')->name('relatorioAdministrativo');

});

Route::group(['middleware' => 'auth'], function () {
	Route::get('/cadPostagem', 'SiteController@index_cad')->name('cadPostagem');
	Route::get('/novaPostagem', 'SiteController@novaPostagem')->name('novaPostagem');
	Route::get('/editarPostagem', 'SiteController@editarPostagem')->name('editarPostagem');
	Route::get('/desabilitarPostagem', 'SiteController@desabilitarPostagem')->name('desabilitarPostagem');
	Route::post('/storePostagem', 'SiteController@storePostagem')->name('storePostagem');
	Route::post('/updatePostagem', 'SiteController@updatePostagem')->name('updatePostagem');
	
});

Route::group(['middleware' => 'auth', 'namespace' => 'clientes'], function () {
	Route::resource('/acompCliente', 'acompController');

});




