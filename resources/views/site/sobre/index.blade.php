@extends('layouts.site')

@section('content')

    <header class="common-header">
		<div id="div_header" class="header-wrapper">
			<h1 style="background-color:#B1D8B7 !important;" id="h1_header" class="title-large">Sobre</h1>
		</div>
	</header>
    <div class="green-background">
        <div class="main-wrapper split-content" style="justify-content:space-between;padding:0px;">
            <!-- Conteudo sobre a empresa -->
            <section class="about__content" style="padding:0px;">
                <section class="about__history">
                    <h1 class="display-medium" style="margin-bottom: 0px;color:#FFFFFF;">O Cactus Café Poa é uma cafeteria localizada no tradicional bairro Auxiliadora em Porto Alegre.</h1>
                    <p style="color:#FFFFFF;">Reabre, após um hiato de alguns meses e sob nova direção, com a responsabilidade e o objetivo de somar-se às inúmeras opções de qualidade que o bairro oferece.</p>
                    <p style="color:#FFFFFF;margin-bottom:-20px;"><strong>Nossos valores:</strong></p>
                    <p style="color:#FFFFFF;"><strong>Qualidade:</strong>  prezamos pela qualidade de nossos produtos, os quais fazemos com matérias primas selecionadas e com muito carinho.</p>
                    <p style="color:#FFFFFF;"><strong>Transparência:</strong> nosso compromisso maior é com nossos clientes. Estes, fazem parte do nosso negócio.</p>
                    <p style="color:#FFFFFF;"><strong>Atendimento:</strong> procuramos oferecer um atendimento personalizado buscando se inserir no bairro e no cotidiano dos moradores e frequentadores.</p>
                    <p style="color:#FFFFFF;"><strong>Distinção:</strong> acreditamos que a distinção no atendimento é a chave para prosperarmos, juntamente com toda a comunidade do bairro.</p>
                </section>
            </section>
            <section class="about__img__values"style="padding:5px 0px 5px 0px;">
                <img src="{{asset('images/pilares.png')}}" alt="Cactus Café">
            </section>
        </div>
    </div>
@endsection
