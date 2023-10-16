@extends('layouts.site')

@section('content')
	<header class="common-header">
		<div id="div_header" class="header-wrapper">
			<h1 style="background-color:#B1D8B7 !important;" id="h1_header" class="title-large">Eventos</h1>
		</div>
	</header>

	<div class="gray-background" style="padding:20px 0px 20px 0px;">
		<section class="main-wrapper">
			<div id="divFormat" style="background-color:initial;box-shadow: 0 0 30px rgba(0,0,0,.15), 0 6px 4px rgba(0,0,0,.1);padding:15px;max-width:1040px;background-color:#FFFFFF;">
				{!!$dataset[0]->texto!!}
			</div>
		</section>
	</div>
@endsection