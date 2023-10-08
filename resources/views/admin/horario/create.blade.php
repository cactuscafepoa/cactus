@extends('dashboard')

@section('cabecalho')
Configurar Horário
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

    <span style="width:12%;">
        <label for="dia_semana">Dia da SEMANA</label>
        <select class="form-select form-select-sm" style="width:12%;" name="dia_semana" id="dia_semana">
            <option value="">Escolha</option>
            <option value="Segunda">Segunda</option>
            <option value="Terça">Terça</option>
            <option value="Quarta">Quarta</option>
            <option value="Quinta">Quinta</option>
            <option value="Sexta">Sexta</option>
            <option value="Sábado">Sábado</option>
            <option value="Domingo">Domingo</option>
        </select>
    </span>

	<div class="form-group mt-2">
        <label class="ml-4">Para gerar um horário, escolha um dia da semana e salve este formulário. Após, vá na edição deste para complementar as informações.</label>
        <div class="d-flex justify-content-around">
            <button class="btn btn-primary mt-2" style="width:10%;">Salvar</button>
            <a class="btn btn-secondary mt-2 mx-9" style="width:10%;" href="{{route('listar_horarios')}}">Cancelar</a>
        </div>
	</div>

    <input type="hidden" id="dia_mes_mostrar" name="dia_mes_mostrar" value="0">
    <input type="hidden" id="aberto" name="aberto" value="Aberto">
    <input type="hidden" id="hora_abre" name="hora_abre" value="8h">
    <input type="hidden" id="hora_fecha" name="hora_fecha" value="18h">

</form>
@endsection