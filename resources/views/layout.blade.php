<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<title>Cactus Café</title>

<link href="{{ URL::asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
<link href="{{ URL::asset('css/bootstrap/_variables.scss') }}" rel="stylesheet" crossorigin="anonymous">
<link href="{{ URL::asset('css/fontawesome/all.min.css') }}" rel="stylesheet" crossorigin="anonymous">

</head>
<body>
	<div class="container">	
		<div class="bg-secondary opacity-50 p-3 text-white">
			<h1>@yield('cabecalho')</h1>
    	</div>  
		@yield('conteudo')		
	</div>	
</body>	
</html>