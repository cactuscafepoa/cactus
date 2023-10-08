@extends('dashboard')

@section('cabecalho')
Alterar Horário
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

<form method="post" enctype="multipart/form-data" action="{{route('form_update_horario')}}">
	@csrf
	<div class="form-group mt-2">

        <label class="switch">
            @php
                $checked = "";
                if ($horario[0]->dia_mes_mostrar == '1') $checked = 'checked="checked"';
            @endphp
            <input type="checkbox" name="dia_mes_mostrar" id="dia_mes_mostrar" {{ $checked }}>
            <span class="slider round"></span>
        </label>
        <label for="dia_mes_mostrar" class="ml-4">Mostrar o dia do mês no horário?</label>

        <hr style="border:3px solid ;border-radius: 5px;">

        <div class="d-flex justify-content-between">

            <span style="width:8%;">
                <label for="dia_mes">Dia do MÊS</label>
                <select class="form-select form-select-sm" name="dia_mes" id="dia_mes">
                    <option value="" {{($horario[0]->dia_mes == "") ? 'selected' : ''}}></option>
                    <option value="1" {{($horario[0]->dia_mes == "1") ? 'selected' : ''}}>01</option>
                    <option value="2" {{($horario[0]->dia_mes == "2") ? 'selected' : ''}}>02</option>
                    <option value="3" {{($horario[0]->dia_mes == "3") ? 'selected' : ''}}>03</option>
                    <option value="4" {{($horario[0]->dia_mes == "4") ? 'selected' : ''}}>04</option>
                    <option value="5" {{($horario[0]->dia_mes == "5") ? 'selected' : ''}}>05</option>
                    <option value="6" {{($horario[0]->dia_mes == "6") ? 'selected' : ''}}>06</option>
                    <option value="7" {{($horario[0]->dia_mes == "7") ? 'selected' : ''}}>07</option>
                    <option value="8" {{($horario[0]->dia_mes == "8") ? 'selected' : ''}}>08</option>
                    <option value="9" {{($horario[0]->dia_mes == "9") ? 'selected' : ''}}>09</option>
                    <option value="10" {{($horario[0]->dia_mes == "10") ? 'selected' : ''}}>10</option>
                    <option value="11" {{($horario[0]->dia_mes == "11") ? 'selected' : ''}}>11</option>
                    <option value="12" {{($horario[0]->dia_mes == "12") ? 'selected' : ''}}>12</option>
                    <option value="13" {{($horario[0]->dia_mes == "13") ? 'selected' : ''}}>13</option>
                    <option value="14" {{($horario[0]->dia_mes == "14") ? 'selected' : ''}}>14</option>
                    <option value="15" {{($horario[0]->dia_mes == "15") ? 'selected' : ''}}>15</option>
                    <option value="16" {{($horario[0]->dia_mes == "16") ? 'selected' : ''}}>16</option>
                    <option value="17" {{($horario[0]->dia_mes == "17") ? 'selected' : ''}}>17</option>
                    <option value="18" {{($horario[0]->dia_mes == "18") ? 'selected' : ''}}>18</option>
                    <option value="19" {{($horario[0]->dia_mes == "19") ? 'selected' : ''}}>19</option>
                    <option value="20" {{($horario[0]->dia_mes == "20") ? 'selected' : ''}}>20</option>
                    <option value="21" {{($horario[0]->dia_mes == "21") ? 'selected' : ''}}>21</option>
                    <option value="22" {{($horario[0]->dia_mes == "22") ? 'selected' : ''}}>22</option>
                    <option value="23" {{($horario[0]->dia_mes == "23") ? 'selected' : ''}}>23</option>
                    <option value="24" {{($horario[0]->dia_mes == "24") ? 'selected' : ''}}>24</option>
                    <option value="25" {{($horario[0]->dia_mes == "25") ? 'selected' : ''}}>25</option>
                    <option value="26" {{($horario[0]->dia_mes == "26") ? 'selected' : ''}}>26</option>
                    <option value="27" {{($horario[0]->dia_mes == "27") ? 'selected' : ''}}>27</option>
                    <option value="28" {{($horario[0]->dia_mes == "28") ? 'selected' : ''}}>28</option>
                    <option value="29" {{($horario[0]->dia_mes == "29") ? 'selected' : ''}}>29</option>
                    <option value="30" {{($horario[0]->dia_mes == "30") ? 'selected' : ''}}>30</option>
                    <option value="31" {{($horario[0]->dia_mes == "31") ? 'selected' : ''}}>31</option>
                </select>
            </span>

            <span style="width:12%;">
                <label for="dia_semana">Dia da SEMANA</label>
                <select class="form-select form-select-sm" name="dia_semana" id="dia_semana">
                    <option value="Segunda" {{($horario[0]->dia_semana == "Segunda") ? 'selected' : ''}}>Segunda</option>
                    <option value="Terça" {{($horario[0]->dia_semana == "Terça") ? 'selected' : ''}}>Terça</option>
                    <option value="Quarta" {{($horario[0]->dia_semana == "Quarta") ? 'selected' : ''}}>Quarta</option>
                    <option value="Quinta" {{($horario[0]->dia_semana == "Quinta") ? 'selected' : ''}}>Quinta</option>
                    <option value="Sexta" {{($horario[0]->dia_semana == "Sexta") ? 'selected' : ''}}>Sexta</option>
                    <option value="Sábado" {{($horario[0]->dia_semana == "Sábado") ? 'selected' : ''}}>Sábado</option>
                    <option value="Domingo" {{($horario[0]->dia_semana == "Domingo") ? 'selected' : ''}}>Domingo</option>
                </select>
            </span>

            <span style="width:14%;">
                <label for="aberto">Estado dia semana</label>
                <select class="form-select form-select-sm" name="aberto" id="aberto">
                    <option value="Aberto" {{($horario[0]->aberto == "Aberto") ? 'selected' : ''}}>Aberto</option>
                    <option value="Fechado" {{($horario[0]->aberto == "Fechado") ? 'selected' : ''}}>Fechado</option>
                    <option value="Feriado" {{($horario[0]->aberto == "Feriado") ? 'selected' : ''}}>Feriado</option>
                    <option value="Férias coletivas" {{($horario[0]->aberto == "Férias coletivas") ? 'selected' : ''}}>Férias coletivas</option>
                </select>
            </span>

            <span style="width:15%;">
                <label for="hora_abre">Hora abre (8h30min)</label>
                <input type="text" class="form-control" name="hora_abre" id="hora_abre" value="{{$horario[0]->hora_abre}}">
            </span>

            <span style="width:15%;">
                <label for="hora_fecha">Hora fecha (18h30min)</label>
                <input type="text" class="form-control" name="hora_fecha" id="hora_fecha" value="{{$horario[0]->hora_fecha}}">
            </span>
        </div>

        <hr style="border:3px solid ;border-radius: 5px;">

        <label for="aviso">Aviso/recado</label>
        <input type="text" class="form-control" name="aviso" id="aviso" value="{{$horario[0]->aviso}}">

        <label for="atendimento_fisico">Atendimento físico</label>
        <input type="text" class="form-control" name="atendimento_fisico" id="atendimento_fisico" value="{{$horario[0]->atendimento_fisico}}">

        <label for="atendimento_encomendas">Atendimento de encomendas</label>
        <input type="text" class="form-control" name="atendimento_encomendas" id="atendimento_encomendas" value="{{$horario[0]->atendimento_encomendas}}">

        <hr>

        <div class="d-flex justify-content-around">
            <button class="btn btn-primary mt-2" style="width:10%;">Salvar</button>
            <a class="btn btn-secondary mt-2 mx-9" style="width:10%;" href="{{route('listar_horarios')}}">Cancelar</a>
        </div>
	</div>
    <input type="hidden" id="id" name="id" value="{{$horario[0]->id}}">
</form>
@endsection