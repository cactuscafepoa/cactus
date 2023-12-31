@extends('layouts.site')

@section('content')
<header>

    <div class="hero">
        @if ($configuracao[0]->pagina_inicial)
            <div class="main-wrapper">
                <div class="hero__content">
                    <h1 class="display-large" style="color:#79e18b;">{{$configuracao[0]->pagina_inicial_titulo}}</h1>
                    <p style="color:#79e18b;background:rgb(0,0,0);opacity:0.6;border-radius:50px;padding:10px;">{{$configuracao[0]->pagina_inicial_texto}}</p>
                    <!-- CONFIGURAÇÃO DO BOTÃO DA PÁGINA INICIAL  -->
                    @if ($configuracao[0]->botao_inicial == "cardapio")
                        <a href="{{route('site.cardapio')}}" role="button" class="button button_accent button_large">Cardápio</a>
                    @elseif ($configuracao[0]->botao_inicial == "pratos")
                        <a href="{{route('site.refeicoes')}}" role="button" class="button button_accent button_large">{{$configuracao[0]->prato_dia_botao}}</a>
                    @elseif ($configuracao[0]->botao_inicial == "encomendas")
                        <a href="{{route('site.encomendas')}}" role="button" class="button button_accent button_large">Encomendas</a>
                    @elseif ($configuracao[0]->botao_inicial == "novidades")
                        <a href="{{route('site.novidades')}}" role="button" class="button button_accent button_large">Novidades</a>
                    @endif
<!--
                        <span style="color:#79e18b;font-size:1rem;padding:5px;opacity:0.6;">Cafeteria</span>
                        <span style="color:#79e18b;font-size:1rem;padding:5px;opacity:0.6;">Confeitaria</span>
                        <span style="color:#79e18b;font-size:1rem;padding:5px;opacity:0.6;">Eventos</span>
                        <span style="color:#79e18b;font-size:1rem;padding:5px;opacity:0.6;">Encomendas</span>
-->
                </div>
            </div>
        @endif
    </div>

</header>

<!--<section class="category gray-background" style="padding:0px;background-image: linear-gradient(#d2dfed,#204265);padding:145px 0px 145px 0px;">-->
<section class="category gray-background" style="background-color:#94C973;padding:20px 0px 20px 0px;">
    <div class="main-wrapper flex-container">

        <section class="cultivation__category">
            <!--<picture>
                <source media="(max-width: 768px)" srcset="./images/fundo_transparente_botoes_capa.png">
                <img src="{{asset('images/fundo_transparente_botoes_capa.png')}}" alt="" width="297" height="447">
            </picture>-->
            <div class="infos__category" style="max-width:330px;margin:10px;position:initial;">
                <h2 class="title-large"><strong>Cardápio</strong></h2>
                <hr class="thick_divider">
                <p style="color:#8a99a8;">Veja todas as opções do nosso cardápio.</p>
                <a href="{{route('site.cardapio')}}" role="button" class="button button_accent button_large">Cardápio</a>
            </div>
        </section>

    @php
    if ($configuracao[0]->prato_dia) {
        $tituloDelicia = "Produtos do dia";
        if (!is_null($configuracao[0]->prato_dia_botao) && $configuracao[0]->prato_dia_botao != "")
            $tituloDelicia = $configuracao[0]->prato_dia_botao;
        @endphp
        <section class="cultivation__category">
            <!--<picture>
                <source media="(max-width: 768px)" srcset="{{asset('images/fundo_transparente_botoes_capa.png')}}">
                <img src="{{asset('images/fundo_transparente_botoes_capa.png')}}" alt="" width="297" height="447">
            </picture>-->
            <div class="infos__category" style="max-width:330px;margin:10px;position:initial;">
                <h2 class="title-large"><strong>{{ $tituloDelicia }}</strong></h2>
                <hr class="thick_divider">
                <p style="color:#8a99a8;">{{ $configuracao[0]->prato_dia_botao_texto }}</p>
                <a href="{{route('site.refeicoes')}}" role="button" class="button button_accent button_large">{{$tituloDelicia}}</a>
            </div>
        </section>
    @php } @endphp

    @php
    if ($configuracao[0]->novidades) { @endphp
        <section class="cultivation__category">
            <!--<picture>
                <source media="(max-width: 768px)" srcset="{{asset('images/fundo_transparente_botoes_capa.png')}}">
                <img src="{{asset('images/fundo_transparente_botoes_capa.png')}}" alt="" width="297" height="447">
            </picture>-->
            <div class="infos__category" style="max-width:330px;margin:10px;position:initial;">
                <h2 class="title-large"><strong>Novidades</strong></h2>
                <hr class="thick_divider">
                <p style="color:#8a99a8;">Novidades e destaques do Cactus Café Poa.</p>
                <a href="{{route('site.destaques')}}" role="button" class="button button_accent button_large">Novidades</a>
            </div>
        </section>
    @php } @endphp

    @php
    if ($configuracao[0]->encomendas) { @endphp
        <section class="cultivation__category">
            <!--<picture>
                <source media="(max-width: 768px)" srcset="{{asset('images/fundo_transparente_botoes_capa.png')}}">
                <img src="{{asset('images/fundo_transparente_botoes_capa.png')}}" alt="" width="297" height="447">
            </picture>-->
            <div class="infos__category" style="max-width:330px;margin:10px;position:initial;">
                <h2 class="title-large"><strong>Encomendas</strong></h2>
                <hr class="thick_divider">
                <p style="color:#8a99a8;">Saiba como realizar encomendas.</p>
                <a href="{{route('site.encomendas')}}" role="button" class="button button_accent button_large">Encomendas</a>
            </div>
        </section>
    @php } @endphp

    </div>
