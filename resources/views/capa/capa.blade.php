@extends('dashboard')

@section('cabecalho')
Administração do Sistema
@endsection

@section('conteudo')

<!--<link href="{{ URL::asset('css/capa/reset.css') }}" rel="stylesheet" crossorigin="anonymous">-->
<link href="{{ URL::asset('css/capa/style.css') }}" rel="stylesheet" crossorigin="anonymous">
<link href="{{ URL::asset('css/capa/flexbox.css') }}" rel="stylesheet" crossorigin="anonymous">

<main class="conteudoPrincipal">
    <div class="container">
        <nav>
            <ul class="conteudoPrincipal-cursos">
                <li class="conteudoPrincipal-cursos-link"><a href="{{route('listar_categorias')}}">Categorias</a></li>
                <li class="conteudoPrincipal-cursos-link"><a href="{{route('form_edit_categoria_new')}}">Incluir Categoria</a></li>
                <li class="conteudoPrincipal-cursos-link"><a href="{{route('listar_fornecedores')}}">Fornecedores</a></li>
                <li class="conteudoPrincipal-cursos-link"><a href="{{route('form_edit_fornecedor_new')}}">Incluir Fornecedor</a></li>
                <li class="conteudoPrincipal-cursos-link"><a href="{{route('listar_produtos')}}">Produtos</a></li>
                <li class="conteudoPrincipal-cursos-link"><a href="{{route('form_edit_produto_new')}}">Incluir Produto</a></li>
                <li class="conteudoPrincipal-cursos-link"><a href="{{route('listar_clientes')}}">Clientes</a></li>
                <li class="conteudoPrincipal-cursos-link"><a href="{{route('form_edit_cliente_new')}}">Incluir Cliente</a></li>
                <li class="conteudoPrincipal-cursos-link"><a href="{{route('listar_usuarios')}}">Usuários</a></li>
                <li class="conteudoPrincipal-cursos-link"><a href="{{route('form_edit_usuario_new')}}">Incluir Usuário</a></li>
                <li class="conteudoPrincipal-cursos-link"><a href="{{route('listar_horarios')}}">Horários</a></li>
                <li class="conteudoPrincipal-cursos-link"><a href="{{route('listar_eventos')}}">Eventos</a></li>
                <li class="conteudoPrincipal-cursos-link"><a href="{{route('listar_configuracaos')}}">Configurações</a></li>
            </ul>
        </nav>
    </div>
</main>
 @endsection