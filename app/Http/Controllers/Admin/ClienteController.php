<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Http\Requests\ClienteFormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller {

	public function index(Request $request) {		
		$dataset = Cliente::query()->orderBy('nome')->get();
		$mensagem = $request->session()->get('mensagem');
		return view('admin.cliente.index', compact('dataset', 'mensagem'));
	}

	public function create(Request $request)
	{
		return view('admin.cliente.create', [
            'clientes' => Cliente::all('id','nome')->sortBy('nome'),
	        ]);
	}

	public function store(ClienteFormRequest $request)
	{

		$dataset = Cliente::create($request->all());
		$request->session()->flash('mensagem',"Cliente cadastrado com sucesso: {$dataset->nome}.");
		return redirect()->route('listar_clientes');
	}

   /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
		$dataset = Cliente::where('id',$request->id)->get();      // dd($dataset);
		return view('admin.cliente.edit', [
        	'cliente' => $dataset,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClienteFormRequest $request, Cliente $cliente)
	{
		$dataset = DB::table('clientes')
		->where('id', $request->id)
		->update([
			'nome' 		=> $request->nome,
			'endereco'	=> $request->endereco,	
			'fone1'		=> $request->fone1,	
			'fone2'		=> $request->fone2,	
			'fone3'		=> $request->fone3,	
		]);
		$request->session()->flash("mensagem","Cliente atualizado com sucesso: {$request->nome}.");
		return redirect()->route('listar_clientes');
    }

	public function destroy(Request $request) {

		// IMPLEMENTAR DEPOIS - VERIFICAR SE O PRODUTO ESTÁ VINCULADO EM ALGUMA COISA
		//$count = Produto::where('categoria_id', $request->id)->count(); //ddd($count);

		//if ($count > 0) {
			//$request->session()->flash('mensagem',"Categoria não pode ser excluída. Ela possui produtos vinculados.");
		//}
		//else {

			Cliente::destroy($request->id);
			$request->session()->flash('mensagem',"Cliente removido com sucesso.");
		//}
		return redirect()->route('listar_clientes');
	}

}