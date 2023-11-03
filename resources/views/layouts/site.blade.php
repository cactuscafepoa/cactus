<!DOCTYPE HTML>
<html lang="pt-br"> <!--xmlns="http://www.w3.org/1999/xhtml"-->
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MTXRMLSH');</script>
<!-- End Google Tag Manager -->

    <title>Cactus Café</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>-->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--<meta name="theme-color" content="Blue"/>-->
    <meta name="description" content="Página comercial do Cactus Café Poa"/>
    <!--<meta name="author" itemprop="MMPX"/>-->

    <!-- Adicionar Favicon em todas as versões -->
    <link rel="shortcut icon" href="#" type="image/x-icon">
    <link rel="icon" href="#" type="image/x-icon">

    <!-- Tags facebook -->
    <!--
    <meta property="og:locale" content="pt_BR"/>
    <meta property="og:url" content="virundum"/>
    <meta property="og:title"
          content="Vortexs sunt byssuss de placidus visus. Potus diligenter ducunt ad alter navis. ">
    <meta property="og:site_name" content="Candidatus ">
    <meta property="og:description"
          content="Ubi est albus pars? Cum mortem favere, omnes habitioes promissio grandis, dexter elevatuses. ">
    <meta property="og:type" content="website"/>
-->
    <!-- Links & Scripts -->
    <link rel="stylesheet" href="{{URL::asset('css/nbc5nyh.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('css/app_site.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('css/personal.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('css/toastr.min.css')}}"/>

    <!--@toastr_css-->

    <link id="favicon" rel="shortcut icon" href="{{URL::asset('images/Frame.svg')}}" sizes="16x16" type="image/svg">
    <!--<link id="favicon" rel="shortcut icon" href="{{URL::asset('images/Frame.svg')}}" sizes="32x32" type="image/svg">
    <link id="favicon" rel="shortcut icon" href="{{URL::asset('images/Frame.svg')}}" sizes="48x48" type="image/svg">-->

    <link rel="apple-touch-icon" sizes="48x48" href="{{URL::asset('images/Frame.svg')}}">
    <!--<link rel="apple-touch-icon" sizes="72x72" href="{{URL::asset('images/Frame.svg')}}">
    <link rel="apple-touch-icon" sizes="96x96" href="{{URL::asset('images/Frame.svg')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{URL::asset('images/Frame.svg')}}">
    <link rel="apple-touch-icon" sizes="192x192" href="{{URL::asset('images/Frame.svg')}}">
    <link rel="apple-touch-icon" sizes="256x256" href="{{URL::asset('images/Frame.svg')}}">
    <link rel="apple-touch-icon" sizes="384x384" href="{{URL::asset('images/Frame.svg')}}">
    <link rel="apple-touch-icon" sizes="512x512" href="{{URL::asset('images/Frame.svg')}}">-->

    <!-- Lightbox MENU CABEÇALHO -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('lightbox/css/lightbox.css')}}"/>
</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MTXRMLSH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<nav style="padding:0px;">

    <div class="main-wrapper">

        <div class="flex-container" style="float:left;">
            <a href="{{route('site.home')}}">
                <!--<img src="{{URL::asset('images/logo.svg')}}">-->
                <img style="max-width: 70%;margin-top: 10px;" src="{{URL::asset('images/so_cactus_verde.png')}}">
            </a>
        </div>

        <div class="flex-container">

            <ul class="navigation__itens" id="menu" style="margin-top: 25px;">
                <li>
                    <a class='decor_text_menu' style="font-size:1.5rem;color:#31a575" href="{{route('site.home')}}">Início
                        <span class="border-effect" style="color:#31a575;"></span>
                    </a>
                </li>
                <li>
                    <a class='decor_text_menu' style="font-size:1.5rem;color:#31a575" href="{{route('site.cardapio')}}">Cardápio
                        <span class="border-effect"></span>
                    </a>
                </li>

                <li>
                    <a class='decor_text_menu' style="font-size:1.5rem;color:#31a575" href="{{route('site.encomendas')}}">Encomendas
                        <span class="border-effect"></span>
                    </a>
                </li>

                <li>
                    <a class='decor_text_menu' style="font-size:1.5rem;color:#31a575" href="{{route('site.evento')}}">Eventos
                        <span class="border-effect"></span>
                    </a>
                </li>

                <!--
                <li>
                    <a class='decor_text_menu' style="font-size:1.5rem;" href="{{route('site.blog')}}">Blog
                        <span class="border-effect"></span>
                    </a>
                </li>-->
                <li>
                    <a class='decor_text_menu' style="font-size:1.5rem;color:#31a575" href="{{route('site.horario')}}">Atendimento
                        <span class="border-effect"></span>
                    </a>
                </li>
                <li>
                    <a class='decor_text_menu' style="font-size:1.5rem;color:#31a575" href="{{route('site.sobre')}}">Sobre
                        <span class="border-effect"></span>
                    </a>
                </li>
                <li>
                    <a class='decor_text_menu' style="font-size:1.5rem;color:#31a575" href="{{route('site.contato')}}">Contato
                        <span class="border-effect"></span>
                    </a>
                </li>
            </ul>
            <!-- Hamburger menu -->
            <div id="toggle" style="margin-top: 75px;">
                <div class="span" id="one"></div>
                <div class="span" id="two"></div>
                <div class="span" id="three"></div>
            </div>
        </div>

    </div>
