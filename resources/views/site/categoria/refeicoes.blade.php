@extends('layouts.site')

@section('content')
    <header class="common-header">
        <div class="header-wrapper">
            <h1 class="title-large">{{$configuracao[0]->prato_dia_cabecalho}}</h1>
        </div>
        <div class="pattern__header"></div>
    </header>

@if ($configuracao[0]->prato_dia == 1)

    <div class="gray-background" style="padding-bottom:2px;">
        <section class="main-wrapper" style="padding: 0px;">
            <h2 style="font-size: 1.4rem;color: #8a99a8;">{{$configuracao[0]->prato_dia_texto_titulo}}</h2>
            <p style="text-align: initial;max-width:initial;font-weight: initial;">{{$configuracao[0]->prato_dia_texto;}}</p>
        </section>
    </div>

    <div class="products__general main-wrapper" style="margin-top: 32px;">

        <section class="products__list" style="width:100%;max-width: initial;">

            @foreach($produto as $product)
            @php
                $link = "javascript:;";
                $linkImag = "";
                $alvo = "";

                if ($product->ProdLink != "") {
                    if (strpos($product->ProdLink, "instagram") > 0)
                            $linkImag = "<img class='midia_social' src='/images/instagram.gif' alt='Instagram'>";
                        elseif (strpos($product->ProdLink, "youtube") > 0)
                            $linkImag = "<img class='midia_social' src='/images/youtube.gif'   alt='YouTube'>";
                        else
                            $linkImag = "<img class='midia_social' src='/images/midia_social_vazia.gif'>";

                        $link = $product->ProdLink;
                        $alvo = "target='_blank'";
                    }
                @endphp

                <article class="product">

                    <div class="card__cover" style="text-align:right;margin-right:115px;">
                        <span style="background-color:#31a575;color: #fff;border-radius: 4px;padding: 0 10px;font-size: 16px;position: absolute;top:-12px;font-weight: bold;text-align: right;">
                            R$ {{number_format($product->ProdPrecoVenda,2,',','.')}}
                        </span>
                    </div>

                    <section class="product__content" style="padding:0px 15px 0px 15px;">
                        @if ($product->ProdEncomenda == 1)
                            <img class="exclusive__label" src="{{asset('images/label_encomenda.png')}}" alt="Aceitamos encomenda">
                        @endif
                        @if ($product->ProdDestaque == 1)
                            <img class="novidade__label" src="{{asset('images/label_novidade.gif')}}" alt="Novidade">
                        @endif
                        @php
                            echo $linkImag;
                        @endphp
                    </section>

                    <a class="produto-celular-titulo-imagem" href="{{$link}}" {{$alvo}}>
                        <div style="text-align:center;">
                            <h3 class="title-medium">{{$product->ProdNome}}</h3>
                        </div>
                        <div style="text-align:center;">
                            <img src="{{ asset($product->ProdImagem) }}" style="width: 160px;">
                        </div>
                    </a>
                    <section class="product__content" style="padding:0px 15px 0px 15px;">
                        <div class="product__desciption">
                            {{$product->ProdDescricao}}
                        </div>
                    </section>

                    </article>

            @endforeach
        </section>
    </div>
@else
    <div class="gray-background">
        <section class="contact__block contact-wrapper gray-background" style="padding: 60px 0;">
            <h2 style="font-size: 1.4rem;color: #8a99a8;">Refeições programadas estão temporariamente suspensas.</2>
            <p style="max-width:initial;font-weight: initial;">Em breve estarão disponíveis novamente.</p>
        </section>
    </div>
@endif

    <section class="products__cultivation__category main-wrapper" style="padding:0px 0px 10px 0px;display: flex;">
        <a href="{{route('site.home')}}" role="button" class="button button_accent button_large">Voltar</a>
    </section>

@endsection