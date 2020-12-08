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

Route::get('/welcome', function () {
    return view('welcome');
});

//controle Login
Route::get('/login',['as'=>'site.login','uses'=>'LoginController@index']);
Route::get('/login/sair',['as'=>'site.login.sair','uses'=>'LoginController@sair']);
Route::post('/login/entrar',['as'=>'site.login.entrar','uses'=>'LoginController@entrar']);

Route::get('/',['as'=>'site.home','uses'=>'clienteController@index']);



Route::group(['middleware' => 'auth'], function(){  




//controle Clientes

Route::get('/clientes',['as'=>'site.clientes.listar','uses'=>'clienteController@listarClientes']);
Route::get('/Cadastro_clientes',['as'=>'site.clientes.cadastrar','uses'=>'clienteController@cadastrarClientes']);
Route::post('/Cadastro_clientes/salvar',['as'=>'site.clientes.salvar','uses'=>'clienteController@salvarClientes']);

Route::put('/cadastro_clientes/atualizar/{id}',['as'=>'site.clientes.atualizar','uses'=>'clienteController@atualizarClientes']);
Route::get('/clientes/buscar',['as'=>'site.clientes.buscar','uses'=>'clienteController@buscarClientes']);


//controle promissorias

Route::get('/comprasClientes/{id}',['as'=>'site.compras.listar.clientes','uses'=>'comprasController@listarComprasClientes']);
Route::post('/compras/salvar',['as'=>'site.compras.salvar','uses'=>'comprasController@salvarCompras']);
Route::post('/compras/haver',['as'=>'site.compras.haver','uses'=>'comprasController@salvarHaver']);
Route::post('/compras/verJuros',['as'=>'site.compras.verJuros','uses'=>'comprasController@verJuros']);


//caixa
Route::get('caixa',['as' =>'site.caixa.listar','uses'=>'caixaController@getCaixa']);    
Route::post('/caixa/novo',['as'=>'site.caixa.novo','uses'=>'caixaController@novoCaixa']);
Route::post('/caixa/novoMovimento',['as'=>'site.caixa.novoMovimento','uses'=>'caixaController@novoMovimento']);
Route::post('/caixa/caixaEncerrado',['as'=>'site.caixa.fecharCaixa','uses'=>'caixaController@fecharCaixa']);

});

Route::group(['middleware' => ['auth', 'auth.admin']], function () { // Minhas rotas da administração aqui
   
//editar clientes
Route::get('/cadastro_clientes/editar/{id}',['as'=>'site.clientes.editar','uses'=>'clienteController@EditarClientes']);

//vendedores 
Route::get('/Cadastro_vendedores',['as'=>'site.vendedores.cadastrar','uses'=>'clienteController@cadastrarVendedores']);
Route::post('/Cadastro_vendedores/salvar',['as'=>'site.vendedores.salvar','uses'=>'clienteController@salvarVendedores']);
Route::get('/cadastro_vendedora/editar/{id}',['as'=>'site.vendedoras.editar','uses'=>'clienteController@EditarVendedoras']);
Route::post('/Cadastro_vendedores/atualizar/{id}',['as'=>'site.vendedores.atualizar','uses'=>'clienteController@atualizarVendedores']);

//controle promissorias
Route::get('/compras',['as'=>'site.compras.listar','uses'=>'comprasController@listarCompras']);

//promissorias
Route::get('/compras/excluir/{id}/{cli}',['as'=>'site.compras.excluir','uses'=>'comprasController@ExcluirCompras']);

//Relatórios
Route::get('/relatorioPromissorias',['as' =>'site.relatorios.relatorioPromissorias','uses'=>'relatoriosController@getPromissorias']); 
Route::get('/relatorioContabil',['as' =>'site.relatorios.relatorioContabil','uses'=>'relatoriosController@getContabil']); 
Route::get('/relatorioVendedores',['as' =>'site.relatorios.relatorioVendedores','uses'=>'relatoriosController@getVendedores']); 

//configuração
Route::get('/configuracao',['as' =>'site.configuracao','uses'=>'setup@getConfiguracao']); 
Route::post('/salvarConfiguracao',['as' =>'site.configuracao.salvar','uses'=>'setup@salvarConfiguracao']); 

});




//Auth::routes(); rotar do middlware
Route::get('/homeem', 'HomeController@index');
