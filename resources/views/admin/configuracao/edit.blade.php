@extends('dashboard')

@section('cabecalho')
Alterar Configuração
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

<form method="post" enctype="multipart/form-data" action="{{route('form_update_configuracao')}}">
	@csrf
	<div class="form-group mt-2">

        <!-- CONFIGURAÇÃO DOS TEXTOS DA PÁGINA INICIAL -->
        <div style="display:flex;align-items:center;width:100%;margin-top:10px;margin-bottom:10px;">
            <label class="switch">
                @php
                    $checked = "";
                    if ($configuracao[0]->pagina_inicial == '1') $checked = 'checked="checked"';
                @endphp
                <input type="checkbox" name="pagina_inicial" id="pagina_inicial" {{ $checked }}>
                <span class="slider round"></span>
            </label>
            <label for="pagina_inicial" class="ml-4">Mostrar título e/ou texto na <strong>PÁGINA INICIAL</strong>?</label>
        </div>
        <label for="pagina_inicial_titulo" style='margin-bottom:6px;'>Título a ser mostrado</label>
        <input style="margin-bottom:10px;" type="text" class="form-control" name="pagina_inicial_titulo" id="pagina_inicial_titulo" value="{{$configuracao[0]->pagina_inicial_titulo}}">
        <label for="pagina_inicial_texto" style='margin-bottom:6px;'>Texto a ser mostrado</label>
        <input style="margin-bottom:10px;" type="text" class="form-control" name="pagina_inicial_texto" id="pagina_inicial_texto" value="{{$configuracao[0]->pagina_inicial_texto}}">

        <label for="botao_inicial" style='margin-bottom:6px;'>Qual botão será mostrado no card da página inicial?</label>
        <select class="form-select form-select-sm" style="width:20%;margin-bottom:10px;" name="botao_inicial" id="botao_inicial">
            <option value="cardapio" {{($configuracao[0]->botao_inicial == "cardapio") ? 'selected' : ''}}>Cardápio</option>
            <option value="pratos" {{($configuracao[0]->botao_inicial == "pratos") ? 'selected' : ''}}>Pratos do dia</option>
            <option value="encomendas" {{($configuracao[0]->botao_inicial == "encomendas") ? 'selected' : ''}}>Encomendas</option>
            <option value="novidades" {{($configuracao[0]->botao_inicial == "novidades") ? 'selected' : ''}}>Novidades</option>
        </select>

        <!--<label for="imagem">Imagem da capa do site (jpg, jpeg, png, bmp, gif ou webp - a imagem original possui 1024 x 768 pixels)</label>-->
        <label for="imagem">Imagem da capa do site (apenas jpg - a imagem original possui 1024 x 768 pixels)</label>
        <div style='display:flex;align-items:center;justify-content:space-between;'>
            <div style='display:flex;align-items:center;width:75%;'>
                <img src="{{asset('images/banner_capa.jpg')}}" alt="" class="img-thumbnail" height="100px" width="100px">
                <input type="file" class="form-control ml-5" name="imagem" id="imagem" value="">
            </div>
        </div>


        <hr style="border:3px solid ;border-radius: 5px;">

        <!-- CONFIGURAÇÃO DO CARDÁPIO, NOVIDADES E HORÁRIO -->
        <div style="display:flex;align-items:center;width:100%;margin-top:10px;">

            <label class="switch">
                @php
                    $checked = "";
                    if ($configuracao[0]->cardapio == '1') $checked = 'checked="checked"';
                @endphp
                <input type="checkbox" name="cardapio" id="cardapio"  {{ $checked }}>
                <span class="slider round"></span>
            </label>
            <label for="horario" class="ml-4">Mostrar <strong>CARDÁPIO</strong>?</label>

            <label class="switch" style="margin-left:60px;">
                @php
                    $checked = "";
                    if ($configuracao[0]->novidades == '1') $checked = 'checked="checked"';
                @endphp
                <input type="checkbox" name="novidades" id="novidades" {{ $checked }}>
                <span class="slider round"></span>
            </label>
            <label for="novidades" class="ml-4">Mostrar BLOCO <strong>NOVIDADES/DESTAQUES</strong>?</label>

            <label class="switch" style="margin-left:60px;">
                @php
                    $checked = "";
                    if ($configuracao[0]->horario == '1') $checked = 'checked="checked"';
                @endphp
                <input type="checkbox" name="horario" id="horario"  {{ $checked }}>
                <span class="slider round"></span>
            </label>

            <label for="horario" class="ml-4">Mostrar página <strong>HORÁRIO</strong>?</label>

        </div>

        <hr style="border:3px solid ;border-radius: 5px;">

        <!-- CONFIGURAÇÃO DOS TEXTOS DO BLOCO PRATO DO DIA -->
        <div style="display:flex;align-items:center;width:100%;margin-top:10px;">
            <label class="switch">
                @php
                    $checked = "";
                    if ($configuracao[0]->prato_dia == '1') $checked = 'checked="checked"';
                @endphp
                <input type="checkbox" name="prato_dia" id="prato_dia" {{ $checked }}>
                <span class="slider round"></span>
            </label>
            <label for="prato_dia" class="ml-4">Mostrar BLOCO <strong>PRATOS DO DIA</strong> (refeições que serão servidas no dia seguinte)?</label>
        </div>
        <label for="prato_dia_botao">Texto do botão da página inicial</label>
        <input type="text" class="form-control" name="prato_dia_botao" id="prato_dia_botao" value="{{$configuracao[0]->prato_dia_botao}}">

        <label for="prato_dia_botao_texto">Texto do bloco do botão da página inicial</label>
        <input type="text" class="form-control" name="prato_dia_botao_texto" id="prato_dia_botao_texto" value="{{$configuracao[0]->prato_dia_botao_texto}}">

        <label for="prato_dia_cabecalho">Cabeçalho da página</label>
        <input type="text" class="form-control" name="prato_dia_cabecalho" id="prato_dia_cabecalho" value="{{$configuracao[0]->prato_dia_cabecalho}}">

        <label for="prato_dia_texto_titulo">Texto destaque da página</label>
        <input type="text" class="form-control" name="prato_dia_texto_titulo" id="prato_dia_texto_titulo" value="{{$configuracao[0]->prato_dia_texto_titulo}}">

        <label for="prato_dia_texto">Texto da página</label>
        <input type="text" class="form-control" name="prato_dia_texto" id="prato_dia_texto" value="{{$configuracao[0]->prato_dia_texto}}">

        <hr style="border:3px solid ;border-radius: 5px;">

        <!-- CONFIGURAÇÃO DO TEXTO DA PÁGINA ENCOMENDAS -->
        <div style="display:flex;align-items:center;width:100%;margin-top:10px;">
            <label class="switch">
                @php
                    $checked = "";
                    if ($configuracao[0]->encomendas == '1') $checked = 'checked="checked"';
                @endphp
                <input type="checkbox" name="encomendas" id="encomendas"  {{ $checked }}>
                <span class="slider round"></span>
            </label>
            <label for="encomendas" class="ml-4">Mostrar BLOCO/PÁGINA <strong>ENCOMENDAS</strong>?</label>
        </div>
        <hr>
        <label for="encomendas_titulo">Título a ser mostrado</label>
        <input type="text" class="form-control" name="encomendas_titulo" id="encomendas_titulo" value="{{$configuracao[0]->encomendas_titulo}}">
        <label for="encomendas_texto">Texto a ser mostrado</label>
        <input type="text" class="form-control" name="encomendas_texto" id="encomendas_texto" value="{{$configuracao[0]->encomendas_texto}}">

        <hr style="border:3px solid ;border-radius: 5px;">

        <div class="d-flex justify-content-between">
            <div>
            <label for="botao_inicial">Qual publicação de Evento será mostrada no site?</label>
            <select class="form-select form-select-sm" style="width:20%;" name="evento_id" id="evento_id">
                @foreach ($eventos as $evento)
                    <option value="{{$evento->id}}" {{($configuracao[0]->evento_id == $evento->id) ? 'selected' : ''}}>{{$evento->id}}</option>
                @endforeach
            </select>
            </div>
            <div>
            <label for="botao_inicial">Cardápio físico: quantidade de produtos por coluna (valor entre 20 e 100)*</label>
            <input style="width:20%;"  maxlength="3" type="text" class="form-control" name="cardapio_fisico_qtd" id="cardapio_fisico_qtd" value="{{$configuracao[0]->cardapio_fisico_qtd}}">
            </div>
        </div>

        <hr>

        <div class="d-flex justify-content-around">
            <button class="btn btn-primary mt-2" style="width:10%;">Salvar</button>
            <a class="btn btn-secondary mt-2 mx-9" style="width:10%;" href="{{route('listar_configuracaos')}}">Cancelar</a>
        </div>
	</div>
    <input type="hidden" id="id" name="id" value="{{$configuracao[0]->id}}">
</form>
@endsection