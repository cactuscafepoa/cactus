@extends('layouts.site')

@section('content')

@if ($configuracao[0]->cardapio == 0)

        <div class="gray-background">
            <section class="contact__block contact-wrapper" style="padding: 0px;">
                <h2 style="font-size: 1.4rem;color: #8a99a8;">Nosso cardápio está em manutenção.</h2>
                <p style="text-align: initial;max-width:initial;font-weight: initial;">Em breve estará disponível novamente.</p>
            </section>
        </div>
@else

<style>
    body {
        background-color: #f5f7f9;
    }
</style>
    <header class="common-header">
        <div class="header-wrapper">
            <h1 class="title-large">Cardápio: {{$categoria[0]->CatNome}}</h1>
        </div>
        <div class="pattern__header"></div>
    </header>

    <div class="products__general main-wrapper"  style="margin-top:-20px;margin-bottom: -30px;display:block;">
        <!--
        <aside class="product__selected" style="margin-bottom: 10px;">
            <article class="card__product" style="margin-top: 101px;">
                <a> href="products-detail.php"
                    <div class="card__cover">
                        <img src="{{asset($categoria[0]->CatImagem)}}" style="width: 222px;">
                    </div>
                    <header class="card__product-header">
                        <h2 class="title-medium">{{ $categoria[0]->CatNome }}</h2>
                        <p style="color: #8a99a8;">{{ $categoria[0]->CatDescricao }}</p>
                    </header>
                </a>

            </article>
            <section class="products__cultivation__category main-wrapper" style="padding:20px 0px 10px 0px;display: flex;margin-bottom:20px;">
                <a href="{{route('site.cardapio')}}" role="button" class="button button_accent button_large">Voltar</a>
            </section>
        </aside>
        -->
        <section class="products__list" style="margin-bottom:30px;margin-top: 50px;">
            <!--<header>-->
                <!--<h2 class="title-large">{{ $categoria[0]->CatNome }}</h2>-->
            <!--</header>-->

            @foreach($categoria as $product)
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

                <article class="product" style="margin-bottom:40px;">

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
        <a href="{{route('site.cardapio')}}" role="button" class="button button_accent button_large" style="margin-left:20px;margin-bottom:48px;">Voltar</a>
    </div>
@endif
@endsection