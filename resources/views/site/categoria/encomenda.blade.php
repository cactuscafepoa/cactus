@extends('layouts.site')

@section('content')
    <header class="common-header">
        <div class="header-wrapper">
            <h1 class="title-large">Encomendas</h1>
        </div>
        <div class="pattern__header"></div>
    </header>

@if ($configuracao[0]->encomendas == 0)

    <div class="gray-background" style="padding:20px;">
        <section class="contact__block contact-wrapper" style="padding:0px;margin-bottom:40px;">
            <h2 style="font-size: 1.4rem;color: #8a99a8;">Nosso serviço de encomendas está sendo estruturado.</h2>
            <p style="text-align: initial;max-width:initial;font-weight: initial;">Em breve estará disponível.</p>
        </section>
        <section class="products__cultivation__category main-wrapper" style="padding:0px 0px 10px 0px;display: flex;">
            <a href="{{route('site.home')}}" role="button" class="button button_accent button_large">Voltar</a>
    </section>
    </div>

@else

    @if ($configuracao[0]->encomendas_titulo != "" || $configuracao[0]->encomendas_texto != "")
        <div class="gray-background" style="padding:10px;">
            <section class="main-wrapper" style="padding: 0px;">
                <h2 style="font-size:1.4rem;color:#8a99a8;padding-top:20px;">{{$configuracao[0]->encomendas_titulo}}</h2>
                <p style="text-align: initial;max-width:initial;font-weight: initial;">{{$configuracao[0]->encomendas_texto;}}</p>
            </section>
        </div>
    @endif


    <!-- CATEGORIAS -->
    @php
        $catIdAnterior = 0;
        $contador = 0;
        $total = count($categoria);
    @endphp

    @foreach($categoria as $categ)

        @php
            $contador++;
                if ($catIdAnterior == $categ->CatId)
                    continue;

            $catIdAnterior = $categ->CatId;
        @endphp

        <div class="products__general main-wrapper" style="display:block;text-align:center;margin-top: initial;">

            <article class="card__product" style="background-color:#f5f7f9;margin-top:30px;">
                <!--<a> href="products-detail.php"-->
                    <div style="width:100%;text-align:center;">
                        <div class="card__cover">
                            <img src="{{asset($categ->CatImagem)}}" style="width: 222px;">
                        </div>
                        <div style="margin-top:20px;">
                            <h2 class="title-medium">{{ $categ->CatNome }}</h2>
                            <!--<p style="color: #8a99a8;">{{ $categoria[0]->CatDescricao }}</p>-->
                        </div>
                    </div>
                <!--</a>-->
            </article>

            <section class="products__list" style="max-width:initial;margin-left:initial;margin-top:30px;">
                <!-- PRODUTOS -->
                @foreach($categoria as $product)
                @php
                    $link = "javascript:;";
                    $linkImag = "";
                    $alvo = "";

                    if ($product->ProdLink != "") {
                        if (strpos($product->ProdLink, "instagram") > 0)
                            $linkImag = "<img class='midia_social' src='/images/instagram.png' alt='Instagram'>";
                        elseif (strpos($product->ProdLink, "youtube") > 0)
                            $linkImag = "<img class='midia_social' src='/images/youtube.png'   alt='YouTube'>";
                        else
                            $linkImag = "<img class='midia_social' src='/images/midia_social_vazia.png'>";

                        $link = $product->ProdLink;
                        $alvo = "target='_blank'";
                    }
                @endphp

                    @if ($categ->CatId == $product->ProdCatId)

                        <!--<article class="product">-->
                        <article class="product" style="margin-bottom:40px;">
                            <div class="card__cover" style="text-align:right;margin-right:115px;">
                                @php
                                if ($product->ProdEncomendaPrecoVenda == "0.00" || is_null($product->ProdEncomendaPrecoVenda) )
                                    $valorProduto = number_format($product->ProdPrecoVenda,2,',','.');
                                else
                                    $valorProduto = number_format($product->ProdEncomendaPrecoVenda,2,',','.');
                                @endphp
                                <span style="background-color:#31a575;color: #fff;border-radius: 4px;padding: 0 10px;font-size: 16px;position: absolute;top: -12px;font-weight: bold;text-align: right;">
                                    R$ {{$valorProduto}}
                                </span>
                            </div>
                            <section class="product__content" style="padding:0px 15px 0px 15px;">
                                @if ($product->ProdDestaque == 1)
                                    <img class="novidade__label" src="{{asset('images/label_novidade.png')}}" alt="Novidade">
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
                            <section class="product__content" style="text-align:initial;">
                                <div class="product__desciption" style="margin-top:10px;">
                                    {{$product->ProdDescricao}}
                                    @php
                                        if ( (!is_null($product->ProdEncQtdMin) && $product->ProdEncQtdMin != "") ||
                                             (!is_null($product->ProdEncPrazoMin) && $product->ProdEncPrazoMin != "") ) {
                                            echo "<br><hr style='color:#d1d9e0;'>";
                                                echo $product->ProdEncQtdMin;
                                                echo "<br>";
                                                echo $product->ProdEncPrazoMin;
                                        }
                                    @endphp
                                </div>
                            </section>

                        </article>
                    @endif
                @endforeach
            </section>
        </div>
    @endforeach

    <section class="products__cultivation__category main-wrapper" style="padding:20px 0px 10px 0px;display: flex;">
        <a href="{{route('site.home')}}" role="button" class="button button_accent button_large">Voltar</a>
    </section>
@endif

@endsection