</section>

<section class="blog" style="padding: 10px 0px 10px 0px;background-color: #768947;background-image: url(../images/so_cactus_verde.png);">
    <div class="main-wrapper">
        <div class="blog__container">
            <div class="blog__introduction" style="text-align:initial;height:initial;margin-top: 15px;background-image: url(../images/depoimentos/guardanapo.png);background-size: 100% 100%;padding: 5px;">
                <h2 class="title-large" style="color: #8a99a8;font-family: auto;font-size: 1.5rem;font-weight: bold;">Minha gratidão à <strong>"Family"</strong>, fonte de inspiração e coragem.</h2>
                <p style="padding:5px 0px 0px 0px;color: #8a99a8;font-family: auto;font-size: 1.3rem;">Aos amigos, pelo incentivo e apoio nessa nova jornada que inicio.</p>
            </div>

            <article class="card__post" style="height:initial;margin-top:15px;">
                <a href="javascript:;">
                    <div class="post__cover" style="max-height: initial;overflow: initial;">
                        <img src="{{asset('images/depoimentos/mariana.png')}}">
                    </div>
                    <header class="card__post__header" style="padding: 0px 0px 0px 10px;">
                        <time class="post__date" style="position: initial;" datetime="2019-03-29">Mariana</time>
                        <!--<h3 class="body-large">Fidelis, dexter fortiss mechanice consumere de teres, germanusabactor.</h3>-->
                    </header>
                </a>
            </article>

            <article class="card__post" style="height:initial;margin-top:15px;">
                <a href="javascript:;">
                    <div class="post__cover" style="max-height: initial;overflow: initial;">
                        <img src="{{asset('images/depoimentos/luiza.png')}}">
                    </div>
                    <header class="card__post__header" style="padding: 0px 0px 0px 10px;">
                        <time class="post__date" style="position: initial;" datetime="2019-03-29">Luiza</time>
                        <!--<h3 class="body-large">Castus danista vix examinares cursus est. </h3>-->
                    </header>
                </a>
            </article>

            <article class="card__post" style="height:initial;margin-top:15px;">
                <a href="javascript:;">
                    <div class="post__cover" style="max-height: initial;overflow: initial;">
                        <img src="{{asset('images/depoimentos/raquel.png')}}">
                    </div>
                    <header class="card__post__header" style="padding: 0px 0px 0px 10px;">
                        <time class="post__date" style="position: initial;" datetime="2019-03-29">Raquel</time>
                        <!--<h3 class="body-large">Prarere superbe ducunt ad fidelis homo. </h3>-->
                    </header>
                </a>
            </article>

            <article class="card__post" style="height:initial;margin-top:15px;">
                <a href="javascript:;">
                    <div class="post__cover" style="max-height: initial;overflow: initial;">
                        <img src="{{asset('images/depoimentos/juliana.png')}}">
                    </div>
                    <header class="card__post__header" style="padding: 0px 0px 0px 10px;">
                        <time class="post__date" style="position: initial;" datetime="2019-03-29">Juliana</time>
                        <!--<h3 class="body-large">Prarere superbe ducunt ad fidelis homo. </h3>-->
                    </header>
                </a>
            </article>

            <article class="card__post" style="height:initial;margin-top:15px;">
                <a href="javascript:;">
                    <div class="post__cover" style="max-height: initial;overflow: initial;">
                        <img src="{{asset('images/depoimentos/lourdes.png')}}">
                    </div>
                    <header class="card__post__header" style="padding: 0px 0px 0px 10px;">
                        <time class="post__date" style="position: initial;" datetime="2019-03-29">Lourdes</time>
                        <!--<h3 class="body-large">Prarere superbe ducunt ad fidelis homo. </h3>-->
                    </header>
                </a>
            </article>

            <article class="card__post" style="height:initial;margin-top:15px;">
                <a href="javascript:;">
                    <div class="post__cover" style="max-height: initial;overflow: initial;">
                        <img src="{{asset('images/depoimentos/mateus.png')}}">
                    </div>
                    <header class="card__post__header" style="padding: 0px 0px 0px 10px;">
                        <time class="post__date" style="position: initial;" datetime="2019-03-29">Mateus</time>
                        <!--<h3 class="body-large">Castus danista vix examinares cursus est. </h3>-->
                    </header>
                </a>
            </article>

            <article class="card__post" style="height:initial;margin-top:15px;">
                <a href="javascript:;">
                    <div class="post__cover" style="max-height: initial;overflow: initial;">
                        <img src="{{asset('images/depoimentos/edson.png')}}">
                    </div>
                    <header class="card__post__header" style="padding: 0px 0px 0px 10px;">
                        <time class="post__date" style="position: initial;" datetime="2019-03-29">Edson</time>
                        <!--<h3 class="body-large">Castus danista vix examinares cursus est. </h3>-->
                    </header>
                </a>
            </article>

            <article class="card__post" style="height:initial;margin-top:15px;">
                <a href="javascript:;">
                    <div class="post__cover" style="max-height: initial;overflow: initial;">
                        <img src="{{asset('images/depoimentos/sirley.png')}}">
                    </div>
                    <header class="card__post__header" style="padding: 0px 0px 0px 10px;">
                        <time class="post__date" style="position: initial;" datetime="2019-03-29">Sirley</time>
                        <!--<h3 class="body-large">Castus danista vix examinares cursus est. </h3>-->
                    </header>
                </a>
            </article>

            <article class="card__post" style="height:initial;margin-top:15px;">
                <a href="javascript:;">
                    <div class="post__cover" style="max-height: initial;overflow: initial;">
                        <img src="{{asset('images/depoimentos/betina.png')}}">
                    </div>
                    <header class="card__post__header" style="padding: 0px 0px 0px 10px;">
                        <time class="post__date" style="position: initial;" datetime="2019-03-29">Betina</time>
                        <!--<h3 class="body-large">Castus danista vix examinares cursus est. </h3>-->
                    </header>
                </a>
            </article>

            <article class="card__post" style="height:initial;margin-top:15px;">
                <a href="javascript:;">
                    <div class="post__cover" style="max-height: initial;overflow: initial;">
                        <img src="{{asset('images/depoimentos/mara.png')}}">
                    </div>
                    <header class="card__post__header" style="padding: 0px 0px 0px 10px;">
                        <time class="post__date" style="position: initial;" datetime="2019-03-29">Mara</time>
                        <!--<h3 class="body-large">Castus danista vix examinares cursus est. </h3>-->
                    </header>
                </a>
            </article>


        </div>
    </div>
    <div class="pattern"></div>
</section>

<section class="blog" style="padding:0px;background-color: #B1D8B7;">
    <div class="main-wrapper" style="padding: 10px;">
        <div class="blog__container_lisiane">
            <div class="blog__introduction_image" style="height: initial;">
                <img src="{{asset('images/lisiane.png')}}" style="border-radius: 4px 4px 0 0;max-width:60%;">
            </div>
				<div class="post__cover" style="max-height: initial;overflow: initial;">
					<h2 class="title-large" style="color:#4c5967;">Olá!</h2>
					<p style="padding: 0px;color:#4c5967;">Sou Lisiane, a nova proprietária e confeiteira do Cactus Café Poa. Neste site você encontra todos os produtos e serviços que oferecemos.</p>
					<p style="padding: 0px;color:#4c5967;">Praticamente 80% do que servimos são produzidos por mim. Produtos feitos com amor e dedicação.</p>
					<p style="padding: 0px;color:#4c5967;">Aguardo vocês para uma visita!</p>
				</div>
            </div>
        </div>
</section>
@endsection