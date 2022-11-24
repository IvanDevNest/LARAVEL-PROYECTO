<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
    @section('content')
        <div class="pagina-inicio">
            <h2>{{ __('En mantenimiento!') }}</h2>
            <a class="btn btn-success" href="{{ url('/files') }}">{{ __('Files') }}</a><hr>
            <a class="btn btn-primary" href="{{ url('/posts') }}">{{ __('Posts') }}</a>
            <a class="btn btn-primary" href="{{ url('/places') }}">{{ __('Places') }}</a>
        </div>
    @endsection

</x-app-layout>