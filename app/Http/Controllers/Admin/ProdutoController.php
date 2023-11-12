<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Fornecedor;
use App\Models\Configuracao;
use App\Http\Requests\ProdutoFormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;
Use Redirect;

use Dompdf\Dompdf;
use Dompdf\Options;

class ProdutoController extends Controller {

	public function index(Request $request) {
		//dd($request);
		if (!is_null($request->categoria_id_pesq) && !is_null($request->nome_pesq)) {
			$dataset = DB::table('categorias')
			->join('produtos', 'categorias.id', '=', 'produtos.categoria_id')
			->select(  'categorias.nome AS CatNome',
					'produtos.id AS ProdId',
					'produtos.nome AS ProdNome',
					'produtos.preco_venda AS ProdPrecoVenda',
					'produtos.visivel AS ProdVisivel',
					'produtos.destaque AS ProdDestaque',
					'produtos.prato_dia AS ProdPratoDia',
					'produtos.encomenda AS ProdEncomenda',
					'produtos.visivel_cardapio_fisico AS ProdVisivelCardapioFisico',)
			->where('produtos.categoria_id',$request->categoria_id_pesq)
			->where('produtos.nome','like',$request->nome_pesq."%")
			->orderBy('categorias.nome', 'asc')
			->orderBy('produtos.nome', 'asc')
			->get();  //dd($dataset);
		}
		elseif (!is_null($request->categoria_id_pesq)) {
			$dataset = DB::table('categorias')
			->join('produtos', 'categorias.id', '=', 'produtos.categoria_id')
			->select(  'categorias.nome AS CatNome',
					'produtos.id AS ProdId',
					'produtos.nome AS ProdNome',
					'produtos.preco_venda AS ProdPrecoVenda',
					'produtos.visivel AS ProdVisivel',
					'produtos.destaque AS ProdDestaque',
					'produtos.prato_dia AS ProdPratoDia',
					'produtos.encomenda AS ProdEncomenda',
					'produtos.visivel_cardapio_fisico AS ProdVisivelCardapioFisico',)
			->where('produtos.categoria_id',$request->categoria_id_pesq)
			->orderBy('categorias.nome', 'asc')
			->orderBy('produtos.nome', 'asc')
			->get();  //dd($dataset);
		}
		elseif (!is_null($request->nome_pesq)) {
			$dataset = DB::table('categorias')
			->join('produtos', 'categorias.id', '=', 'produtos.categoria_id')
			->select(  'categorias.nome AS CatNome',
					'produtos.id AS ProdId',
					'produtos.nome AS ProdNome',
					'produtos.preco_venda AS ProdPrecoVenda',
					'produtos.visivel AS ProdVisivel',
					'produtos.destaque AS ProdDestaque',
					'produtos.prato_dia AS ProdPratoDia',
					'produtos.encomenda AS ProdEncomenda',
					'produtos.visivel_cardapio_fisico AS ProdVisivelCardapioFisico',)
			->where('produtos.nome','like',$request->nome_pesq."%")
			->orderBy('categorias.nome', 'asc')
			->orderBy('produtos.nome', 'asc')
			->get();  //dd($dataset);
		}
		else {
			$dataset = DB::table('categorias')
			->join('produtos', 'categorias.id', '=', 'produtos.categoria_id')
			->select(  'categorias.nome AS CatNome',
					'produtos.id AS ProdId',
					'produtos.nome AS ProdNome',
					'produtos.preco_venda AS ProdPrecoVenda',
					'produtos.visivel AS ProdVisivel',
					'produtos.destaque AS ProdDestaque',
					'produtos.prato_dia AS ProdPratoDia',
					'produtos.encomenda AS ProdEncomenda',
					'produtos.visivel_cardapio_fisico AS ProdVisivelCardapioFisico',)
			->orderBy('categorias.nome', 'asc')
			->orderBy('produtos.nome', 'asc')
			->get(); //dd($dataset);
		}

		$mensagem = $request->session()->get('mensagem');
		//return view('admin.produto.index', compact('dataset', 'mensagem'));
		return view('admin.produto.index', [
			'categoria_id_pesq' => $request->categoria_id_pesq,
			'nome_pesq' => $request->nome_pesq,
        	'dataset'    => $dataset,
			'mensagem'   => $mensagem,
			'categorias' => Categoria::all('id','nome')->sortBy('nome'),
			/*'fornecedores' => Fornecedor::all('id','nome')->sortBy('nome'),*/
        ]);
	}

