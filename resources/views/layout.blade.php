<!DOCTYPE html>
<html>
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MTXRMLSH');</script>
<!-- End Google Tag Manager -->
<meta charset="UTF-8"/>
<title>Cactus Café</title>

<link href="{{ URL::asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
<link href="{{ URL::asset('css/bootstrap/_variables.scss') }}" rel="stylesheet" crossorigin="anonymous">
<link href="{{ URL::asset('css/fontawesome/all.min.css') }}" rel="stylesheet" crossorigin="anonymous">

</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MTXRMLSH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<div class="container">
		<div class="bg-secondary opacity-50 p-3 text-white">
			<h1>@yield('cabecalho')</h1>
    	</div>
		@yield('conteudo')
	</div>
</body>
</html>