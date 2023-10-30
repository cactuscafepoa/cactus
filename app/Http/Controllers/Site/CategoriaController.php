<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Configuracao;

use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataset = DB::table('categorias')
        ->distinct()
        ->join('produtos', 'categorias.id', '=', 'produtos.categoria_id')
        ->select('categorias.id', 'categorias.nome', 'categorias.slug', 'categorias.descricao', DB::raw('CONCAT("storage/images/", categorias.imagem) AS imagem'))
        ->where('categorias.visivel', '=',  '1')
        ->where('produtos.visivel', '=',  '1')
        ->orderBy('categorias.nome', 'asc')
        ->get();   // echo $dataset; exit;  //dd($categorias);
        return view('site.categoria.index', [
            'categorias' => $dataset,
            'configuracao' => Configuracao::all('cardapio'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {        //dd($categoria->id); exit;
        //$imagemOriginal = $categoria->getRawOriginal('imagem');
        //$categoria->imagem = 'images/'.$imagemOriginal;

        //return view('site.categoria.show', ['categoria' => $categoria->load('produtos')]);
        // até está certo.

        $dataset = DB::table('categorias')
        ->join('produtos', 'categorias.id', '=', 'produtos.categoria_id')
        ->select('categorias.nome AS CatNome', 'categorias.descricao AS CatDescricao', DB::raw('CONCAT("storage/images/", categorias.imagem) AS CatImagem'),
                   'produtos.nome AS ProdNome',
                   'produtos.descricao AS ProdDescricao',
                   'produtos.preco_venda AS ProdPrecoVenda',
                   'produtos.encomenda AS ProdEncomenda',
                   DB::raw('CONCAT("storage/images/", produtos.imagem) AS ProdImagem'),
                   'produtos.link AS ProdLink',
                   'produtos.destaque AS ProdDestaque', )
        ->where('categorias.id', '=', $categoria->id)
        ->where('categorias.visivel', '=', '1')
        ->where('produtos.visivel', '=',  '1')
        ->orderBy('produtos.nome', 'asc')
        ->get();  //dd($dataset);  exit;
        //var_dump($dataset); exit;

        return view('site.categoria.show', [
            'categoria' => $dataset,
            'configuracao' => Configuracao::all('cardapio'),
        ]);
    }

    public function encomendas(Categoria $categoria)
    {        //dd($categoria->id); exit;

        $dataset = DB::table('categorias')
        ->join('produtos', 'categorias.id', '=', 'produtos.categoria_id')
        ->select('categorias.id AS CatId', 'categorias.nome AS CatNome', 'categorias.descricao AS CatDescricao', DB::raw('CONCAT("storage/images/", categorias.imagem) AS CatImagem'),
                   'produtos.categoria_id AS ProdCatId',
                   'produtos.nome AS ProdNome',
                   'produtos.descricao AS ProdDescricao',
                   'produtos.preco_venda AS ProdPrecoVenda',
                   'produtos.encomenda_preco_venda AS ProdEncomendaPrecoVenda',
                   'produtos.encomenda_quantidade_minima AS ProdEncQtdMin',
                   'produtos.encomenda_prazo_minimo AS ProdEncPrazoMin',
                   'produtos.encomenda AS ProdEncomenda', DB::raw('CONCAT("storage/images/", produtos.imagem) AS ProdImagem'),
                   'produtos.link AS ProdLink',
                   'produtos.destaque AS ProdDestaque',)
        /*->where('categorias.visivel', '=', '1')*/
        /*->where('produtos.visivel', '=',  '1')*/
        ->where('produtos.encomenda', '=',  '1')
        ->orderBy('produtos.nome', 'asc')
        ->get();  //dd($dataset);  exit;   //var_dump($dataset); exit;

        return view('site.categoria.encomenda', [
            'categoria' => $dataset,
            'configuracao' => Configuracao::all('encomendas','encomendas_titulo','encomendas_texto'),
        ]);
    }

    public function refeicoes(Categoria $categoria)
    {        //dd($categoria->id); exit;

        $dataset = DB::table('produtos')
        ->select(  'produtos.nome AS ProdNome',
                   'produtos.descricao AS ProdDescricao',
                   'produtos.preco_venda AS ProdPrecoVenda',
                   /*'produtos.encomenda_preco_venda AS ProdEncomendaPrecoVenda',*/
                   'produtos.encomenda_quantidade_minima AS ProdEncQtdMin',
                   'produtos.encomenda_prazo_minimo AS ProdEncPrazoMin',
                   'produtos.encomenda AS ProdEncomenda',
                   'produtos.link AS ProdLink',
                   DB::raw('CONCAT("storage/images/", produtos.imagem) AS ProdImagem'),
                   'produtos.destaque AS ProdDestaque', )
        ->where('produtos.visivel', '=',  '1')
        ->where('produtos.prato_dia', '=',  '1')
        ->orderBy('produtos.nome', 'asc')
        ->get();  //dd($dataset);  exit;
        //var_dump($dataset); exit;

        return view('site.categoria.refeicoes', [
            'produto' => $dataset,
            'configuracao' => Configuracao::all('prato_dia','prato_dia_cabecalho', 'prato_dia_texto_titulo', 'prato_dia_texto'),
        ]);
    }

    public function destaques(Categoria $categoria)
    {        //dd($categoria->id); exit;

        $dataset = DB::table('produtos')
        ->select(  'produtos.nome AS ProdNome',
                   'produtos.descricao AS ProdDescricao',
                   'produtos.preco_venda AS ProdPrecoVenda',
                   /*'produtos.encomenda_preco_venda AS ProdEncomendaPrecoVenda',*/
                   'produtos.destaque AS ProdDestaque',
                   'produtos.destaque_texto AS ProdDestTexto',
                   'produtos.encomenda AS ProdEncomenda',
                   'produtos.link AS ProdLink',
                   DB::raw('CONCAT("storage/images/", produtos.imagem) AS ProdImagem'))
        ->where('produtos.visivel', '=',  '1')
        ->where('produtos.destaque', '=',  '1')
        ->orderBy('produtos.nome', 'asc')
        ->get();  //dd($dataset);  exit;
        //var_dump($dataset); exit;

        return view('site.categoria.destaques', [
            'produto' => $dataset,
            'configuracao' => Configuracao::all('novidades'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
