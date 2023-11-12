<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\CategoriaController;
use App\Http\Controllers\Site\BlogController;
use App\Http\Controllers\Site\ContatoController;

use App\Http\Controllers\Admin\CategoriaAdmController;
use App\Http\Controllers\Admin\FornecedorController;
use App\Http\Controllers\Admin\ProdutoController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HorarioController;
use App\Http\Controllers\Admin\EventoController;
use App\Http\Controllers\Admin\ConfiguracaoController;

use App\Http\Controllers\Xml\ReadXmlController;

use App\Http\Controllers\Teste\TesteController;
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

/* PARA XML */
Route::get('xml' , [ReadXmlController::class, 'index' ])->middleware('auth')->name('form_xml_produto');
//Route::post('xml' , [ReadXmlController::class, 'index' ])->middleware('auth')->name('form_xml_produto');
/* PARA XML */

Route::namespace('Site')->group(function() {
    Route::get('/', [HomeController::class, '__invoke'])->name('site.home');

    Route::get('cardapio', [CategoriaController::class, 'index'])->name('site.cardapio');
    Route::get('cardapio/{categoria:slug}', [CategoriaController::class, 'show'])->name('site.produtos.categoria');
    Route::get('encomendas', [CategoriaController::class, 'encomendas'])->name('site.encomendas');

    Route::get('evento', [EventoController::class, 'mostrar'])->name('site.evento');

    Route::get('refeicoes', [CategoriaController::class, 'refeicoes'])->name('site.refeicoes');
    Route::get('destaques', [CategoriaController::class, 'destaques'])->name('site.destaques');

    Route::get('horario' , [HorarioController::class, 'mostrar'])->name('site.horario');

    Route::get('blog', [BlogController::class, '__invoke'])->name('site.blog');

    Route::view('sobre', 'site.sobre.index')->name('site.sobre');

    Route::get('contato' , [ContatoController::class, 'index'])->name('site.contato');
    Route::post('contato' , [ContatoController::class, 'formulario'])->name('site.contato.form');
});

//Route::get('/', 'HomeController');

/*Route::get('/', function () {
    return view('site.home.index');
});*/

/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');*/


Route::get('/dashboard', function () {
    return view('capa.capa');
})->middleware(['auth'])->name('dashboard');

