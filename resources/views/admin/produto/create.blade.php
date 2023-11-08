@extends('dashboard')

@section('cabecalho')
Adicionar Produto
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
	<div class="form-group mt-2">
        <label for="categoria_id">Categoria*</label>
        <select class="form-control" name="categoria_id" id="categoria_id">
            <option>Selecione Categoria</option>
            @foreach ($categorias as $value)
                @if ( old('categoria_id') == $value->id )
                    <option value="{{ $value->id }}" selected>{{$value->nome}}</option>
                @else
                    <option value="{{ $value->id }}" >{{$value->nome}}</option>
                @endif
            @endforeach
        </select>
        <label for="nome">Nome*</label>
		<input type="text" class="form-control" name="nome" id="nome" value="{{old('nome')}}">
        <label for="descricao">Descrição</label>
        <input type="text" class="form-control" name="descricao" id="descricao" value="{{old('descricao')}}">

        <hr>

        <div class="d-flex justify-content-between">
            <span style="width:23%;">
                <label for="marca">Marca/Modelo</label>
                <input type="text" class="form-control" name="marca" id="marca" value="{{old('marca')}}">
            </span>
            <span style="width:18%;">
                <label for="volume">Volume</label>
                <input type="text" class="form-control" name="volume" id="volume" value="{{old('volume')}}">
            </span>
            <span style="width:18%;">
                <label for="tipo_volume">Tipo do volume</label>
                <input type="text" class="form-control" name="tipo_volume" id="tipo_volume" value="{{old('tipo_volume')}}">
            </span>
            <span style="width:8%;">
                <label for="ncm">Código NCM</label>
            <input type="text" class="form-control" name="ncm" id="ncm" value="{{old('ncm')}}">
            </span>
            <span style="width:23%;">
                <a href="https://portalunico.siscomex.gov.br/classif/#/sumario?perfil=publico" target="_blank">Pesquisar NCM</a>
            </span>
        </div>

        <hr>

        <div class="d-flex justify-content-between">

            <span style="width:24%;">
            <label for="preco">Preço</label>
            <input type="text" class="form-control" name="preco" id="preco" value="{{old('preco')}}">
            </span>
            <span style="width:24%;">
            <label for="preco_venda">Preço Venda*</label>
            <input type="text" class="form-control" name="preco_venda" id="preco_venda" value="{{old('preco_venda')}}">
            </span>
            <span style="width:24%;">
            <label for="quantidade">Quantidade</label>
            <input type="text" class="form-control" name="quantidade" id="quantidade" value="{{old('quantidade')}}">
            </span>
        </div>

        <hr>

        <div class="d-flex justify-content-between align-items-center">
            <span style="width:100%;">
                <label for="fornecedor_id">Fornecedor*</label>
                <select class="form-control" name="fornecedor_id" id="fornecedor_id">
                    <option value="">Selecione Fornecedor</option>
                    @foreach ($fornecedores as $value)
                        @if ( old('fornecedor_id') == $value->id )
                            <option value="{{ $value->id }}" selected>{{$value->nome}}</option>
                        @else
                            <option value="{{ $value->id }}" >{{$value->nome}}</option>
                        @endif
                    @endforeach
                </select>
            </span>
        </div>

        <hr>

        <div class="d-flex align-items-center">
            @php $checked = ""; if (old('visivel') === "on") $checked = "checked"; @endphp
            <span class="d-flex align-items-center justify-content-flex-end">
                <label for="visivel" class="mr-4">Visível?</label>
                <label class="switch">
                    <input type="checkbox" {{ $checked }} name="visivel" id="visivel">
                    <span class="slider round"></span>
                </label>
            </span>

            @php $checked = ""; if (old('prato_dia') === "on") $checked = "checked"; @endphp
            <span class="d-flex align-items-center justify-content-flex-end" style="margin-left:30px;">
                <label for="prato_dia" class="mr-4">Prato do dia?</label>
                <label class="switch">
                    <input type="checkbox" {{ $checked }} name="prato_dia" id="prato_dia">
                    <span class="slider round"></span>
                </label>
            </span>

            @php $checked = ""; if (old('visivel_cardapio_fisico') === "on") $checked = "checked"; @endphp
            <span class="d-flex align-items-center justify-content-flex-end" style="margin-left:30px;">
                <label for="visivel_cardapio_fisico" class="mr-4">Aparecer no cardápio físico?</label>
                <label class="switch">
                    <input type="checkbox" {{ $checked }} name="visivel_cardapio_fisico" id="visivel_cardapio_fisico">
                    <span class="slider round"></span>
                </label>
            </span>

        </div>

        <hr>

        <div class="d-flex justify-content-between">

            @php $checked = ""; if (old('destaque') === "on") $checked = "checked"; @endphp
            <span class="d-flex align-items-center justify-content-flex-end" style="width:20%;">
                <label for="destaque" class="mr-4">Produto destaque?</label>
                <label class="switch">
                    <input type="checkbox" {{ $checked }} name="destaque" id="destaque">
                    <span class="slider round"></span>
                </label>
            </span>
            <span style="width:80%;">
                <label for="destaque_texto">Descrição para destaque/novidade (acrescenta este texto na descrição do produto)</label>
                <input type="text" class="form-control" name="destaque_texto" id="destaque_texto" value="{{old('destaque_texto')}}">
            </span>
        </div>

        <hr>

        <div class="d-flex justify-content-between">

            @php $checked = ""; if (old('encomenda') === "on") $checked = "checked"; @endphp
            <span class="d-flex align-items-center justify-content-flex-end" style="width:20%;">
                <label for="encomenda" class="mr-4">Aceita encomenda?</label>
                <label class="switch">
                    <input type="checkbox" {{ $checked }} name="encomenda" id="encomenda">
                    <span class="slider round"></span>
                </label>
            </span>
            <span style="width:20%;">
                <label for="encomenda_preco_venda">Preço Venda Encomenda</label>
                <input type="text" class="form-control" name="encomenda_preco_venda" id="encomenda_preco_venda" value="{{old('encomenda_preco_venda')}}">
            </span>
            <span style="width:20%;">
                <label for="encomenda_quantidade_minima">Quantidade Mínima</label>
                <input type="text" class="form-control" name="encomenda_quantidade_minima" id="encomenda_quantidade_minima" value="{{old('encomenda_quantidade_minima')}}">
            </span>
            <span style="width:20%;">
                <label for="encomenda_prazo_minimo">Prazo entrega (em dias)</label>
                <input type="text" class="form-control" name="encomenda_prazo_minimo" id="encomenda_prazo_minimo" value="{{old('encomenda_prazo_minimo')}}">
            </span>
        </div>

        <hr>

        <label for="link">Link (Instagram ou YouTube)</label>
        <input type="text" class="form-control" name="link" id="link" value="{{old('link')}}">

        <label for="imagem">Imagem (jpg, jpeg, png, bmp, gif, svg ou webp)</label>
        <input type="file" class="form-control" name="imagem" id="imagem" value="{{old('imagem')}}">
        <div class="d-flex justify-content-around">
            <button class="btn btn-primary mt-2" style="width:10%;">Salvar</button>
            <a class="btn btn-secondary mt-2 mx-9" style="width:10%;" href="{{route('listar_produtos')}}">Cancelar</a>
        </div>

	</div>
</form>
@endsection