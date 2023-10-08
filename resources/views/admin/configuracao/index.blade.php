@extends('dashboard')

@section('cabecalho')
Configurações
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
	<a href="{{route('form_edit_configuracao_new')}}" class="btn btn-primary mt-2 mb-2">Incluir Configuração</a>
	<a href="{{route('dashboard')}}" class="btn btn-primary mt-2 mb-2">Voltar</a>
</div>

<ul class="list-group">
	<li class="list-group-item bg-secondary text-white">
		<!--<span class="d-flex">
			ID
		</span>-->
		<span style="width:18%;display: inline-block;">
			Página Inicial
		</span>				
		<span style="width:14%;display: inline-block;">
			Cardápio
		</span>				
		<span style="width:18%;display: inline-block;">
			Prato do Dia
		</span>		
		<span style="width:14%;display: inline-block;">
			Encomendas
		</span>		
		<span style="width:14%;display: inline-block;">
			Novidades
		</span>		
		<span style="width:14%;display: inline-block;">
			Horário
		</span>								
		<span style="width:6%;display: inline-block;float:right;">
			Ações
		</span>		
	</li>
	@foreach ($dataset as $configuracao)
		<li class="list-group-item">
			<!--<span class="d-flex">
				{{ $configuracao->id }}
			</span>	-->
			@php $conf = "Não"; if ($configuracao->pagina_inicial == 1) $conf = "Sim"; @endphp
			<span style="width:18%;display: inline-block;">
				{{ $conf}}
			</span>	
			@php $conf = "Não"; if ($configuracao->cardapio == 1) $conf = "Sim"; @endphp
			<span style="width:14%;display: inline-block;">
				{{ $conf}}
			</span>	
			@php $conf = "Não"; if ($configuracao->prato_dia == 1) $conf = "Sim"; @endphp
			<span style="width:18%;display: inline-block;">
				{{ $conf}}
			</span>	
			@php $conf = "Não"; if ($configuracao->encomendas == 1) $conf = "Sim"; @endphp		
			<span style="width:14%;display: inline-block;">
				{{ $conf}}				
			</span>
			@php $conf = "Não"; if ($configuracao->novidades == 1) $conf = "Sim"; @endphp
			<span style="width:14%;display: inline-block;">
				{{ $conf}}				
			</span>		
			@php $conf = "Não"; if ($configuracao->horario == 1) $conf = "Sim"; @endphp		
			<span style="width:14%;display: inline-block;">
				{{ $conf}}				
			</span>		
			<span style="width:6%;display: inline-block;float:right;">
				<form name='editar' method="get" action="{{route('form_edit_configuracao_old', ['id' => $configuracao->id])}}">
					<!-- tirei o csrf por causa do método get -->
					<button class="btn btn-primary btn-sm mr-2">
						<i class="fas fa-edit"></i>
					</button>
				</form>
			</span>
		</li>
	@endforeach
</ul>
@endsection