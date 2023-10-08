@extends('layouts.site')

@section('content')

<style>

	* :not(header):not(#div_header):not(#h1_header) {
		background-color:#f5f7f9 !important;
	}
	footer {
		background-image:initial !important;
	}
</style>
		<header class="common-header">
			<div id="div_header" class="header-wrapper">
				<h1 id="h1_header" class="title-large">Eventos</h1>
			</div>
		</header>
		<div class="gray-background">
			<section class="main-wrapper" style="margin-top:15px;margin-bottom:15px;">
				<div id="divFormat" style="background-color:initial;box-shadow: 0 0 30px rgba(0,0,0,.15), 0 6px 4px rgba(0,0,0,.1);padding:15px;max-width:1040px;">
					{!!$dataset[0]->texto!!}
				</div>
			</section>
		</div>
@endsection