</nav>

<!-- Hamburger menu list -->
<div id="resize" style="background-color:#67cb76;">
    <ul id="menu" style="padding-left: initial;">
        <li><a class="title-medium decor_text_menu" href="{{route('site.home')}}">Início</a></li>
        <li><a class="title-medium decor_text_menu" href="{{route('site.cardapio')}}">Cardápio</a></li>
        <li><a class="title-medium decor_text_menu" href="{{route('site.encomendas')}}">Encomendas</a></li>
        <li><a class="title-medium decor_text_menu" href="{{route('site.evento')}}">Eventos</a></li>
        <!--<li><a class="title-medium decor_text_menu" href="{{route('site.blog')}}">Blog</a></li>-->
        <li><a class="title-medium decor_text_menu" href="{{route('site.horario')}}">Atendimento</a></li>
        <li><a class="title-medium decor_text_menu" href="{{route('site.sobre')}}">Sobre</a></li>
        <li><a class="title-medium decor_text_menu" href="{{route('site.contato')}}">Contato</a></li>
    </ul>
</div>

@yield('content')

<footer class="main_footer" style="padding: 10px 0px 0px 0px;border-top: solid 1px #d1d9e0;">
    <div class="main-wrapper flex-container" style="display:initial;">
        <ul style="justify-content: space-evenly;margin-bottom:initial;padding-left:0px;">
            <li class="footer__links">
                <h4 class="title-small">Siga-nos</h4>
                <a class="decor_text_menu" href="https://www.instagram.com/cactuscafepoa/" target="_blank">Instagram Cactus Café Poa</a>
                <a class="decor_text_menu" href="https://www.instagram.com/lifazendoarte/" target="_blank">Instagram Li Fazendo Arte</a>
            </li>
            <li class="footer__links">
                <h4 class="title-small">Empresa</h4>
                <a class="decor_text_menu" href="{{route('site.sobre')}}">Sobre nós</a>
                <a class="decor_text_menu" href="{{route('site.contato')}}">Entre em contato</a>
            </li>
            <li class="footer__links">
                <h4 class="title-small">Contatos</h4>
                <a class="decor_text_menu" title="Clique no número do telefone para ligar" href="tel:5130195922">Telefone</a>
                <a class="decor_text_menu" title="Clique no email para enviar email automático" href="mailto:cactuscafepoa@gmail.com">Email</a>
            </li>

        </ul>

    </div>
</footer>

<section class="sub__footer" style="padding: 15px 0px 0px 0px;">
    <div class="main-wrapper flex-container">
        <a href="{{route('dashboard')}}" target="_blank"><img src="{{URL::asset('images/Lock-icon.svg')}}"></a>
        <p style='font-size:0.9rem;'>Rua Felipe Neri, 461 Loja 101 - Bairro Auxiliadora, Porto Alegre - RS, 90.440-150.</p>
        <div>
            <!--<a href="http://mmpx.com.br/" target="_blank">Deisgn by <strong>MMPX</strong></a>-->
            <p style='font-size: 0.8rem;'>Cactus Café Poa &copy;2023</p>
        </div>
    </div>
</section>

</body>


<!-- Scripts -->
<script type="text/javascript" src="{{URL::asset('js/jquery-3.6.0.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('lightbox/js/lightbox.js')}}"></script>

<!--@toastr_js-->
<!--@toastr_render -->

<script>
    $("#toggle").click(function () {
        $(this).toggleClass("on")
        $("#resize").toggleClass("active")
    })
</script>
</html>