@extends('layouts.site')

@section('content')
    <header class="common-header">
        <div class="header-wrapper">
            <h1 class="title-large">{{$configuracao[0]->prato_dia_cabecalho}}</h1>
        </div>
        <div class="pattern__header"></div>
    </header>

@if ($configuracao[0]->prato_dia == 1)

    <div class="gray-background">
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
                        $linkImag = "<img class='novidade__label' src='/images/instagram.png' alt='Instagram' style='width:4%;position:absolute;top:14px;left:130px;margin-left: 10px'>";
                    elseif (strpos($product->ProdLink, "youtube") > 0)
                        $linkImag = "<img class='novidade__label' src='/images/youtube.png' alt='YouTube' style='width:5%;position:absolute;top:10px;left:130px;margin-left: 10px'>";
                    else
                        $linkImag = "<img class='novidade__label' src='/images/midia_social_vazia.png' style='width:5%;position:absolute;top:10px;left:130px;margin-left: 10px'>";

                    $link = $product->ProdLink;
                    $alvo = "target='_blank'";
                }
                @endphp
                    <article class="product">
                        <a class="clickable-area" href="{{$link}}" {{$alvo}}>
                            <header class="product__header">
                                <h3 class="title-medium">{{$product->ProdNome}}</h3>
                                <div class="card__cover">
                                    <span style="background-color:#31a575;color: #fff;border-radius: 4px;padding: 0 10px;font-size: 16px;position: absolute;top: -12px;font-weight: bold;text-align: right;">
                                        R$ {{number_format($product->ProdPrecoVenda,2,',','.')}}
                                    </span>
                                    @if ($product->ProdDestaque == 1)
                                        <img class="novidade__label" src="{{asset('images/label_novidade.png')}}" alt="Novidade" style="width:5%;">
                                    @endif
                                    <img src="{{ asset($product->ProdImagem) }}" style="width: 160px;">
                                </div>
                                <!-- Tooggle item -->
                                <!--<span class="collapse__open"></span>-->
                            </header>
                            @if ($product->ProdEncomenda == 1)
                                <img class="exclusive__label" src="{{asset('images/label_encomenda.png')}}" alt="Aceita encomenda">
                            @endif
                            @php
                                echo $linkImag;
                            @endphp
                        </a>
                        <section class="product__content">
                            <div class="product__desciption">
                                {{$product->ProdEncQtdMin}}<br>
                                {{$product->ProdEncPrazoMin}}
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