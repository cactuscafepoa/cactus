@extends('layouts.site')

@section('content')
	<header class="common-header">
        <div class="header-wrapper">
            <h1 class="title-large">Horário de atendimento</h1>
        </div>
        <div class="pattern__header"></div>
    </header>

	@if ($configuracao[0]->horario == 1)

		<div class="gray-background">
			<section class="main-wrapper" style="padding:20px 0 20px 0px;">
				<p style="text-align:initial;">{{ $dataset[0]->aviso}}</p>
				<p style="text-align:initial;">{{ $dataset[0]->atendimento_fisico}}</p>
				<p style="text-align:initial;">{{ $dataset[0]->atendimento_encomendas}}</p>
				<section class="contact__options" style="grid-template-columns: initial;max-width: 1040px;">
					<div class="contact__infos">

						<ul class="list-group">
							<li class="list-group-item d-flex justify-content-between align-items-center bg-secondary text-white" style="height:48px;">
								<span class="d-flex" style='width:15%;'>
									Dia
								</span>
								<span class="d-flex" style='width:15%;'>

								</span>
								<span class="d-flex" style='width:20%;'>
									Abre
								</span>
								<span class="d-flex" style='width:20%;'>
									Fecha
								</span>
							</li>
							@foreach ($dataset as $horario)
							<li class="list-group-item d-flex justify-content-between align-items-center">
								<span class="d-flex" style='width:15%;'>
									{{ $horario->dia_semana}}
								</span>
								<span class="d-flex" style='width:15%;'>
									{{ $horario->aberto}}
								</span>
								<span class="d-flex" style='width:20%;'>
									{{ $horario->hora_abre}}
								</span>
								<span class="d-flex" style='width:20%;'>
									{{ $horario->hora_fecha}}
								</span>
							</li>
							@endforeach
						</ul>
					</div>
				</section>
			</section>
		</div>
	@else
        <div class="gray-background">
            <section class="contact__block contact-wrapper">
                <h2 style="font-size: 1.4rem;color: #8a99a8;">Nosso horário de atendimento está sendo atualizado.</2>
                <p style="max-width:initial;font-weight: initial;">Em breve estará disponível novamente.</p>
            </section>
            <section class="products__cultivation__category main-wrapper" style="padding:0px 0px 10px 0px;display: flex;">
                <a href="{{route('site.home')}}" role="button" class="button button_accent button_large">Voltar</a>
            </section>
        </div>
    @endif




@endsection