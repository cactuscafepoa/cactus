@extends('dashboard')

@section('cabecalho')
Configurar Site
@endsection

@section('conteudo')
@if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" enctype="multipart/form-data">
	@csrf
	<div class="form-group mt-2">


        <!--<div style="display:flex;align-items:center;width:100%;margin-top:10px;">
            <label class="switch">
                <input type="checkbox" name="prato_dia" id="prato_dia">
                <span class="slider round"></span>
            </label>
            <label for="prato_dia" class="ml-4">Mostrar PRATO DO DIA?</label>
        </div>
        <label for="prato_dia_titulo">Título para o bloco PRATO DO DIA</label>
        <input type="text" class="form-control" name="prato_dia_titulo" id="prato_dia_titulo" value="{{old('prato_dia_titulo')}}">        
        <label for="prato_dia_texto">Texto para mostrar em PRATO DO DIA</label>
        <input type="text" class="form-control" name="prato_texto" id="prato_dia_texto" value="{{old('prato_dia_texto')}}">
        <hr>
        <div style="display:flex;align-items:center;width:100%;margin-top:10px;">            
            <label class="switch">
                <input type="checkbox" name="novidades" id="novidades">
                <span class="slider round"></span>
            </label>
            <label for="novidades" class="ml-4">Mostrar novidades?</label>
        </div>
        <hr>
        <div style="display:flex;align-items:center;width:100%;margin-top:10px;">            
            <label class="switch">
                <input type="checkbox" name="encomendas" id="encomendas">
                <span class="slider round"></span>
            </label>
            <label for="encomendas" class="ml-4">Mostrar Encomendas?</label>
        </div>        
        <hr>        
        <div style="display:flex;align-items:center;width:100%;margin-top:10px;">            
            <label class="switch">
                <input type="checkbox" name="horario" id="horario">
                <span class="slider round"></span>
            </label>
            <label for="horario" class="ml-4">Mostrar Horário?</label>
        </div>                
        <hr>-->
        <label class="ml-4">Para gerar uma configuração, apenas salve este formulário. Após, vá na edição deste para complementar as configurações.</label>
        <div class="d-flex justify-content-around">
            <button class="btn btn-primary mt-2" style="width:10%;">Salvar</button>
            <a class="btn btn-secondary mt-2 mx-9" style="width:10%;" href="{{route('listar_configuracaos')}}">Cancelar</a>
        </div>        	        
	</div>
</form>
@endsection