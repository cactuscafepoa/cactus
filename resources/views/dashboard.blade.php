<x-app-layout>
    <!--<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel') }}
        </h2>
    </x-slot>-->

@can('user')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="container">
                            <div class="bg-secondary opacity-50 pl-2 text-black">
                                <h5>Este site é restrito para usuários autorizados.<br>
                                    Contate o administrador do sistema para mais informações.
                                </h5>
                            </div>

                        </dig>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elsecan('admin')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="bg-secondary opacity-50 pl-2 text-black">
                            <h1>@yield('cabecalho')</h1>
                        </div>
                        @yield('conteudo')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endcan

</x-app-layout>


