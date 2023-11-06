@extends('layouts.site')

@section('content')
    <header class="common-header">
        <div class="header-wrapper">
            <h1 class="title-large">Encomendas</h1>
        </div>
        <div class="pattern__header"></div>
    </header>

    @if ($configuracao[0]->encomendas == 1)

        @if ($configuracao[0]->encomendas_titulo != "" || $configuracao[0]->encomendas_texto != "")
            <div class="gray-background">
                <section class="main-wrapper" style="padding: 0px;">
                    <h2 style="font-size: 1.4rem;color: #8a99a8;">{{$configuracao[0]->encomendas_titulo}}</h2>
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

            <div class="products__general main-wrapper" style="margin-top: initial;">
                <aside class="product__selected" style="margin-bottom: 10px;">
                    <article class="card__product" style="margin-top: 101px;">
                        <a> <!--href="products-detail.php"-->
                            <div class="card__cover">
                                <img src="{{asset($categ->CatImagem)}}" style="width: 222px;">
                            </div>
                            <header class="card__product-header">
                                <h2 class="title-medium">{{ $categ->CatNome }}</h2>
                                <!--<p style="color: #8a99a8;">{{ $categoria[0]->CatDescricao }}</p>-->
                            </header>
                        </a>
                    </article>
                </aside>

                <section class="products__list">
                    <header>
                        <!--<h2 class="title-large">{{ $categoria[0]->CatNome }}</h2>-->
                    </header>

                    <!-- PRODUTOS -->
                    @foreach($categoria as $product)

                    @php
                    $link = "javascript:;";
                    $linkImag = "";
                    $alvo = "";

                    if ($product->ProdLink != "") {
                        if (strpos($product->ProdLink, "instagram") > 0)
                            $linkImag = "<img class='novidade__label' src='/images/instagram.gif' alt='Instagram' style='width:6%;position:absolute;top:14px;left:130px;margin-left: 10px'>";
                        elseif (strpos($product->ProdLink, "youtube") > 0)
                            $linkImag = "<img class='novidade__label' src='/images/youtube.gif' alt='YouTube' style='width:7%;position:absolute;top:10px;left:130px;margin-left: 10px'>";
                        else
                            $linkImag = "<img class='novidade__label' src='/images/midia_social_vazia.gif' style='width:7%;position:absolute;top:10px;left:130px;margin-left: 10px'>";

                        $link = $product->ProdLink;
                        $alvo = "target='_blank'";
                    }
                    @endphp

                            @if ($categ->CatId == $product->ProdCatId)

                                <article class="product">
                                    <a class="clickable-area" href="{{$link}}" {{$alvo}}>
                                        <header class="product__header">
                                            <h3 class="title-medium">{{$product->ProdNome}}</h3>
                                            <div class="card__cover">
                                                @php
                                                //dd($product->ProdEncomendaPrecoVenda);
                                                if ($product->ProdEncomendaPrecoVenda == "0.00" || is_null($product->ProdEncomendaPrecoVenda) )
                                                    $valorProduto = number_format($product->ProdPrecoVenda,2,',','.');
                                                else
                                                    $valorProduto = number_format($product->ProdEncomendaPrecoVenda,2,',','.');
                                                @endphp
                                                <span style="background-color:#31a575;color: #fff;border-radius: 4px;padding: 0 10px;font-size: 16px;position: absolute;top: -12px;font-weight: bold;text-align: right;">
                                                    R$ {{$valorProduto}}
                                                </span>
                                                @if ($product->ProdDestaque == 1)
                                                    <img class="novidade__label" src="{{asset('images/label_novidade.gif')}}" alt="Novidade">
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
                            @endif
                        @endforeach
                </section>
            </div>

                @if ($contador < $total )
                <div style="width:100%;height:1px;background-color:#d1d9e0;margin-top: initial;"></div>
                @endif

        @endforeach
        <section class="products__cultivation__category main-wrapper" style="padding:20px 0px 10px 0px;display: flex;">
            <a href="{{route('site.home')}}" role="button" class="button button_accent button_large">Voltar</a>
        </section>
    @else
        <div class="gray-background">
            <section class="contact__block contact-wrapper">
                <h2 style="font-size: 1.4rem;color: #8a99a8;">Nosso serviço de encomendas está temporariamente suspenso.</2>
                <p style="max-width:initial;font-weight: initial;">Em breve estará disponível novamente.</p>
            </section>
            <section class="products__cultivation__category main-wrapper" style="padding:0px 0px 10px 0px;display: flex;">
                <a href="{{route('site.home')}}" role="button" class="button button_accent button_large">Voltar</a>
            </section>
        </div>
    @endif

@endsection