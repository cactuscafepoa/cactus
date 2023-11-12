<!DOCTYPE html>
<html lang="pt-br">
<head>
	<style>
		body {
			font-family: monospace;
			font-size: 14px;
			padding:20px;
		}
		.categoria {
			font-size:16px;
			font-weight:bolder;
			letter-spacing:6px;
		}
	</style>
</head>
<body style="padding:0px;margin:0px;">

@php
	$imagePathCab = public_path('images/cabecalho.png');
	$imagemCab = '<img src="data:image/png;base64,'.base64_encode(file_get_contents($imagePathCab)).'" style="width:100%;">';
	$cabecalho = "<div id='DivCabecalho' style='width:100%;text-align:center;'>" . $imagemCab . "</div>";
@endphp

	@php
		$nomeCat = "";
		echo "<div id='moldura' style='height:240mm;'>";
		echo $cabecalho;
	@endphp

		<h1>Listagem de produtos</h1>
		<div>
			<table border='0' cellspacing="2" cellpadding="2" style="width:100%;">
				<tr>
					<td style="width:100%;height:1px;background-color:#dfe5e9" colspan="3"></td>
				</tr>
				@foreach ($dataset as $item)
					@if ($nomeCat != $item->CatNome)
						<tr style="height:20px;">
							<td style="width:45%;text-align:center;" bgcolor="#dfe5e9" colspan="3">
								<span class="categoria">{{$item->CatNome}}</span>
							</td>
						</tr>
					@endif
					@php
						$nomeCat = $item->CatNome;
					@endphp
					<tr>
						<td style="width:75%;height:16px;" colspan="3">
							<strong>Nome:</strong> {{$item->ProdNome}}
						</td>
					</tr>
					<tr>
						<td style="width:75%;height:16px;" colspan="3">
							<strong style="{{($item->ProdDesc != '') ? '' : 'color:red;'}}">Descrição:</strong> {{$item->ProdDesc}}
						</td>
					</tr>
					<tr>
						<td style="width:25%;height:16px;">
							<strong>Preço venda:</strong> {{ number_format($item->ProdPrecoVenda,2,",","."); }}
						</td>
						<td style="width:25%;height:16px;">
							<strong>Preço compra:</strong> {{ number_format($item->ProdPrecoCompra,2,",","."); }}
						</td>
						<td style="width:50%;height:16px;">
							<strong>Prato do dia:</strong> {{($item->ProdPratoDia == '0') ? 'Nâo' : 'Sim'}}
						</td>
					</tr>
					<tr>
						<td style="width:50%;height:16px;">
							<strong>Visível no site:</strong> {{($item->ProdVisivel == '0') ? 'Nâo' : 'Sim'}}
						</td>
						<td style="width:50%;height:16px;" colspan="2">
							<strong>Visível cardápio físico:</strong> {{($item->ProdVisivelCardFisico == '0') ? 'Nâo' : 'Sim'}}
						</td>
					</tr>
					<tr>
						<td style="width:50%;height:16px;">
							<strong>Encomenda:</strong> {{($item->ProdEncomenda == '0') ? 'Nâo' : 'Sim'}}
						</td>
						<td style="width:50%;height:16px;">
							<strong>Preço encomenda:</strong> {{ number_format($item->ProdEncomendaPrecVenda,2,",",".") }}
						</td>
					</tr>
					<tr>
						<td style="width:50%;height:16px;" cospan="3">
							<strong style="{{($item->ProdImagem != 'sem_imagem.gif') ? '' : 'color:red;'}}">Imagem:</strong> {{($item->ProdImagem != 'sem_imagem.gif') ? 'Sim' : 'Não'}}
						</td>
					</tr>
					<tr>
						<td style="width:100%;height:1px;background-color:#dfe5e9" colspan="3"></td>
					</tr>
				@endforeach
			</table>
		</div> <!--FECHA A COLUNA -->
	</div>
	<div style='float:right;margin-top:10px;font-size:10px;'>{{date("d/m/Y")}}</div>
</body>
</html>