	public function create(Request $request)
	{
		return view('admin.produto.create', [
            'categorias' => Categoria::all('id','nome')->sortBy('nome'),
			'fornecedores' => Fornecedor::all('id','nome')->sortBy('nome'),
        ]);
	}

	public function store(ProdutoFormRequest $request)
	{

		////////////////////////////////////////////////////////////////////////
		$request->preco_venda = preg_replace('/[^0-9]/', '', $request->preco_venda);   //dd($request->preco_venda);

		if (strlen($request->preco_venda) == 0) {  // CAMPO OBRIGATÓRIO OU NÚMERO INVÁLIDO
			return Redirect::back()->withErrors(['mensagem' => "Preço de venda do produto é obrigatório ou possui valor inválido."]);
		}
		elseif (strlen($request->preco_venda) >= 3) {
			if ((int)$request->preco_venda > 0)
				$request->preco_venda = substr_replace($request->preco_venda, '.', -2, 0);
			else
				return Redirect::back()->withErrors(['mensagem' => "Preço de venda do produto é obrigatório ou possui valor inválido."]);
		}
		elseif (strlen($request->preco_venda) == 1) {
			$request->preco_venda = "0.0" . $request->preco_venda;
		}
		elseif (strlen($request->preco_venda) == 2) {
			$request->preco_venda = "0." . $request->preco_venda;
		}  //dd($request->preco_venda);
		////////////////////////////////////////////////////////////////////////

		$input = $request->all();

		$input['preco_venda'] = $request->preco_venda;

		if ($request->visivel == 'on') $input['visivel'] = 1; else $input['visivel'] = 0;
		if ($request->encomenda == 'on') $input['encomenda'] = 1; else $input['encomenda'] = 0;
		if ($request->destaque == 'on') $input['destaque'] = 1; else $input['destaque'] = 0;
		if ($request->prato_dia == 'on') $input['prato_dia'] = 1; else $input['prato_dia'] = 0;
		if ($request->visivel_cardapio_fisico == 'on') $input['visivel_cardapio_fisico'] = 1; else $input['visivel_cardapio_fisico'] = 0;

		if (!empty($request->preco)) {
			$input['preco'] = str_replace(".","",$input['preco']);
			$input['preco'] = str_replace(",",".",$input['preco']);
		}
		else {
			$input['preco'] = '0.00';
		}

		/*if (!empty($request->preco_venda)) {
			//dd($request->preco_venda);
			$input['preco_venda'] = str_replace(".","",$input['preco_venda']);
			$input['preco_venda'] = str_replace(",",".",$input['preco_venda']);
		}
		else {
			$input['preco_venda'] = '0.00';
		}*/

		if (!empty($request->encomenda_preco_venda)) {
			$input['encomenda_preco_venda'] = str_replace(".","",$input['encomenda_preco_venda']);
			$input['encomenda_preco_venda'] = str_replace(",",".",$input['encomenda_preco_venda']);
		}
		else {
			$input['encomenda_preco_venda'] = '0.00';
		}

		if ($request->file('imagem')) {
			$path = $request->file('imagem')->store('public/images');
			$input['imagem'] = Str::of($path)->after('public/images/');
		}

		//var_dump($input); exit;
		$dataset = Produto::create($input);

		$request->session()->flash('mensagem',"Produto cadastrado com sucesso: {$dataset->nome}.");
		return redirect()->route('listar_produtos');
	}

