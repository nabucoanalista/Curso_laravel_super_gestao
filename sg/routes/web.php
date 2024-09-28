<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContatoController;
use Illuminate\Support\Facades\Log;


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

Route::get('/', 'PrincipalController@principal')->name('site.index')->middleware('log.acesso');
Route::get('/sobre-nos', 'SobreNosController@sobreNos')->name('site.sobrenos');
Route::get('/contato', 'ContatoController@contato')->name('site.contato');
Route::post('/contato', 'ContatoController@contato')->name('site.contato');
Route::get('/login/{erro?}', 'LoginController@index')->name('site.login');
Route::post('/login', 'LoginController@autenticar')->name('site.login');

Route::middleware('autenticacao:padrao, visitante')->prefix('/app')->group(function() {
    Route::get('/home', 'HomeController@index')->name('app.home');

    Route::get('/sair', 'LoginController@sair')->name('app.sair');

    Route::get('/fornecedor', 'FornecedorController@index')->name('app.fornecedor');

    Route::post('/fornecedor/listar', 'FornecedorController@listar')->name('app.fornecedor.listar'); // essa rota é via post pois é uma requisição de um formulário. Se fosse via get, seria uma requisição de um link. para saber se é get ou post, olhar no formulário do arquivo listar.blade.php

    Route::get('/fornecedor/listar', 'FornecedorController@listar')->name('app.fornecedor.listar');

    Route::get('/fornecedor/adicionar', 'FornecedorController@adicionar')->name('app.fornecedor.adicionar'); // essa rota é via get pois é uma requisição de um link. Se fosse via post, seria uma requisição de um formulário. para saber se é get ou post, olhar no formulário do arquivo adicionar.blade.php

    Route::post('/fornecedor/adicionar', 'FornecedorController@adicionar')->name('app.fornecedor.adicionar');

    Route::get('/fornecedor/editar/{id}/{msg?}', 'FornecedorController@editar')->name('app.fornecedor.editar');

    Route::get('/fornecedor/excluir/{id}', 'FornecedorController@excluir')->name('app.fornecedor.excluir');

    //produto
    Route::resource('produto', 'ProdutoController');

    //produto detalhes
    Route::resource('produto-detalhe', 'ProdutoDetalheController');

    //cliente
    Route::resource('cliente', 'ClienteController');

    //pedido
    Route::resource('pedido', 'PedidoController');

    //pedido-produto
    //Route::resource('pedido-produto', 'PedidoProdutoController');

    Route::get('pedido-produto/create/{pedido}', 'PedidoProdutoController@create')->name('pedido-produto.create');
    Route::post('pedido-produto/store/{pedido}', 'PedidoProdutoController@store')->name('pedido-produto.store');
    //Route::delete('pedido-produto/destroy/{pedido}/{produto}', 'PedidoProdutoController@destroy')->name('pedido-produto.destroy');
    Route::delete('pedido-produto.destroy/{pedidoProduto}/{pedido_id}', 'PedidoProdutoController@destroy')->name('pedido-produto.destroy');
});

Route::get('/teste/{p1}/{p2}', 'TesteController@teste')->name('site.teste');

Route::fallback(function() {
    echo 'A rota acessada não existe. <a href="'.route('site.index').'">clique aqui</a> para ir para página inicial';
});
