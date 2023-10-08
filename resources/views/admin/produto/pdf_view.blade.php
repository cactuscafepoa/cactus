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
            /*#middlebox{
                float:left;
                background:#000000;
                width:1%;
                height:280px;
            }*/
            #rightbox{
                float:right;
                /*background:blue;*/
                width:48%;
                /*height:280px;*/
            }

	</style>

  </head>
<body>

	@php
	$imagePathCab = public_path('images/cabecalho.png');
	$imagemCab = '<img src="data:image/png;base64,'.base64_encode(file_get_contents($imagePathCab)).'" style="width:100%;">';
	@endphp

	<div id="DivCabecalho" style="width:100%;text-align:center;margin-bottom:0px;margin-top:-40px;">
		@php
			echo $imagemCab;
			$nomeCat = "";
		@endphp
	</div>

	<div id = "leftbox">
		<table border='0' cellspacing="0" cellpadding="0" style="width:100%;">

			@foreach ($dataset as $item)

				@php
					if ($loop->iteration >= 44) {
						$dataset = $dataset->slice($loop->index);
						break;
					}
				@endphp

				@if ($nomeCat !=  $item->CatNome)
					<tr style="height:20px;">
						<td style="width:45%;text-align:center;border-bottom:1px solid #9e9e9e;padding-top:20px;" colspan="2">
							<span class="categoria">{{$item->CatNome}}</span>
						</td>
					</tr>
				@endif

				@php
					$nomeCat =  $item->CatNome;
				@endphp

					<tr>
						<td style="width:75%">
							{{$item->ProdNome}}
						</td>
						<td style="width:25%;text-align:right;">
							{{ number_format($item->ProdPrecoVenda,2,",","."); }}
						</td>
					</tr>
			@endforeach

		</table>
	</div>


	<div id = "rightbox">
		<table border='0' cellspacing="0" cellpadding="0" style="width:100%;">

			{{--dd($dataset);--}}
			@php
				$nomeCat = "";
			@endphp
			@foreach ($dataset as $item)

				@php
					if ($loop->iteration >= 44) {
						$dataset = $dataset->slice($loop->index);
						break;
					}
				@endphp

				@if ($nomeCat !=  $item->CatNome)
					<tr style="height:20px;">
					<td style="width:45%;text-align:center;border-bottom:1px solid #9e9e9e;padding-top:20px;" colspan="2">
							<span class="categoria">{{$item->CatNome}}</span>
						</td>
					</tr>
				@endif
				@php
					$nomeCat =  $item->CatNome;
				@endphp
					<tr>
						<td style="width:75%">
							{{$item->ProdNome}}
						</td>
						<td style="width:25%;text-align:right;">
							{{ number_format($item->ProdPrecoVenda,2,",","."); }}
						</td>
					</tr>
			@endforeach

		</table>
	</div>

</body>
</html>