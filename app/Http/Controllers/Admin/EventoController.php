<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use App\Models\Configuracao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Str;

//use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataset = Evento::query()->orderBy('id')->get();
		return view('admin.evento.index', compact('dataset'));
    }

    public function mostrar(Request $request)
    {
        $config = Configuracao::all('evento_id');  //dd($config);

        $dataset = Evento::where('id', $config[0]->evento_id)->get();  //dd($dataset);

        return view('site.evento.index', [
            'dataset' => $dataset,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.evento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
		$dataset = Evento::create($request->all());
		$request->session()->flash('mensagem',"Evento criado com sucesso: ID {$request->id}.");
		return redirect()->route('listar_eventos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $dataset = Evento::where('id',$request->id)->get();      // dd($dataset);
		return view('admin.evento.edit', [
        	'dataset' => $dataset,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request);
        $dataset = DB::table('eventos')
		->where('id', $request->id)
		->update([
			'texto' 	=> $request->texto,
		]);
		$request->session()->flash("mensagem","Evento atualizado com sucesso: ID {$request->id}.");
		return redirect()->route('listar_eventos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //dd($request->id);
        Evento::destroy($request->id);
        $request->session()->flash('mensagem',"Evento removido com sucesso.");
        return redirect()->route('listar_eventos');
    }
}