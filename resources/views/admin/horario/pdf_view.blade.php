<!DOCTYPE html>
<html lang="pt-br">
<head>
<style>
	body {
		font-family: monospace;
    	font-size: 14px;
		padding:60px;
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

	<div style="text-align:center;">
		<h1 style="font-size:20px;padding:0px;margin:0px;">Horário de atendimento</h1>
	</div>

	<div style="padding:0px;margin:0px;">
		<p style='font-size:16px;'>{{ $dataset[0]->aviso}}</p>
		<p style='font-size:16px;'>{{ $dataset[0]->atendimento_fisico}}</p>
		<p style='font-size:16px;'>{{ $dataset[0]->atendimento_encomendas}}</p>
	</div>

	<table border='0' cellspacing="0" cellpadding="5" style="width:100%;">
		@php
			$background = "style=background-color:#ebebeb";
		@endphp
		@foreach ($dataset as $horario)

			<tr {{$background}}>
				<td style='width:25%;'><span style='font-size:30px;'>{{ $horario->dia_semana}}</span></td>
				<td style='width:25%;'><span style='font-size:30px;'>{{ $horario->aberto}}</span></td>
				<td style='width:25%;'><span style='font-size:30px;'>{{ $horario->hora_abre}}</span></td>
				<td style='width:25%;'><span style='font-size:30px;'>{{ $horario->hora_fecha}}</span></td>
			</tr>
			@php
				if ($background == "")
					$background = "style=background-color:#ebebeb";
				else
					$background = "";
			@endphp
		@endforeach
	</table>
</body>
</html>