@extends('dashboard')

@section('cabecalho')
Relação de Produtos
@endsection

@section('conteudo')
 @if(!empty($mensagem))
<div class="alert alert-success mt-3">
	{{$mensagem}}
</div>
@endif


<form name='form_pdf' id='form_pdf' method="post" action="{{route('pdf_produto_envia')}}">
	@csrf

<div class="d-flex justify-content-between">
	<a href="{{route('form_edit_produto_new')}}" class="btn btn-primary mt-2 mb-2">Adicionar Produto</a>

	<a class="btn btn-primary mt-2 mb-2" onclick="cardapio();">Gerar Cardápio Físico (só assinalados)</a>

	<a href="{{route('dashboard')}}" class="btn btn-primary mt-2 mb-2">Voltar</a>
</div>

<ul class="list-group">
	<li class="list-group-item d-flex justify-content-between align-items-center bg-secondary text-white" style="height:48px;padding:5px;">
		<span class="d-flex" style='width:5%;font-size:12px;'>
			Cardápio
			<span style="display:contents;font-size:12px;">Físico</span>
		</span>
		<span class="d-flex" style='width:18%;font-size:12px;'>
			Categoria
		</span>
		<span class="d-flex" style='width:22%;font-size:12px;'>
			Produto
		</span>
		<div style="width:12%;font-size:12px;">
			<span class="d-flex" style='float:right;margin-right:6px;'>
				Preço Venda
			</span>
		</div>
		<span class="d-flex" style='width:8%;font-size:12px;'>
			Visível?
		</span>
		<span class="d-flex" style='width:8%;font-size:12px;'>
			Destaque?
		</span>
		<span class="d-flex" style='width:8%;font-size:12px;'>
			Prato Dia?
		</span>
		<span class="d-flex" style='width:8%;font-size:12px;'>
			Encomenda?
		</span>
		<span class="d-flex" style='width:10%;font-size:12px;'>
			Ações
		</span>
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
</ul>

</form>

<form id="formEditar" name='formEditar' method="get" action="{{route('form_edit_produto_old')}}">
	<input type="hidden" id="idEditar" name="id" value=""/>
</form>

<form id="formExcluir" name='formExcluir' method="get" action="{{route('form_remover_produto')}}">
	<input type="hidden" id="idExcluir" name="id" value=""/>
	<!--<input type="hidden" id="ProdNomeExcluir" name="ProdNome" value=""/>-->
</form>

<form id="formPreco" name='formPreco' method="post" action="{{route('form_update_preco_produto')}}">
	@csrf
	<input type="hidden" id="idPreco" name="id" value=""/>
	<input type="hidden" id="preco_venda" name="preco_venda" value=""/>
	<input type="hidden" id="nome" name="nome" value=""/>
</form>

<script>
	function chamaEditar(id) {
		document.getElementById("idEditar").value = id;
		document.getElementById('formEditar').submit();
	}
	function chamaExcluir(id,produto) {
		document.getElementById("idExcluir").value = id;
		//document.getElementById("ProdNomeExcluir").value = produto;
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
</script>
@endsection