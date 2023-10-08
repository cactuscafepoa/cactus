@extends('dashboard')

@section('cabecalho')
Relação de Clientes
@endsection

@section('conteudo')

 @if(!empty($mensagem))
<div class="alert alert-success mt-3">
	{{$mensagem}}
</div>
@endif

<div class="d-flex justify-content-between">
	<a href="{{route('form_edit_cliente_new')}}" class="btn btn-primary mt-2 mb-2">Adicionar Cliente</a>
	<a href="{{route('dashboard')}}" class="btn btn-primary mt-2 mb-2">Voltar</a>
</div>


<ul class="list-group">
	<li class="list-group-item d-flex justify-content-between align-items-center bg-secondary text-white" style="height:48px;">
		<span class="d-flex" style='width:94;'>
			Nome do cliente
		</span>
		<span class="d-flex" style='width:6%;'>
			Ações
		</span>	
	</li>		
	@foreach ($dataset as $campo)
	<li class="list-group-item d-flex justify-content-between align-items-center">
		<span class="d-flex" style='width:94%;'>
			{{ $campo->nome }}
		</span>
		<span class="d-flex" style='width:6%;'>
			<form name='editar' method="get" action="{{route('form_edit_cliente_old', ['id' => $campo->id])}}">
				<!-- tirei o csrf por causa do método get -->
				<button class="btn btn-primary btn-sm mr-2">
					<i class="fas fa-edit"></i>
				</button>
			</form>
			<form name='excluir' method="post" action="/clientes/remover/{{$campo->id}}" onsubmit="return confirm('Confirma remoção do cliente: {{addslashes($campo->nome)}}?');">
				@csrf
				<button class="btn btn-danger btn-sm mr-2">
					<i class="fas fa-trash-alt"></i>
				</button>
			</form>
			</span>
		</li>
	@endforeach
</ul>
@endsection