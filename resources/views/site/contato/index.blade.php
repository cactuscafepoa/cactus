@extends('layouts.site')

@section('content')

    <header class="common-header">
        <div class="header-wrapper">
            <h1 class="title-large">Contato</h1>
        </div>
        <div class="pattern__header"></div>
    </header>

    <div class="gray-background">
        <section class="main-wrapper" style="padding: 10px 0 20px 0;">
            <h1 class="display-medium">Fale conosco!</h1>
            <p>Sugestões e crítcas são importantes para o crescimento.</p>
            <section class="contact__options"  style="grid-template-columns: initial;max-width: 1040px;">
                <div class="contact__infos" style="text-align:center;">
                    <div>
                        <div class="contact__infos__header" style="display: initial;">
                            <img src="{{asset('images/phone-contact-icon.svg')}}" alt="">
                            <h3 class="title-small" style="display:initial;margin-bottom:10px;">Telefone</h3>
                        </div>
                        <a title="clique no número do telefone para ligar" style="color:#FFFFFF;display:block;margin-top:10px;" href="tel:5130195922">(51) 3019-5922</a>
                    </div>

                    <div style="text-align:center;">
                        <div class="contact__infos__header" style="display: initial;">
                            <img src="{{asset('images/mail-contact-icon.svg')}}" alt="">
                            <h3 class="title-small" style="display:initial;margin-bottom:10px;">E-mail</h3>
                        </div>
                        <a title="Clique no email para enviar email automatico" style="color:#FFFFFF;display:block;margin-top:10px;" href="mailto:cactuscafepoa@gmail.com">cactuscafepoa@gmail.com</a>
                    </div>

                    <div>
                        <div class="contact__infos__header" style="display: initial;">
                            <img src="{{asset('images/pin-map-contact-icon.svg')}}" alt="">
                            <h3 class="title-small" style="display:initial;margin-bottom:10px;">Endereço</h3>
                        </div>
                        <a title="clique no endereço para traçar uma rota" target="_blank" style="color:#FFFFFF;display:block;margin-top:10px;"
                           href="https://goo.gl/maps/NM9ckfUQCiYNyr5b9">
                           Rua Felipe Neri, 461 Loja 101<br>
                           Bairro Auxiliadora, Porto Alegre/RS<br>
                           CEP: 90.440-150
                        </a>
                    </div>

                    <div>
                        <div class="contact__infos__header" style="display: initial;">
                            <img src="{{asset('images/instagram.png')}}" alt="">
                            <h3 class="title-small" style="display:initial;margin-bottom:10px;">Instagram</h3>
                        </div>
                        <section class="contact__infos__social-media">
                            <a href="https://www.instagram.com/cactuscafepoa/" target="_blank" style="color:#FFFFFF;display:block;margin-top:10px;">Cactus Cafe Poa</a>
                            <a href="https://www.instagram.com/lifazendoarte/" target="_blank" style="color:#FFFFFF;display:block;margin-top:10px;">Li Fazendo Arte</a>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </div>
@endsection
