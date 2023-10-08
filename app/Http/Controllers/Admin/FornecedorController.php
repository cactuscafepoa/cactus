<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fornecedor;
use App\Http\Requests\FornecedorFormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FornecedorController extends Controller {

	public function index(Request $request) {		
		$dataset = Fornecedor::query()->orderBy('nome')->get();		
		$mensagem = $request->session()->get('mensagem');
		return view('admin.fornecedor.index', compact('dataset', 'mensagem'));
	}

	public function create(Request $request)
	{
		return view('admin.fornecedor.create', [
            'fornecedores' => Fornecedor::all('id','nome')->sortBy('nome'),
	        ]);
	}

	public function store(FornecedorFormRequest $request)
	{

		$dataset = Fornecedor::create($request->all());
		$request->session()->flash('mensagem',"Fornecedor cadastrado com sucesso: {$dataset->nome}.");
		return redirect()->route('listar_fornecedores');
	}

   /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
		$dataset = Fornecedor::where('id',$request->id)->get();      // dd($dataset);
		return view('admin.fornecedor.edit', [
        	'fornecedor' => $dataset,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FornecedorFormRequest $request, Fornecedor $fornecedor)
	{
		$dataset = DB::table('fornecedores')
		->where('id', $request->id)
		->update([
			'nome' 			=> $request->nome,
			'endereco'		=> $request->endereco,	
			'fone1'		=> $request->fone1,	
			'fone2'		=> $request->fone2,	
			'fone3'		=> $request->fone3,				
		]);
		$request->session()->flash("mensagem","Fornecedor atualizado com sucesso: {$request->nome}.");
		return redirect()->route('listar_fornecedores');
    }

	public function destroy(Request $request) {

		// IMPLEMENTAR DEPOIS - VERIFICAR SE O PRODUTO ESTÁ VINCULADO EM ALGUMA COISA
		//$count = Produto::where('categoria_id', $request->id)->count(); //ddd($count);

		//if ($count > 0) {
			//$request->session()->flash('mensagem',"Categoria não pode ser excluída. Ela possui produtos vinculados.");
		//}
		//else {

			Fornecedor::destroy($request->id);
			$request->session()->flash('mensagem',"Fornecedor removido com sucesso.");
		//}
		return redirect()->route('listar_fornecedores');
	}

}