@extends('dashboard')

@section('cabecalho')
Relação de Usuários
@endsection

@section('conteudo')

 @if(!empty($mensagem))
<div class="alert alert-success mt-3">
	{{$mensagem}}
</div>
@endif


<div class="d-flex justify-content-between">
	<a href="{{route('form_edit_usuario_new')}}" class="btn btn-primary mt-2 mb-2">Adicionar Usuário</a>
	<a href="{{route('dashboard')}}" class="btn btn-primary mt-2 mb-2">Voltar</a>
</div>

<ul class="list-group">
<li class="list-group-item d-flex justify-content-between align-items-center bg-secondary text-white" style="height:48px;">
		<span class="d-flex" style='width:59%;'>
			Nome do usuário
		</span>
		<span class="d-flex" style='width:35%;'>
			Permissão
		</span>
		<span class="d-flex" style='width:6%;'>
			Ações
		</span>
	</li>
	{{--dd($dataset)--}}
	@foreach ($dataset as $user)	
	<li class="list-group-item d-flex justify-content-between align-items-center">
		<span class="d-flex" style='width:59%;'>
			{{ $user->name }}
		</span>
		@php
			$papel = 'Usuário';
		@endphp
		@foreach ($user->permissions as $permission)
			@php
				if ( $permission->name === 'admin' ) {
					$papel = "Administrador";
				}
			@endphp
		@endforeach
		<span class="d-flex" style='width:35%;'>
			{{ $papel }}
		</span>
		<span class="d-flex" style='width:6%;'>
			<form name='editar' method="get" action="{{route('form_edit_usuario_old', ['id' => $user->id])}}">
				<!-- tirei o csrf por causa do método get -->
				<button class="btn btn-primary btn-sm mr-2">
					<i class="fas fa-edit"></i>
				</button>
			</form>
			<form name='excluir' method="post" action="/usuarios/remover/{{$user->id}}" onsubmit="return confirm('Confirma remoção do usuário: {{addslashes($user->name)}}?');">
				@csrf
				<button class="btn btn-danger btn-sm">
					<i class="fas fa-trash-alt"></i>
				</button>
			</form>
		</span>
	</li>
	@endforeach
</ul>
@endsection