<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Produto;
use App\Http\Requests\CategoriaFormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoriaAdmController extends Controller {

	public function index(Request $request) {

		$dataset = Categoria::query()->orderBy('nome')->get();
		$mensagem = $request->session()->get('mensagem');
		$mensagemValidaRelacao = $request->session()->get('mensagemValidaRelacao');
		return view('admin.categoria.index', compact('dataset', 'mensagem', 'mensagemValidaRelacao'));
	}

	public function create(Request $request)
	{
		return view('admin.categoria.create');
	}

	public function store(CategoriaFormRequest $request)
	{
		$input = $request->all();

		if ($request->visivel== 'on')
			$input['visivel'] = 1;
		else
			$input['visivel'] = 0;

		if ($request->file('imagem')) {
			$path = $request->file('imagem')->store('public/images');
			$input['imagem'] = Str::of($path)->after('public/images/');
		}

		$dataset = Categoria::create($input);

		$request->session()->flash('mensagem',"Categoria cadastrada com sucesso: {$dataset->nome}.");
		return redirect()->route('listar_categorias');
	}

   /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
		$dataset = Categoria::where('id',$request->id)->get();    // dd($dataset);
		$imagemOriginal = $dataset[0]->getRawOriginal('imagem');  // dd($imagemOriginal); /* retira os mutators - pega só o nome do arquivo taletal.jpg */
		$dataset[0]->imagem = 'images/'.$imagemOriginal;  //        dd($dataset);
		return view('admin.categoria.edit', [
        	'categoria' => $dataset,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaFormRequest $request, Categoria $categoria)
    {

		if ($request->visivel == 'on') $request->visivel = 1; else $request->visivel = 0;

		$slug = Str::of($request->nome)->slug('-'); //dd($slug);

		if ($request->file('imagem')) {
			$path = $request->file('imagem')->store('public/images');
			$imagem = Str::of($path)->after('public/images/');

			$dataset = DB::table('categorias')
			->where('id', $request->id)
			->update([
				'nome' 			=> $request->nome,
				'slug'          => $slug,
				'descricao'		=> $request->descricao,
				'imagem'		=> $imagem,
				'visivel'		=> $request->visivel,
			]);
		}
		elseif ($request->remove_imagem) {

			$imagem = Categoria::select('imagem')->where('id',$request->id)->get(); //dd($imagem);
			$imagemOriginal = $imagem[0]->getRawOriginal('imagem');
			$dataset = DB::table('categorias')
			->where('id', $request->id)
			->update([
				'nome' 			=> $request->nome,
				'slug'          => $slug,
				'descricao'		=> $request->descricao,
				'imagem'		=> env('IMAGEM_DEFAULT'),
				'visivel'		=> $request->visivel,
			]);

			if ($imagemOriginal <> env('IMAGEM_DEFAULT')) {
				$delete = 'public/images/'.$imagemOriginal;
				Storage::delete($delete);
			}
		}
		else { // NÃO TEM IMAGEM - NÃO ATUALIZA A IMAGEM
			$dataset = DB::table('categorias')
			->where('id', $request->id)
			->update([
				'nome' 			=> $request->nome,
				'slug'          => $slug,
				'descricao'		=> $request->descricao,
				'visivel'		=> $request->visivel,
			]);
		}

		$request->session()->flash("mensagem","Categoria atualizada com sucesso: {$request->nome}.");
		return redirect()->route('listar_categorias');
    }

	public function destroy(Request $request) {

		$datasetProduto = Produto::where('categoria_id', $request->id)->count(); //ddd($datasetProduto);

		if ($datasetProduto > 0) {
			$request->session()->flash("mensagemValidaRelacao","Categoria não pode ser excluída. Ela possui produtos vinculados.");
		}
		else {
			$imagem = Categoria::select('imagem')->where('id',$request->id)->get(); //dd($imagem);
			$imagemOriginal = $imagem[0]->getRawOriginal('imagem');
			if ($imagemOriginal <> env('IMAGEM_DEFAULT')) {
				$delete = 'public/images/'.$imagemOriginal;
				Storage::delete($delete);
			}
			Categoria::destroy($request->id);
			$request->session()->flash("mensagem","Categoria removida com sucesso.");
		}
		return redirect()->route('listar_categorias');
	}

	protected static function booted()
    {
		dd("Contate o administrador do sistema. Categoria function.");
        $dataset->slug = Str::slug($dataset->nome);
    }
}