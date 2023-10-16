@extends('dashboard')

@section('cabecalho')
Configuração de Horário
@endsection

@section('conteudo')
 @if(!empty($mensagem))
<div class="alert alert-success mt-3">
	{{$mensagem}}
</div>
@endif


<div class="d-flex justify-content-between">
	<a href="{{route('form_edit_horario_new')}}" class="btn btn-primary mt-2 mb-2">Incluir Horário</a>

	<a class="btn btn-primary mt-2 mb-2" onclick="horario();">Imprimir Horário</a>

	<a href="{{route('dashboard')}}" class="btn btn-primary mt-2 mb-2">Voltar</a>
</div>

<ul class="list-group">
	<li class="list-group-item d-flex justify-content-between align-items-center bg-secondary text-white" style="height:48px;">
		<span class="d-flex" style='width:17%;'>
			Dia semana
		</span>
		<span class="d-flex" style='width:15%;'>
			Estado
		</span>
		<span class="d-flex" style='width:15%;'>
			Abre
		</span>
		<span class="d-flex" style='width:15%;'>
			Fecha
		</span>
		<span class="d-flex" style='width:6%;'>
			Ações
		</span>
	</li>
	{{--dd($dataset)--}}
	@foreach ($dataset as $horario)
	<li class="list-group-item d-flex justify-content-between align-items-center">
		<span class="d-flex" style='width:17%;'>
			{{ $horario->dia_semana}}
		</span>
		<span class="d-flex" style='width:15%;'>
			{{ $horario->aberto}}
		</span>
		<span class="d-flex" style='width:15%;'>
			{{ $horario->hora_abre}}
		</span>
		<span class="d-flex" style='width:15%;'>
			{{ $horario->hora_fecha}}
		</span>
		<span class="d-flex" style='width:6%;'>
			<form name='editar' method="get" action="{{route('form_edit_horario_old', ['id' => $horario->id])}}" style="height:8px;">
					<button class="btn btn-primary btn-sm mr-2">
						<i class="fas fa-edit"></i>
					</button>
			</form>
			<form name='excluir' method="post" action="/horarios/remover/{{$horario->id}}" onsubmit="return confirm('Confirma remoção do horario: {{addslashes($horario->dia_semana)}}?');" style="height:8px;">
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

<form name='form_pdf' id='form_pdf' method="post" action="{{route('pdf_horario_envia')}}">
	@csrf
</form>

<script>
	function horario() {
		document.getElementById("form_pdf").target = "_blank";
		document.getElementById('form_pdf').submit();
	}
</script>