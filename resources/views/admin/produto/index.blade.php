@extends('dashboard')

@section('cabecalho')
	Relação de Produtos
@endsection

@section('conteudo')

@php
	if(!empty($mensagem)) {

		if (strpos($mensagem, "obrigatório ou possui valor inválido") > 0) {
			echo "<div class='alert alert-danger mt-3'>".$mensagem."</div>";
		}
		elseif (strpos($mensagem, "para gerar-se cardápio físico") > 0) {
			echo "<script>alert('".$mensagem."');window.close();</script>";
		}
		else {
			echo "<div class='alert alert-success mt-3'>".$mensagem."</div>";
		}
 	}
@endphp

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form id="formPesquisar" name='formPesquisar' method="post" action="{{route('listar_produtos_pesquisa')}}">
	@csrf
	<fieldset style="border:1px solid #dfdfdf;padding: 0px 10px 10px 10px;">
		<legend style="float:initial;width:initial;color:#212529;font-size:20px;margin: 0px;">Filtrar:</legend>

		<div class="d-flex justify-content-between">
			<div>
				<label for="categoria_id_pesq">Categoria</label>
				<select class="form-select form-select-sm" style="height:35px;" name="categoria_id_pesq" id="categoria_id_pesq">
					<option value=""></option>
					@foreach ($categorias as $value)
						<option value="{{$value->id}}" {{($value->id == $categoria_id_pesq) ? 'selected' : ''}}>{{$value->nome}}</option>
					@endforeach
				</select>
			</div>
			<div>
				<label for="nome_pesq">Nome do produto</label>
				<input style="height:35px;"  size="60" maxlength="125" type="text" class="form-control" name="nome_pesq" id="nome_pesq" value="{{$nome_pesq}}">
			</div>
			<div>
				<a onclick="document.getElementById('formPesquisar').submit();" class="btn btn-primary mt-2 mb-2">Pesquisar</a><br>
				<a onclick="chamaLimpar();" class="btn btn-primary mt-2 mb-2" style="width:96px;">Limpar</a>
			</div>
		</div>
	</fieldset>
</form>

<form name='form_pdf' id='form_pdf' method="post" action="{{route('pdf_produto_envia')}}">
	@csrf

	<div class="d-flex justify-content-between" style="border:1px solid #dfdfdf;padding:10px;margin-bottom:10px;">
		<a href="{{route('form_edit_produto_new')}}" class="btn btn-primary mt-2 mb-2">Adicionar Produto</a>
		<a class="btn btn-primary mt-2 mb-2" onclick="cardapio();">Gerar Cardápio Físico (só assinalados)</a>
		<a class="btn btn-primary mt-2 mb-2" onclick="listagem_produtos();">Listar Produtos</a>
		<a href="{{route('dashboard')}}" class="btn btn-primary mt-2 mb-2">Voltar</a>
	</div>

<ul class="list-group">
	<li class="list-group-item d-flex justify-content-between align-items-center bg-secondary text-white" style="height:48px;padding:5px;">
		<span class="d-flex" style='width:5%;font-size:12px;'>Cardápio
			<span style="display:contents;font-size:12px;">Físico</span>
		</span>
		<span class="d-flex" style='width:18%;font-size:12px;'>Categoria</span>
		<span class="d-flex" style='width:22%;font-size:12px;'>Produto</span>
		<div style="width:12%;font-size:12px;">
			<span class="d-flex" style='float:right;margin-right:6px;'>Preço Venda</span>
		</div>
		<span class="d-flex" style='width:8%;font-size:12px;'>Visível?</span>
		<span class="d-flex" style='width:8%;font-size:12px;'>Destaque?</span>
		<span class="d-flex" style='width:8%;font-size:12px;'>Prato Dia?</span>
		<span class="d-flex" style='width:8%;font-size:12px;'>Encomenda?</span>
		<span class="d-flex" style='width:10%;font-size:12px;'>Ações</span>
	</li>
	{{--dd($dataset)--}}
	@php
		$bkcolor = "style='padding:5px;'";
		$nomeCateg = "";
	@endphp

	@foreach ($dataset as $produto)

		@if ($nomeCateg == $produto->CatNome)
			<li class="list-group-item d-flex justify-content-between align-items-center" style='padding:5px;'>
		@else
			<li class="list-group-item d-flex justify-content-between align-items-center" style='padding:5px;background-color:#dfe5e9;'>
		@endif
			<span class="d-flex" style='width:5%;'>
				<input style="margin-right:3px;" type="checkbox" id="id_{{$produto->ProdId}}" name="produtos[]" value="{{$produto->ProdId}}" {{ ($produto->ProdVisivelCardapioFisico == 1) ? 'checked' : ''}}>{{$loop->iteration}}
			</span>
			<span class="d-flex" style='width:18%;font-size:12px;'>
				{{ $produto->CatNome }}
			</span>
			<span class="d-flex" style='width:22%;'>
				{{ $produto->ProdNome }}
			</span>
			@php
				$preco_venda = number_format($produto->ProdPrecoVenda,2,",",".");
			@endphp
			<div style="width:12%;" id="preco-{{$produto->ProdId}}">
				<span class="d-flex" style='float:right;margin-right:6px;'>
					{{$preco_venda}}
				</span>
			</div>
			<div class="input-group" style="width:12%;" hidden id="preco-novo-{{$produto->ProdId}}">
				<input type="text" style="height:31px;" id="input-preco-novo-{{$produto->ProdId}}" name="input-preco-novo-{{$produto->ProdId}}" class="form-control" value="{{$preco_venda}}">
				<div class="input-group-append">
					<a title="Salvar preço" class="btn btn-info btn-sm mr-2" onclick="salvarPreco('{{$produto->ProdId}}','{{$produto->ProdNome}}')"><i class="fas fa-check"></i></a>
				</div>
        	</div>
			<span class="d-flex" style='width:8%;padding: 0px 0px 0px 16px;'>{{ ($produto->ProdVisivel == 1) ? 'Sim' : 'Não'}}</span>
			<span class="d-flex" style='width:8%;padding: 0px 0px 0px 16px;'>{{ ($produto->ProdDestaque == 1) ? 'Sim' : 'Não'}}</span>
			<span class="d-flex" style='width:8%;padding: 0px 0px 0px 16px;'>{{ ($produto->ProdPratoDia == 1) ? 'Sim' : 'Não'}}</span>
			<span class="d-flex" style='width:8%;padding: 0px 0px 0px 16px;'>{{ ($produto->ProdEncomenda == 1) ? 'Sim' : 'Não'}}</span>

			<span class="d-flex" style='width:10;'>
				<a title="Alterar preço"   class="btn btn-info    btn-sm mr-2" onclick="toggleInput('{{$produto->ProdId}}')">                           <i class="fas fa-pen-alt"></i></a>
				<a title="Alterar produto" class="btn btn-primary btn-sm mr-2" onclick="chamaEditar('{{$produto->ProdId}}');">                          <i class="fas fa-edit"></i></a>
				<a title="Excluir produto" class="btn btn-danger  btn-sm mr-2" onclick="chamaExcluir('{{$produto->ProdId}}','{{$produto->ProdNome}}');"><i class="fas fa-trash-alt"></i></a>
			</span>
		</li>
		@php
			$nomeCateg = $produto->CatNome;
		@endphp
	@endforeach
	@if (count($dataset) == 0)
		<li>
			<div style="text-align:center;">
				<span style='width:18%;font-size:20px;'>
					Nenhum produto encontrado.
				</span>
			</div>
		</li>
	@endif
