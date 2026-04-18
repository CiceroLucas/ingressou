<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Meus Ingressos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($registrations->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                            <h3 class="text-xl font-medium text-gray-900">Nenhum ingresso encontrado</h3>
                            <p class="mt-2 text-gray-500">Você ainda não se inscreveu em nenhum evento.</p>
                            <a href="{{ route('home') }}" class="mt-6 inline-flex justify-center items-center px-4 py-2 bg-neutral-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-neutral-700 focus:bg-neutral-700 active:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 transition ease-in-out duration-150">
                                Explorar Eventos
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($registrations as $reg)
                                <div class="bg-white border rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow relative">
                                    <div class="h-32 bg-gray-200 relative">
                                        @if($reg->event->banner_path)
                                            <img src="{{ asset($reg->event->banner_path) }}" alt="{{ $reg->event->title }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-neutral-50">
                                                <svg class="h-12 w-12 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="absolute inset-0 bg-black/20"></div>
                                        
                                        @if($reg->status === 'used')
                                            <div class="absolute top-3 right-3 bg-red-600/90 backdrop-blur-sm text-white px-2 py-1 rounded text-xs font-bold shadow-sm uppercase">
                                                Utilizado
                                            </div>
                                        @elseif($reg->event->event_date->isPast())
                                            <div class="absolute top-3 right-3 bg-gray-600/90 backdrop-blur-sm text-white px-2 py-1 rounded text-xs font-bold shadow-sm uppercase">
                                                Encerrado
                                            </div>
                                        @else
                                            <div class="absolute top-3 right-3 bg-green-500/90 backdrop-blur-sm text-white px-2 py-1 rounded text-xs font-bold shadow-sm uppercase">
                                                Válido
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-5 flex flex-col items-center border-t-2 border-dashed border-gray-200 relative">
                                        <div class="absolute -top-3 -left-3 w-6 h-6 bg-white rounded-full border-r border-b border-transparent shadow-inner"></div>
                                        <div class="absolute -top-3 -right-3 w-6 h-6 bg-white rounded-full border-l border-b border-transparent shadow-inner"></div>
                                        
                                        <h3 class="font-bold text-lg text-gray-900 text-center line-clamp-1 w-full">{{ $reg->event->title }}</h3>
                                        <p class="text-sm text-gray-500 mt-1 mb-4 flex items-center justify-center">
                                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            {{ $reg->event->event_date->format('d/m/Y H:i') }}
                                        </p>
                                        
                                        <a href="{{ route('profile.ticket-show', $reg) }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-neutral-50 border border-transparent rounded-md font-semibold text-sm text-neutral-700 hover:bg-neutral-100 transition ease-in-out duration-150">
                                            Acessar Ingresso
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-6">
                            {{ $registrations->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