   /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
		$dataset = Produto::where('id',$request->id)->get();      //dd($dataset);
		$imagemOriginal = $dataset[0]->getRawOriginal('imagem');  // dd($imagemOriginal); /* retira os mutators - pega só o nome do arquivo taletal.jpg */
		$dataset[0]->imagem = 'images/'.$imagemOriginal;          // dd($dataset); exit;
		return view('admin.produto.edit', [
        	'produto' => $dataset,
			'categorias' => Categoria::all('id','nome')->sortBy('nome'),
			'fornecedores' => Fornecedor::all('id','nome')->sortBy('nome'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdutoFormRequest $request, Produto $produto)
	{   //dd($request->preco_venda);

			// PREÇO VENDA - FORMATAÇÃO
			$request->preco_venda = preg_replace('/[^0-9]/', '', $request->preco_venda);   //dd($request->preco_venda);

			if (strlen($request->preco_venda) == 0) {  // CAMPO OBRIGATÓRIO OU NÚMERO INVÁLIDO
				return Redirect::back()->withErrors(['mensagem' => "Preço de venda do produto é obrigatório ou possui valor inválido."]);
			}
			elseif (strlen($request->preco_venda) >= 3) {
				if ((int)$request->preco_venda > 0)
					$request->preco_venda = substr_replace($request->preco_venda, '.', -2, 0);
				else
					return Redirect::back()->withErrors(['mensagem' => "Preço de venda do produto é obrigatório ou possui valor inválido."]);
			}
			elseif (strlen($request->preco_venda) == 1) {
				$request->preco_venda = "0.0" . $request->preco_venda;
			}
			elseif (strlen($request->preco_venda) == 2) {
				$request->preco_venda = "0." . $request->preco_venda;
			}  //dd($request->preco_venda);

			$slug = Str::of($request->nome)->slug('-'); //dd($slug);

			if ($request->visivel == 'on') $request->visivel = 1; else $request->visivel = 0;
			if ($request->encomenda == 'on') $request->encomenda = 1; else $request->encomenda = 0;
			if ($request->destaque == 'on') $request->destaque = 1; else $request->destaque = 0;
			if ($request->prato_dia == 'on') $request->prato_dia = 1; else $request->prato_dia = 0;
			if ($request->visivel_cardapio_fisico == 'on') $request->visivel_cardapio_fisico = 1; else $request->visivel_cardapio_fisico = 0;

			if (!empty($request->preco)) {
				$request->preco = str_replace(".","",$request->preco);
				$request->preco = str_replace(",",".",$request->preco);
			}
			else {
				$request->preco = '0.00';
			}

			if (!empty($request->encomenda_preco_venda)) {
				$request->encomenda_preco_venda = str_replace(".","",$request->encomenda_preco_venda);
				$request->encomenda_preco_venda = str_replace(",",".",$request->encomenda_preco_venda);
			}
			else {
				$request->encomenda_preco_venda = '0.00';
			}

			if ($request->file('imagem')) {
				$path = $request->file('imagem')->store('public/images');
				$imagem = Str::of($path)->after('public/images/');   //dd($imagem);

				$dataset = DB::table('produtos')
				->where('id', $request->id)
				->update([
					'categoria_id'	=> $request->categoria_id,
					'nome' 			=> $request->nome,
					'slug'          => $slug,
					'descricao'		=> $request->descricao,
					'marca'			=> $request->marca,
					'volume'		=> $request->volume,
					'tipo_volume'	=> $request->tipo_volume,
					'ncm'			=> $request->ncm,
					'preco'			=> $request->preco,
					'preco_venda'	=> $request->preco_venda,
					'quantidade'	=> $request->quantidade,
					'fornecedor_id'	=> $request->fornecedor_id,
					'imagem'		=> $imagem,
					'link' 		    => $request->link,
					'destaque'		=> $request->destaque,
					'destaque_texto'=> $request->destaque_texto,
					'encomenda'		=> $request->encomenda,
					'encomenda_preco_venda'	=> $request->encomenda_preco_venda,
					'encomenda_quantidade_minima'	=> $request->encomenda_quantidade_minima,
					'encomenda_prazo_minimo'		=> $request->encomenda_prazo_minimo,
					'prato_dia'						=> $request->prato_dia,
					'visivel'						=> $request->visivel,
					'visivel_cardapio_fisico'		=> $request->visivel_cardapio_fisico,

				]);
			}
			elseif ($request->remove_imagem) {

				$imagem = Produto::select('imagem')->where('id',$request->id)->get(); //dd($imagem);
				$imagemOriginal = $imagem[0]->getRawOriginal('imagem');
				$dataset = DB::table('produtos')
				->where('id', $request->id)
				->update([
					'categoria_id'	=> $request->categoria_id,
					'nome' 			=> $request->nome,
					'slug'          => $slug,
					'descricao'		=> $request->descricao,
					'marca'			=> $request->marca,
					'volume'		=> $request->volume,
					'tipo_volume'	=> $request->tipo_volume,
					'ncm'			=> $request->ncm,
					'preco'			=> $request->preco,
					'preco_venda'	=> $request->preco_venda,
					'quantidade'	=> $request->quantidade,
					'fornecedor_id'	=> $request->fornecedor_id,
					'imagem'		=> env('IMAGEM_DEFAULT'),
					'link' 		    => $request->link,
					'destaque'		=> $request->destaque,
					'destaque_texto'=> $request->destaque_texto,
					'encomenda'		=> $request->encomenda,
					'encomenda_preco_venda'	=> $request->encomenda_preco_venda,
					'encomenda_quantidade_minima'	=> $request->encomenda_quantidade_minima,
					'encomenda_prazo_minimo'		=> $request->encomenda_prazo_minimo,
					'prato_dia'						=> $request->prato_dia,
					'visivel'		=> $request->visivel,
					'visivel_cardapio_fisico'		=> $request->visivel_cardapio_fisico,
				]);

				if ($imagemOriginal <> env('IMAGEM_DEFAULT')) {
					$delete = 'public/images/'.$imagemOriginal;
					Storage::delete($delete);
				}
			}
			else { // NÃO TEM IMAGEM - NÃO ATUALIZA A IMAGEM
				$dataset = DB::table('produtos')
				->where('id', $request->id)
				->update([
					'categoria_id'	=> $request->categoria_id,
					'nome' 			=> $request->nome,
					'slug'          => $slug,
					'descricao'		=> $request->descricao,
					'marca'			=> $request->marca,
					'volume'		=> $request->volume,
					'tipo_volume'	=> $request->tipo_volume,
					'ncm'			=> $request->ncm,
					'preco'			=> $request->preco,
					'preco_venda'	=> $request->preco_venda,
					'quantidade'	=> $request->quantidade,
					'fornecedor_id'	=> $request->fornecedor_id,
					'link' 		    => $request->link,
					'destaque'		=> $request->destaque,
					'destaque_texto'=> $request->destaque_texto,
					'encomenda'		=> $request->encomenda,
					'encomenda_preco_venda'	=> $request->encomenda_preco_venda,
					'encomenda_quantidade_minima'	=> $request->encomenda_quantidade_minima,
					'encomenda_prazo_minimo'		=> $request->encomenda_prazo_minimo,
					'prato_dia'						=> $request->prato_dia,
					'visivel'		=> $request->visivel,
					'visivel_cardapio_fisico'		=> $request->visivel_cardapio_fisico,
				]);
			}
			$request->session()->flash("mensagem","Produto atualizado com sucesso: {$request->nome}.");
			return redirect()->route('listar_produtos');

    }

    public function updatePreco(Request $request)
	{  //dd($request);

        $request->preco_venda = preg_replace('/[^0-9]/', '', $request->preco_venda);   //dd($request->preco_venda);

        if (strlen($request->preco_venda) == 0) {
            // CAMPO OBRIGATÓRIO OU NÚMERO INVÁLIDO
            $request->preco_venda = 0;  //dd($request->preco_venda);
        }
        elseif (strlen($request->preco_venda) >= 3) {
            $request->preco_venda = substr_replace($request->preco_venda, '.', -2, 0);
        }
        elseif (strlen($request->preco_venda) == 1) {
            $request->preco_venda = "0.0" . $request->preco_venda;
        }
        elseif (strlen($request->preco_venda) == 2) {
            $request->preco_venda = "0." . $request->preco_venda;
        }  //dd($request->preco_venda);

		if ($request->preco_venda == 0) {
			$request->session()->flash("mensagem","Preço de venda do produto {$request->nome} é obrigatório ou possui valor inválido.");
			return redirect()->route('listar_produtos');
		}
		else {
			$dataset = DB::table('produtos')
			->where('id', $request->id)
			->update([
				'preco_venda' => $request->preco_venda,
			]);
			$request->preco_venda = number_format($request->preco_venda,2,",",".");
			$request->session()->flash("mensagem","Preço de venda do produto <strong>{$request->nome}</strong> atualizado com sucesso. Novo preço: <strong>R$ " . $request->preco_venda . "</strong>.");
			return redirect()->route('listar_produtos');
		}
	}

	public function destroy(Request $request) {

		//dd($request);
		// IMPLEMENTAR DEPOIS - VERIFICAR SE O PRODUTO ESTÁ VINCULADO EM ALGUMA COISA
		//$count = Produto::where('categoria_id', $request->id)->count(); //ddd($count);

		//if ($count > 0) {
			//$request->session()->flash('mensagem',"Categoria não pode ser excluída. Ela possui produtos vinculados.");
		//}
		//else {
			$imagem = Produto::select('imagem')->where('id',$request->id)->get(); //dd($imagem);
			$imagemOriginal = $imagem[0]->getRawOriginal('imagem');
			if ($imagemOriginal <> env('IMAGEM_DEFAULT')) {
				$delete = 'public/images/'.$imagemOriginal;
				Storage::delete($delete);
			}
			Produto::destroy($request->id);
			$request->session()->flash('mensagem',"Produto removido com sucesso:  {$request->ProdNome}.");
		//}
		return redirect()->route('listar_produtos');
	}


/* GERA ARQUIVO PDF DE HTML */
	public function createPDF(Request $request) {

		//dd($request); 		dd($request->produtos);

		$configuracao = Configuracao::query()->get(); //dd($configuracao[0]->cardapio_fisico_qtd);


		if (is_null($request->produtos)) { // usuário não escolheu nenhum produto
			if ($request->tipo_pdf == "gerar_cardapio") {
				$request->session()->flash('mensagem',"Ao menos um produto deve estar assinalado para gerar-se cardápio físico.");
				return redirect()->route('listar_produtos');
			}
		}

		if ($request->tipo_pdf == "gerar_cardapio") {

			$dataset = DB::table('categorias')
			->join('produtos', 'categorias.id', '=', 'produtos.categoria_id')
			->select(  'categorias.nome AS CatNome',
					   'produtos.nome AS ProdNome',
					   'produtos.preco_venda AS ProdPrecoVenda')
			->whereIn('produtos.id', $request->produtos)
			->orderBy('categorias.nome', 'asc')
			->orderBy('produtos.nome', 'asc')
			->get();  //ddd($dataset);

			$dataset = $dataset->chunk($configuracao[0]->cardapio_fisico_qtd);  //dd($dataset);  dd(count($dataset));
			$pdf = PDF::loadView('admin.produto.pdf_view',
				['dataset' => $dataset,
				'qtdArrays' => count($dataset),
				'chunk' => 40,
				]
			);
		}
		else {
			// LISTAGEM DE PRODUTOS
			$dataset = DB::table('categorias')
			->join('produtos', 'categorias.id', '=', 'produtos.categoria_id')
			->select(  'categorias.nome AS CatNome',
					   'produtos.nome AS ProdNome',
					   'produtos.descricao AS ProdDesc',
					   'produtos.preco_venda AS ProdPrecoVenda',
					   'produtos.preco AS ProdPrecoCompra',
					   'produtos.imagem AS ProdImagem',
					   'produtos.visivel AS ProdVisivel',
					   'produtos.visivel_cardapio_fisico AS ProdVisivelCardFisico',
					   'produtos.encomenda AS ProdEncomenda',
					   'produtos.encomenda_preco_venda AS ProdEncomendaPrecVenda',
					   'produtos.prato_dia AS ProdPratoDia')
			->orderBy('categorias.nome', 'asc')
			->orderBy('produtos.nome', 'asc')
			->get();  //ddd($dataset);

			$pdf = PDF::loadView('admin.produto.pdf_produtos',
				['dataset' => $dataset,
				 'qtdArrays' => count($dataset),
				]
			);
		}

		//$pdf->set_paper('a4', 'portrait');

		$pdf->render();
		return $pdf->stream('listagem.pdf');
		/*return view('admin.produto.pdf_produtos',
			[	'dataset' => $dataset,
				'qtdArrays' => count($dataset),
			]
		);*/
	}

	protected static function booted()
    {
        $produto->slug = Str::slug($produto->nome);
    }
}