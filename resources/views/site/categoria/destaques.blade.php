@extends('layouts.site')

@section('content')
    <header class="common-header">
        <div class="header-wrapper">
            <h1 class="title-large">Novidades e destaques</h1>
        </div>
        <div class="pattern__header"></div>
    </header>

@if ($configuracao[0]->novidades == 1)
       
            <div class="gray-background">
                <section class="contact__block contact-wrapper" style="padding: 0px;">                    
                    <!--<p style="text-align: initial;max-width:initial;font-weight: initial;">TESTE TESTE</p>-->
                </section>        
            </div>
        
        <div class="products__general main-wrapper" style="margin-top: 32px;">    

            <section class="products__list" style="width:100%;max-width: initial;">
                
                @foreach($produto as $product)                    
                    
                        <article class="product">
                            <a class="clickable-area" href="javascript:;">
                                <header class="product__header">
                                    <h3 class="title-medium">{{$product->ProdNome}}</h3>
                                    <div class="card__cover">
                                        <span style="background-color:#31a575;color: #fff;border-radius: 4px;padding: 0 10px;font-size: 16px;position: absolute;top: -12px;font-weight: bold;text-align: right;">
                                            R$ {{number_format($product->ProdEncomendaPrecoVenda,2,',','.')}}
                                        </span>    
                                        @if ($product->ProdDestaque == 1)
                                            <img class="novidade__label" src="{{asset('images/label_novidade.png')}}" alt="Novidade">
                                        @endif                                        
                                        <img src="{{ asset($product->ProdImagem) }}" style="width: 160px;">                            
                                    </div> 
                                    <!-- Tooggle item -->
                                    <!--<span class="collapse__open"></span>-->
                                </header>
                                @if ($product->ProdEncomenda == 1)
                                    <img class="exclusive__label" src="{{asset('images/label_encomenda.png')}}" alt="Aceita encomenda">
                                @endif
                            </a>
                            <section class="product__content">
                                <div class="product__desciption">
                                    {{$product->ProdDestTexto}}
                                </div>                 
                            </section>
                    
                        </article>
                    
                @endforeach
            </section>
        </div>        
@else
    <div class="gray-background">
        <section class="contact__block contact-wrapper gray-background" style="padding: 60px 0;">
            <h2 style="font-size: 1.4rem;color: #8a99a8;">Nossa página de novidades e destaques está sendo atualizada.</2>
            <p style="max-width:initial;font-weight: initial;">Em breve estará disponível novamente.</p>
        </section>        
    </div>        
@endif

    <section class="products__cultivation__category main-wrapper" style="padding:0px 0px 10px 0px;display: flex;">
        <a href="{{route('site.home')}}" role="button" class="button button_accent button_large">Voltar</a>
    </section>

@endsection