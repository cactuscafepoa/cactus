<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Horario;
use App\Models\Configuracao;
use Illuminate\Support\Facades\DB;
use PDF;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dataset = Horario::query()->orderBy('id')->get();
		$mensagem = $request->session()->get('mensagem');
		return view('admin.horario.index', compact('dataset', 'mensagem'));
    }

    public function mostrar(Request $request)
    {
        $dataset = Horario::query()->orderBy('id')->get();
        //dd($dataset); exit;
		//$mensagem = $request->session()->get('mensagem');
		//return view('site.horario.index', compact('dataset', 'mensagem'));

        return view('site.horario.index', [
            'dataset' => $dataset,
            'configuracao' => Configuracao::all('horario'),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.horario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$dataset = Horario::create($request->all());
		$request->session()->flash('mensagem',"Horário criado com sucesso: {$request->dia_semana}.");
		return redirect()->route('listar_horarios');
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
        $dataset = Horario::where('id',$request->id)->get();      // dd($dataset);
		return view('admin.horario.edit', [
        	'horario' => $dataset,
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

        if ($request->dia_mes_mostrar == 'on') $request->dia_mes_mostrar = 1; else $request->dia_mes_mostrar = 0;

		$dataset = DB::table('horarios')
		->where('id', $request->id)
		->update([
			'dia_mes' 		    => $request->dia_mes,
			'dia_mes_mostrar'	=> $request->dia_mes_mostrar,
			'dia_semana'		=> $request->dia_semana,
			'aberto'		    => $request->aberto,
			'hora_abre'		    => $request->hora_abre,
            'hora_fecha'		=> $request->hora_fecha,
            'aviso'		        => $request->aviso,
            'atendimento_fisico'        =>$request->atendimento_fisico,
            'atendimento_encomendas'    =>$request->atendimento_encomendas,

		]);
		$request->session()->flash("mensagem","Horário atualizado com sucesso: {$request->dia_semana}.");
		return redirect()->route('listar_horarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Horario::destroy($request->id);
        $request->session()->flash('mensagem',"Horário removido com sucesso.");
        return redirect()->route('listar_horarios');
    }

    /* GERA ARQUIVO PDF DE HTML */
    public function createPDF(Request $request) {
        //ddd($request);
        //var_dump($request->produtos); exit;
        $dataset = DB::table('horarios')
        ->orderBy('id', 'asc')
        ->get();  //ddd($dataset);

		//return view('admin.horario.pdf_view', ['dataset' => $dataset,]);

        $pdf = PDF::loadView('admin.horario.pdf_view', compact('dataset'));
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        return $pdf->stream('horario.pdf');
    }
}
