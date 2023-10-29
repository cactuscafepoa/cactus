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

	#leftbox {
		float:left;
		/*background:Red;*/
		width:48%;
		/*height:280px;*/
	}
	#rightbox{
		float:right;
		/*background:blue;*/
		width:48%;
		/*height:280px;*/
	}
	.page_break {
		page-break-before: always;
	}
	</style>
  </head>
<body style="padding:0px;margin:0px;">
@php
	$imagePathCab = public_path('images/cabecalho.png');
	$imagemCab = '<img src="data:image/png;base64,'.base64_encode(file_get_contents($imagePathCab)).'" style="width:100%;">';

	$cabecalho = "<div id='DivCabecalho' style='width:100%;text-align:center;'>" . $imagemCab . "</div>";
	$cabecalhoPBreak = "<div class='page_break' id='DivCabecalho' style='width:100%;text-align:center;'>" . $imagemCab . "</div>";
	$rodape = "<div style='float:right;margin-top:10px;font-size:10px;'>" . date("d/m/Y") . "</div>";
@endphp

@for ($i = 0; $i < $qtdArrays; $i++)
	@php
		$nomeCat = "";
		if ($i == 0 || $i == 2 || $i == 4 || $i == 6 || $i == 8) {
			// INSERE CABEÇALHO
			if ($i == 0) echo $cabecalho; else echo $cabecalhoPBreak;
			$posicaoDiv = "leftbox";
			echo "<div id='moldura' style='height:240mm;'>";
		}
		else {
			$posicaoDiv = "rightbox";
		}
	@endphp
		<div id ="{{$posicaoDiv}}">
			<table border='0' cellspacing="0" cellpadding="0" style="width:100%;">
				@foreach ($dataset[$i] as $item)
					@if ($nomeCat != $item->CatNome)
						<tr style="height:20px;">
							<td style="width:45%;text-align:center;" bgcolor="#dfe5e9" colspan="2">
								<span class="categoria">{{$item->CatNome}}</span>
							</td>
						</tr>
					@endif
					@php
						$nomeCat = $item->CatNome;
					@endphp
					<tr>
						<td style="width:75%;height:16px;">
							{{$item->ProdNome}}
						</td>
						<td style="width:25%;text-align:right;height:16px;">
							{{ number_format($item->ProdPrecoVenda,2,",","."); }}
						</td>
					</tr>
				@endforeach
			</table>
		</div> <!--FECHA A COLUNA -->
	@php
	if (	 $qtdArrays == 1 ||
		   ( $qtdArrays == 2 &&  $i+1 == 2) ||
		   ( $qtdArrays == 3 && ($i+1 == 2 || $i+1 == 3) ) ||
		   ( $qtdArrays == 4 && ($i+1 == 2 || $i+1 == 4) ) ||
		   ( $qtdArrays == 5 && ($i+1 == 2 || $i+1 == 4 || $i+1 == 5) ) ||
		   ( $qtdArrays == 6 && ($i+1 == 2 || $i+1 == 4 || $i+1 == 6) ) ||
		   ( $qtdArrays == 7 && ($i+1 == 2 || $i+1 == 4 || $i+1 == 6 || $i+1 == 7) ) ||
		   ( $qtdArrays == 8 && ($i+1 == 2 || $i+1 == 4 || $i+1 == 6 || $i+1 == 8) ) ||
		   ( $qtdArrays == 9 && ($i+1 == 2 || $i+1 == 4 || $i+1 == 6 || $i+1 == 8 || $i+1 == 9) )
		) {
		echo "</div>";  // FECHA MOLDURA
		echo $rodape;
	}
	@endphp
@endfor
</body>
</html>