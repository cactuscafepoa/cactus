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
        <label class="ml-4">Para gerar uma configuração, apenas salve este formulário. Após, vá na edição deste para complementar as configurações.</label>
        <div class="d-flex justify-content-around">
            <button class="btn btn-primary mt-2" style="width:10%;">Salvar</button>
            <a class="btn btn-secondary mt-2 mx-9" style="width:10%;" href="{{route('listar_configuracaos')}}">Cancelar</a>
        </div>
	</div>
</form>
@endsection