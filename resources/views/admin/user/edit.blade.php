@extends('dashboard')

@section('cabecalho')
Editar Usuário
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

{{--dd($dataset)--}}
{{--dd($dataset[0]->permissions[0]->name)--}}
{{--dd($dataset[0]->permissions[0]->permission_id)--}}
{{--dd($dataset[0]->name)--}}
{{--dd($dataset[0]->permissions[0]->id)--}}

<form method="post" enctype="multipart/form-data" action="{{route('form_update_usuario')}}">
	@csrf
	<div class="form-group mt-2">
        <label for="nome">Nome*</label>
		<input type="text" class="form-control" name="name" id="name" value="{{$dataset[0]->name}}">
        <label for="nome">E-mail*</label>
        <input type="text" class="form-control" name="email" id="email" value="{{$dataset[0]->email}}">

        <div class="d-flex justify-content-between">
            <span style="width:45%;">
                <label for="password">Nova Senha</label>
                <input type="text" class="form-control" name="password" id="password" value="">
            </span>
            <span style="width:45%;">
                <label for="permission_id">Tipo do Usuário*</label>
                <select class="form-control" name="permission_id" id="permission_id">
                    <option>Selecione o tipo do usuário</option>
                    @php
                        $id_papel = "";
                    @endphp
                    @foreach ($permissoes as $value)
                        @php
                            if ( $value->name === 'admin' ) {
                                $papel = "Administrador";
                            }
                            elseif ( $value->name === 'user' ) {
                                $papel = 'Usuário';
                            }
                            else {
                                $papel = 'Não cadastrado';
                            }
                            $selected = "";
                            if ($dataset[0]->permissions[0]->id == $value->id) {
                                $selected = "selected";
                                $id_papel = $value->id;
                            }
                        @endphp
                        <option value="{{ $value->id }}" {{$selected}} >{{$papel}}</option>
                    @endforeach
                </select>
            </span>
        </div>
        <div class="d-flex justify-content-around">
            <button class="btn btn-primary mt-2" style="width:10%;">Salvar</button>
            <a class="btn btn-secondary mt-2 mx-9" style="width:10%;" href="{{route('listar_usuarios')}}">Cancelar</a>
        </div>
	</div>
    <input type="hidden" id="id" name="id" value="{{$dataset[0]->id}}">
    <input type="hidden" id="id_papel" name="id_papel" value="{{$id_papel}}">
</form>
@endsection