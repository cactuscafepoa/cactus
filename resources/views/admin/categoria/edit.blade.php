@extends('dashboard')

@section('cabecalho')
Editar Categoria
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

<form method="post" enctype="multipart/form-data" action="{{route('form_update_categoria')}}">
	@csrf
	<div class="form-group mt-2">
        <label for="nome">Nome*</label>
		<input type="text" class="form-control" name="nome" id="nome" value="{{$categoria[0]->nome}}">
        <label for="descricao">Descrição</label>
        <input type="text" class="form-control" name="descricao" id="descricao" value="{{$categoria[0]->descricao}}">

        <div style="display:flex;align-items:center;width: 20%;margin-top:10px;">
            <label for="visivel" class="mr-4">Visível?</label>
            <label class="switch">
                @php
                $valorVisivel = "";
                if ($categoria[0]->visivel == '1') $valorVisivel = 'checked="checked"';
                @endphp
                <input type="checkbox" name="visivel" id="visivel" {{$valorVisivel}}>
                <span class="slider round"></span>
            </label>
        </div>
        <hr>
        <label for="imagem">Imagem (jpg, jpeg, png, bmp, gif, svg ou webp de 275 x 180 pixels)</label>
        <div style='display:flex;align-items:center;justify-content:space-between;'>
            <div style='display:flex;align-items:center;width:75%;'>
                <img src="{{$categoria[0]->imagem}}" alt="" class="img-thumbnail" height="100px" width="100px">
                <input type="file" class="form-control ml-5" name="imagem" id="imagem" value="">
            </div>
            <div style='display:flex;align-items:center;width: 20%;'>
                <label for="remove_imagem" class="mr-4">Remover imagem</label>
                <label class="switch">
                    <input type="checkbox" name="remove_imagem" id="remove_imagem">
                    <span class="slider round"></span>
                </label>
            </div>
        </div>

        <div class="d-flex justify-content-around">
            <button class="btn btn-primary mt-2" style="width:10%;">Salvar</button>
            <a class="btn btn-secondary mt-2 mx-9" style="width:10%;" href="{{route('listar_categorias')}}">Cancelar</a>
        </div>
	</div>
    <input type="hidden" id="id" name="id" value="{{$categoria[0]->id}}">
</form>
@endsection