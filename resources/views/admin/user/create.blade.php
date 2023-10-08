@extends('dashboard')

@section('cabecalho')
Adicionar Usuário
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
        <label for="name">Nome*</label>
		<input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
        <label for="email">E-mail*</label>
        <input type="text" class="form-control" name="email" id="email" value="{{old('email')}}">
        <div class="d-flex justify-content-between">
            <span style="width:45%;">
                <label for="password">Senha provisória*</label>
                <input type="text" class="form-control" name="password" id="password" value="{{old('password')}}">        
            </span>
            <span style="width:45%;">
            </span>            
        </div>
        <div class="d-flex justify-content-around">
            <button class="btn btn-primary mt-2" style="width:10%;">Salvar</button>
            <a class="btn btn-secondary mt-2 mx-9" style="width:10%;" href="{{route('listar_usuarios')}}">Cancelar</a>
        </div>        	
	</div>
</form>
@endsection