Route::namespace('Admin')->group(function() {
// CATEGORIAS
Route::get('categorias'               , [CategoriaAdmController::class, 'index'  ])->middleware('auth')->name('listar_categorias');
Route::get('categorias/criar'         , [CategoriaAdmController::class, 'create' ])->middleware('auth')->name('form_edit_categoria_new');
Route::post('categorias/criar'        , [CategoriaAdmController::class, 'store'  ])->middleware('auth')->name('form_create_categoria');
Route::post('categorias/remover/{id}' , [CategoriaAdmController::class, 'destroy'])->middleware('auth');
Route::get('categorias/edit/{id}'     , [CategoriaAdmController::class, 'edit'   ])->middleware('auth')->name('form_edit_categoria_old');
Route::post('categorias/atualizar'    , [CategoriaAdmController::class, 'update' ])->middleware('auth')->name('form_update_categoria');

// FORNECEDORES
Route::get('fornecedores'               , [FornecedorController::class, 'index'  ])->middleware('auth')->name('listar_fornecedores');
Route::get('fornecedores/criar'         , [FornecedorController::class, 'create' ])->middleware('auth')->name('form_edit_fornecedor_new');
Route::post('fornecedores/criar'        , [FornecedorController::class, 'store'  ])->middleware('auth')->name('form_create_fornecedor');
Route::post('fornecedores/remover/{id}' , [FornecedorController::class, 'destroy'])->middleware('auth');
Route::get('fornecedores/edit/{id}'     , [FornecedorController::class, 'edit'   ])->middleware('auth')->name('form_edit_fornecedor_old');
Route::post('fornecedores/atualizar'    , [FornecedorController::class, 'update' ])->middleware('auth')->name('form_update_fornecedor');

// PRODUTOS
Route::get('produtos'               , [ProdutoController::class, 'index'  ])->middleware('auth')->name('listar_produtos');
Route::post('produtos'              , [ProdutoController::class, 'index'  ])->middleware('auth')->name('listar_produtos_pesquisa');
Route::get('produtos/criar'         , [ProdutoController::class, 'create' ])->middleware('auth')->name('form_edit_produto_new');
Route::post('produtos/criar'        , [ProdutoController::class, 'store'  ])->middleware('auth')->name('form_create_produto');
Route::get('produtos/remover'       , [ProdutoController::class, 'destroy'])->middleware('auth')->name('form_remover_produto');
Route::get('produtos/edit'          , [ProdutoController::class, 'edit'   ])->middleware('auth')->name('form_edit_produto_old');
Route::post('produtos/atualizar'    , [ProdutoController::class, 'update' ])->middleware('auth')->name('form_update_produto');
Route::post('produtos/preco'        , [ProdutoController::class, 'updatePreco' ])->middleware('auth')->name('form_update_preco_produto');
Route::get('produtos/pdf'           , [ProdutoController::class, 'createPDF'])->name('pdf_produto');
Route::post('produtos/pdf'          , [ProdutoController::class, 'createPDF'])->name('pdf_produto_envia');

// CLIENTES
Route::get('clientes'               , [ClienteController::class, 'index'  ])->middleware('auth')->name('listar_clientes');
Route::get('clientes/criar'         , [ClienteController::class, 'create' ])->middleware('auth')->name('form_edit_cliente_new');
Route::post('clientes/criar'        , [ClienteController::class, 'store'  ])->middleware('auth')->name('form_create_cliente');
Route::post('clientes/remover/{id}' , [ClienteController::class, 'destroy'])->middleware('auth');
Route::get('clientes/edit/{id}'     , [ClienteController::class, 'edit'   ])->middleware('auth')->name('form_edit_cliente_old');
Route::post('clientes/atualizar'    , [ClienteController::class, 'update' ])->middleware('auth')->name('form_update_cliente');

// USUÁRIOS
Route::get('usuarios'               , [UserController::class, 'index'  ])->middleware('auth')->name('listar_usuarios');
Route::get('usuarios/criar'         , [UserController::class, 'create' ])->middleware('auth')->name('form_edit_usuario_new');
Route::post('usuarios/criar'        , [UserController::class, 'store'  ])->middleware('auth')->name('form_create_usuario');
Route::post('usuarios/remover/{id}' , [UserController::class, 'destroy'])->middleware('auth');
Route::get('usuarios/edit/{id}'     , [UserController::class, 'edit'   ])->middleware('auth')->name('form_edit_usuario_old');
Route::post('usuarios/atualizar'    , [UserController::class, 'update' ])->middleware('auth')->name('form_update_usuario');

// HORÁRIOS
Route::get('horarios'                 , [HorarioController::class, 'index'  ])->middleware('auth')->name('listar_horarios');
Route::get('horarios/criar'           , [HorarioController::class, 'create' ])->middleware('auth')->name('form_edit_horario_new');
Route::post('horarios/criar'          , [HorarioController::class, 'store'  ])->middleware('auth')->name('form_create_horario');
Route::post('horarios/remover/{id}'   , [HorarioController::class, 'destroy'])->middleware('auth');
Route::get('horarios/edit/{id}'       , [HorarioController::class, 'edit'   ])->middleware('auth')->name('form_edit_horario_old');
Route::post('horarios/atualizar'      , [HorarioController::class, 'update' ])->middleware('auth')->name('form_update_horario');
Route::get('horarios/pdf'             , [HorarioController::class, 'createPDF'])->name('pdf_horario');
Route::post('horarios/pdf'            , [HorarioController::class, 'createPDF'])->name('pdf_horario_envia');

// EVENTOS
Route::get('eventos'                  , [EventoController::class, 'index'  ])->middleware('auth')->name('listar_eventos');
Route::get('eventos/criar'            , [EventoController::class, 'create' ])->middleware('auth')->name('form_edit_evento_new');
Route::post('eventos/criar'           , [EventoController::class, 'store'  ])->middleware('auth')->name('form_create_evento');
Route::post('evento/remover/{id}'    , [EventoController::class, 'destroy'])->middleware('auth');
Route::get('evento/edit/{id}'        , [EventoController::class, 'edit'   ])->middleware('auth')->name('form_edit_evento_old');
Route::post('eventos/atualizar'       , [EventoController::class, 'update' ])->middleware('auth')->name('form_update_evento');

// CONFIGURAÇÕES
Route::get('configuracaos'                 , [ConfiguracaoController::class, 'index'  ])->middleware('auth')->name('listar_configuracaos');
Route::get('configuracaos/criar'           , [ConfiguracaoController::class, 'create' ])->middleware('auth')->name('form_edit_configuracao_new');
Route::post('configuracaos/criar'          , [ConfiguracaoController::class, 'store'  ])->middleware('auth')->name('form_create_configuracao');
//Route::post('configuracaos/remover/{id}' , [ConfiguracaoController::class, 'destroy'])->middleware('auth');
Route::get('configuracaos/edit/{id}'       , [ConfiguracaoController::class, 'edit'   ])->middleware('auth')->name('form_edit_configuracao_old');
Route::post('configuracaos/atualizar'      , [ConfiguracaoController::class, 'update' ])->middleware('auth')->name('form_update_configuracao');

});

// PÁGINAS DE CONFIGURAÇÃO
Route::get('/phpinfo', function () {
    return view('admin.configuracao.phpinfo');
})->middleware(['auth'])->name('phpinfo');


/*
Route::delete('/series/{id}', 'SeriesController@destroy')
    ->middleware('autenticador');
Route::post('/series/{id}/editaNome', 'SeriesController@editaNome')
    ->middleware('autenticador');*/

/// Auth
require __DIR__.'/auth.php';
/// Auth

/* FIM DO ARQUIVO */