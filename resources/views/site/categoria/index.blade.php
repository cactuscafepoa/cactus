@extends('layouts.site')

@section('content')
    <header class="common-header">
        <div class="header-wrapper">
            <h1 class="title-large">Cardápio</h1>
        </div>
        <div class="pattern__header"></div>
    </header>

@if ($configuracao[0]->cardapio == 0)

    <div class="gray-background">
        <section class="contact__block contact-wrapper" style="padding:30px 0px 60px 0px;">
            <h2 style="font-size: 1.4rem;color: #8a99a8;">Nosso cardápio está em manutenção.</h2>
            <p style="max-width:initial;font-weight: initial;">Em breve estará disponível novamente.</p>
        </section>
        <section class="products__cultivation__category main-wrapper" style="padding:0px 0px 10px 0px;display: flex;">
            <a href="{{route('site.home')}}" role="button" class="button button_accent button_large">Voltar</a>
        </section>
    </div>

@else

    <!-- Products list -->
    <div class="gray-background">
        <section class="products__cultivation__category main-wrapper" style="padding:10px 0px 10px 0px;">
            @foreach($categorias as $category)
                <article class="card__product">
                    <a href="{{route('site.produtos.categoria',$category->slug)}}" style="text-decoration:none;">
                        <div class="card__cover">
                            <img src="{{asset($category->imagem)}}">
                        </div>
                        <header class="card__product-header">
                            <h2 class="title-medium">{{$category->nome}}</h2>
                            <p style="color:#8a99a8;">{{$category->descricao}}</p>
                        </header>
                    </a>
                </article>
            @endforeach
        </section>

        @if ($categorias->count() <= 0)
            <div class="gray-background">
                <section class="contact__block contact-wrapper" style="padding: 0px;">
                    <h2 style="font-size: 1.4rem;color: #8a99a8;">Nosso cardápio está em manutenção.
                    <p style="max-width:initial;font-weight: initial;">Em breve estará disponível novamente.</p>
                </section>
            </div>
        @endif

        <section class="products__cultivation__category main-wrapper" style="padding:0px 0px 10px 0px;display: flex;">
            <a href="{{route('site.home')}}" role="button" class="button button_accent button_large">Voltar</a>
        </section>
    </div>

@endif

@endsection