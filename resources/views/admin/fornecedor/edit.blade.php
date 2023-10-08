@extends('dashboard')

@section('cabecalho')
Editar Fornecedor
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

<form method="post" enctype="multipart/form-data" action="{{route('form_update_fornecedor')}}">
	@csrf
	<div class="form-group mt-2">
        <label for="nome">Nome*</label>
		<input type="text" class="form-control" name="nome" id="nome" value="{{$fornecedor[0]->nome}}">
        <label for="nome">Endereço</label>
        <input type="text" class="form-control" name="endereco" id="endereco" value="{{$fornecedor[0]->endereco}}">
        <div class="d-flex justify-content-between">
            <span style="width:30%;">
                <label for="fone1">Fone 1</label>
                <input type="text" class="form-control" name="fone1" id="fone1" value="{{$fornecedor[0]->fone1}}">
            </span>
            <span style="width:30%;">
                <label for="fone2">Fone 2</label>
                <input type="text" class="form-control" name="fone2" id="fone2" value="{{$fornecedor[0]->fone2}}">
            </span>
            <span style="width:30%;">
                <label for="fone3">Fone 3</label>
                <input type="text" class="form-control" name="fone3" id="fone3" value="{{$fornecedor[0]->fone3}}">
            </span>
        </div>
        <div class="d-flex justify-content-around">
            <button class="btn btn-primary mt-2" style="width:10%;">Salvar</button>
            <a class="btn btn-secondary mt-2 mx-9" style="width:10%;" href="{{route('listar_fornecedores')}}">Cancelar</a>
        </div>
	</div>
    <input type="hidden" id="id" name="id" value="{{$fornecedor[0]->id}}">
</form>
@endsection