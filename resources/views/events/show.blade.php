<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('home') }}" class="text-neutral-900 hover:text-neutral-800 mr-3 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalhes do Evento') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center shadow-sm"
                    role="alert">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center shadow-sm"
                    role="alert">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('info'))
                <div class="mb-6 bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg flex items-center shadow-sm"
                    role="alert">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ session('info') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                {{-- Banner Hero --}}
                <div class="h-64 sm:h-80 w-full bg-gray-200 relative">
                    @if($event->banner_path)
                        <img src="{{ asset($event->banner_path) }}" alt="{{ $event->title }}"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-neutral-50">
                            <svg class="h-24 w-24 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 w-full p-6 sm:p-8">
                        <div class="flex items-center space-x-2 text-white/80 mb-2">
                            <span
                                class="bg-neutral-900 font-semibold px-2.5 py-1 rounded-md text-xs uppercase tracking-wider text-white shadow-sm">🎫
                                Evento</span>
                            <span class="text-sm shadow-sm">{{ $event->event_date->format('d/m/Y') }}</span>
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-bold text-white drop-shadow-md">{{ $event->title }}</h1>
                    </div>
                </div>

                {{-- Content --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">
                    {{-- Left Column: Details --}}
                    <div class="lg:col-span-2 p-6 sm:p-8 border-b lg:border-b-0 lg:border-r border-gray-100">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-neutral-900" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Sobre o Evento
                        </h3>
                        <div class="prose max-w-none text-gray-600 leading-relaxed whitespace-pre-line">
                            {{ $event->description }}
                        </div>
                    </div>

                    {{-- Right Column: Action & Info --}}
                    <div class="p-6 sm:p-8 bg-gray-50/50 flex flex-col justify-between">
                        <div>
                            <div class="mb-6 space-y-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Data e Hora</p>
                                        <p class="text-sm text-gray-500">
                                            {{ $event->event_date->format('d/m/Y \à\s H:i') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Localização</p>
                                        <p class="text-sm text-gray-500">{{ $event->location }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Inscritos</p>
                                        <p class="text-sm text-gray-500">{{ $registrationCount }} pessoas confirmadas
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-200 mt-2">
                            @if($event->event_date->isPast())
                                <div class="bg-gray-100 rounded-lg p-4 text-center">
                                    <span class="text-gray-500 font-medium block">Esse evento já ocorreu</span>
                                </div>
                            @elseif(auth()->guest())
                                <a href="{{ route('login') }}"
                                    class="w-full inline-flex justify-center items-center px-4 py-3 bg-neutral-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-neutral-700 focus:bg-neutral-700 active:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Faça login para se inscrever
                                </a>
                                <p class="text-xs text-center text-gray-500 mt-3">Ainda não tem conta? <a
                                        href="{{ route('register') }}"
                                        class="text-neutral-900 hover:underline">Registre-se</a>.</p>
                            @else
                                @if($isRegistered)
                                    <div class="bg-green-50 rounded-lg border border-green-200 p-4 text-center mb-4">
                                        <svg class="mx-auto h-8 w-8 text-green-500 mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-green-800 font-semibold block text-sm">Você está inscrito!</span>
                                        <p class="text-xs text-green-600 mt-1">Acesse seu Perfil para ver o seu Ingresso.</p>
                                    </div>
                                    <form action="{{ route('events.unregister', $event) }}" method="POST"
                                        onsubmit="return confirm('Tem certeza que deseja cancelar sua inscrição?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full inline-flex justify-center items-center px-4 py-2 bg-white border border-red-300 rounded-md font-semibold text-xs text-red-600 uppercase tracking-widest hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                                            Cancelar Inscrição
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('events.register', $event) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-full inline-flex justify-center items-center px-4 py-3 bg-neutral-900 border border-transparent rounded-md font-semibold text-sm text-white tracking-widest shadow-md hover:bg-neutral-700 focus:bg-neutral-700 active:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:-translate-y-0.5">
                                            Inscrever-se agora
                                        </button>
                                    </form>
                                    <p class="text-xs text-center text-gray-500 mt-3 flex items-center justify-center">
                                        <svg class="w-3.5 h-3.5 mr-1 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                            </path>
                                        </svg>
                                        Inscrição gratuita e segura
                                    </p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