</ul>
	<input type="hidden" id="tipo_pdf" name="tipo_pdf" value=""/>
</form>

<form id="formEditar" name='formEditar' method="get" action="{{route('form_edit_produto_old')}}">
	<input type="hidden" id="idEditar" name="id" value=""/>
	<input type="hidden" id="EDcategoria_id_pesq" name="categoria_id_pesq" value=""/>
	<input type="hidden" id="EDnome_pesq" name="nome_pesq" value=""/>
</form>

<form id="formExcluir" name='formExcluir' method="get" action="{{route('form_remover_produto')}}">
	<input type="hidden" id="idExcluir" name="id" value=""/>
	<input type="hidden" id="EXcategoria_id_pesq" name="categoria_id_pesq" value=""/>
	<input type="hidden" id="EXnome_pesq" name="nome_pesq" value=""/>
</form>

<form id="formPreco" name='formPreco' method="post" action="{{route('form_update_preco_produto')}}">
	@csrf
	<input type="hidden" id="idPreco"     name="id" value=""/>
	<input type="hidden" id="preco_venda" name="preco_venda" value=""/>
	<input type="hidden" id="nome"        name="nome" value=""/>
</form>

<script>
	function chamaEditar(id) {
		document.getElementById("idEditar").value = id;
		document.getElementById("EDcategoria_id_pesq").value = document.getElementById("categoria_id_pesq").value;
		document.getElementById("EDnome_pesq").value = document.getElementById("nome_pesq").value;
		document.getElementById('formEditar').submit();
	}
	function chamaExcluir(id,produto) {
		document.getElementById("idExcluir").value = id;
		if (confirm('Confirma a remoção do produto: ' + produto + '?') == true) {
			document.getElementById('formExcluir').submit();
		}
	}
	function salvarPreco(id,nome) {
		document.getElementById("idPreco").value = id;
		document.getElementById("preco_venda").value = document.getElementById("input-preco-novo-"+id).value;
		document.getElementById("nome").value = nome;
		document.getElementById('formPreco').submit();
	}
	function cardapio() {
		document.getElementById("form_pdf").target = "_blank";
		document.getElementById("tipo_pdf").value = "gerar_cardapio";
		document.getElementById('form_pdf').submit();
	}
	function listagem_produtos() {
		document.getElementById("form_pdf").target = "_blank";
		document.getElementById("tipo_pdf").value = "listar_produto";
		document.getElementById('form_pdf').submit();
	}

    function toggleInput(id) {
        const preco = document.getElementById('preco-' + id);
        const preco_novo = document.getElementById('preco-novo-' + id);
        if (preco.hasAttribute('hidden')) {
            preco.removeAttribute('hidden');
            preco_novo.hidden = true;
        } else {
            preco_novo.removeAttribute('hidden');
            preco.hidden = true;
        }
    }

    function chamaLimpar() {
		document.getElementById("categoria_id_pesq").value = "";
		document.getElementById("nome_pesq").value = "";
    }
</script>
@endsection