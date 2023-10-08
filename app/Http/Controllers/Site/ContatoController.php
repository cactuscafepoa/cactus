<?php

namespace App\Http\Controllers\Site;

use App\Models\Contato;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContatoFormRequest;
use App\Notifications\NovoContato;
use Illuminate\Support\Facades\Notification;

//use Illuminate\Http\Request;
//use App\Models\Contato;

class ContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
 
     public function index()
    {
        return view('site.contato.index');
    }

    public function formulario(ContatoFormRequest $request)
    {
        //ddd($request->all());        
        $contato = Contato::create($request->all());
        //ddd($contato);

        Notification::route('mail', config('mail.from.address'))->notify(new NovoContato($contato));

        toastr()->success('Mensagem enviada com sucesso.');
        return back();

        // para redirecionar para o formulário novamente
        //return redirect()->route('site.contato ');


        //ddd($contato);

        /*Notification::route('mail', config('mail.from.address'))
            ->notify(new NewContact($contact));
            toastr()->success('O contato foi criado com sucesso!');
            return back()->with([
                'success' => true,
                'message' => 'O contato foi criado com sucesso!'
            ]);*/


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
