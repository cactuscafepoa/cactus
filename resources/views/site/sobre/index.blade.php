@extends('layouts.site')

@section('content')
    <div class="green-background">
        <div class=""></div>

        <div class="main-wrapper split-content">
            <!-- Conteudo sobre a empresa -->
            <section class="about__content" style="padding:125px 30px 0px 0;">
                <section class="about__history">
                    <h1 class="display-medium" style="margin-bottom: 0px;color:#FFFFFF;">O Cactus Café Poa é uma cafeteria localizada no bairro Auxiliadora em Porto Alegre.</h1>
                    <p style="color:#FFFFFF;"><strong>Qualidade:</strong> prezamos pela qualidade de nossos produtos.</p>
                    <p style="color:#FFFFFF;"><strong>Transparência:</strong> tratamos nossos consumidores como coaboradores. Eles fazem parte do nosso negócio.</p>
                    <p style="color:#FFFFFF;"><strong>Atendimento:</strong> procuramos oferecer um atendimento personalizado buscando se inserir no bairro e no cotidiano dos moradores e frequentadores.</p>
                    <p style="color:#FFFFFF;"><strong>Distinção:</strong> consideramos a distinção no atendimento a âncora fundamental para prosperarmos juntamento com a comunidade do bairro.</p>
                </section>
                <!--<section class="about__clients">
                    <div class="about__clients__logos">
                        <img src="{{asset('images/logo-5.svg')}}" alt="">
                        <img src="{{asset('images/logo-6.svg')}}" alt="">
                        <img src="{{asset('images/logo-7.svg')}}" alt="">
                        <img src="{{asset('images/logo-8.svg')}}" alt="">
                    </div>
                </section>-->
            </section>

            <!-- Imagem valores da empresa -->
            <section class="about__img__values" style="background-color: #94C973;padding: 100px 0px 30px 30px;">
                <img src="{{asset('images/pilares.png')}}" alt="Cactus Café">
            </section>
        </div>
    </div>
@endsection
