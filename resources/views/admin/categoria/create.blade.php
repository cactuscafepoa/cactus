@extends('dashboard')

@section('cabecalho')
Adicionar Categoria
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
        <label for="nome">Nome*</label>
		<input type="text" class="form-control" name="nome" id="nome" value="{{old('nome')}}">
        <label for="descricao">Descrição</label>
        <input type="text" class="form-control" name="descricao" id="descricao" value="{{old('descricao')}}">

        <div style="display:flex;align-items:center;width: 20%;margin-top:10px;">
            <label for="visivel" class="mr-4">Visível?</label>
            <label class="switch">
                <input type="checkbox" name="visivel" id="visivel">
                <span class="slider round"></span>
            </label>
        </div>
        <hr>
        <label for="imagem">Imagem (jpg, jpeg, png, bmp, gif, svg ou webp)</label>
        <input type="file" class="form-control" name="imagem" id="imagem" value="">

        <div class="d-flex justify-content-around">
            <button class="btn btn-primary mt-2" style="width:10%;">Salvar</button>
            <a class="btn btn-secondary mt-2 mx-9" style="width:10%;" href="{{route('listar_categorias')}}">Cancelar</a>
        </div>        	        
	</div>
</form>
@endsection