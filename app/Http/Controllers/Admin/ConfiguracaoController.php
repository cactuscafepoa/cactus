<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configuracao;
use App\Models\Evento;
use App\Http\Requests\ConfiguracaoFormRequest;
use Illuminate\Support\Facades\DB;

class ConfiguracaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $dataset = Configuracao::query()->get();
      $mensagem = $request->session()->get('mensagem');
      $mensagemValidaRelacao = $request->session()->get('mensagemValidaRelacao');
      return view('admin.configuracao.index', compact('dataset', 'mensagem', 'mensagemValidaRelacao'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.configuracao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$input = $request->all();

		/*if ($request->prato_dia == 'on')
			$input['prato_dia'] = 1;
		else
			$input['prato_dia'] = 0;

        if ($request->novidades == 'on')
			$input['novidades'] = 1;
		else
			$input['novidades'] = 0;

        if ($request->encomendas == 'on')
			$input['encomendas'] = 1;
		else
			$input['encomendas'] = 0;

        if ($request->horario == 'on')
			$input['horario'] = 1;
		else
			$input['horario'] = 0;*/

		$dataset = Configuracao::create($input);

		$request->session()->flash('mensagem',"Configuração realizada com sucesso.");
		return redirect()->route('listar_configuracaos');    }

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

      $eventos = Evento::query()->orderBy('id')->get(); //dd($eventos);
      $dataset = Configuracao::where('id',$request->id)->get();    // dd($dataset);
      return view('admin.configuracao.edit', [
            'configuracao' => $dataset,
            'eventos' => $eventos,
          ]);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConfiguracaoFormRequest $request, Configuracao $configuracao)
    {

      $input = $request->all();

      if ($request->pagina_inicial == 'on')
        $input['pagina_inicial'] = 1;
      else
        $input['pagina_inicial'] = 0;

      if ($request->cardapio == 'on')
        $input['cardapio'] = 1;
      else
        $input['cardapio'] = 0;

      if ($request->prato_dia == 'on')
        $input['prato_dia'] = 1;
      else
        $input['prato_dia'] = 0;

      if ($request->encomendas == 'on')
        $input['encomendas'] = 1;
      else
        $input['encomendas'] = 0;

      if ($request->novidades == 'on')
        $input['novidades'] = 1;
      else
        $input['novidades'] = 0;

      if ($request->horario == 'on')
        $input['horario'] = 1;
      else
        $input['horario'] = 0;


        if ($request->file('imagem')) {
          $path = public_path().'/images/'; //dd($path);
          $file = $request->file('imagem'); //dd($path);
          $filename = "banner_capa";    //dd($filename);
          $file->move($path, $filename);
        }

      $dataset = DB::table('configuracaos')
      ->where('id', $request->id)
      ->update([
        'pagina_inicial' 		       => $input['pagina_inicial'],
        'pagina_inicial_titulo' 	 => $input['pagina_inicial_titulo'],
        'pagina_inicial_texto'     => $input['pagina_inicial_texto'],
        'botao_inicial'            => $input['botao_inicial'],

        'cardapio'       		       => $input['cardapio'],

        'prato_dia' 		         => $input['prato_dia'],
        'prato_dia_botao'        => $input['prato_dia_botao'],
        'prato_dia_botao_texto'  => $input['prato_dia_botao_texto'],
        'prato_dia_cabecalho'	   => $input['prato_dia_cabecalho'],
        'prato_dia_texto_titulo' => $input['prato_dia_texto_titulo'],
        'prato_dia_texto'     	 => $input['prato_dia_texto'],

        'encomendas'		          => $input['encomendas'],
        'encomendas_titulo'       => $input['encomendas_titulo'],
        'encomendas_texto'        => $input['encomendas_texto'],

        'novidades'		            => $input['novidades'],
        'horario'		              => $input['horario'],
        'evento_id'		            => $input['evento_id'],
        'cardapio_fisico_qtd'     => $input['cardapio_fisico_qtd'],
      ]);
      $request->session()->flash("mensagem","Configuração atualizada com sucesso.");
      return redirect()->route('listar_configuracaos');
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
