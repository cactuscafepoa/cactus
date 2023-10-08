@extends('dashboard')

@section('cabecalho')
Relação de Categorias
@endsection

@section('conteudo')

 @if(!empty($mensagem))
<div class="alert alert-success mt-3">
	{{$mensagem}}
</div>
@endif
@if(!empty($mensagemValidaRelacao))
<div class="alert alert-danger mt-3">
	{{$mensagemValidaRelacao}}
</div>
@endif

<div class="d-flex justify-content-between">
	<a href="{{route('form_edit_categoria_new')}}" class="btn btn-primary mt-2 mb-2">Adicionar Categoria</a>
	<a href="{{route('dashboard')}}" class="btn btn-primary mt-2 mb-2">Voltar</a>
</div>

<ul class="list-group">
	<li class="list-group-item d-flex justify-content-between align-items-center bg-secondary text-white" style="height:48px;">
		<span class="d-flex" style='width:79%;'>
			Nome
		</span>
		<span class="d-flex" style='width:15%;'>
			Visível?
		</span>				
		<span class="d-flex" style='width:6%;'>
			Ações
		</span>		
	</li>
	@foreach ($dataset as $categoria)
		<li class="list-group-item d-flex justify-content-between align-items-center">
			<span class="d-flex" style='width:79%;'>
				{{ $categoria->nome }}
			</span>	

			@php			
			if ($categoria->visivel == 1) { @endphp
				<span class="d-flex" style='width:15%;color:#3b8310;'>Sim</span>	
			@php
			}
			elseif ($categoria->visivel == 0) { @endphp			
				<span class="d-flex" style='width:15%;color:#f44336;'>Não</span>	
			@php
			}
			@endphp

			<span class="d-flex" style='width:6%;'>
				<form name='editar' method="get" action="{{route('form_edit_categoria_old', ['id' => $categoria->id])}}">
					<!-- tirei o csrf por causa do método get -->
					<button class="btn btn-primary btn-sm mr-2">
						<i class="fas fa-edit"></i>
					</button>
				</form>
				<form name='excluir' method="post" action="/categorias/remover/{{$categoria->id}}" onsubmit="return confirm('Confirma remoção da categoria: {{addslashes($categoria->nome)}}?');">
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