<x-app-layout>
    {{-- Hero Section Premium (Neutral & Professional) --}}
    <div class="relative bg-white border-b border-neutral-200 pt-20 pb-28 overflow-hidden">
        {{-- Very subtle abstract background (no bright colors) --}}
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23000000\' fill-opacity=\'0.02\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
            <div class="absolute top-0 right-0 w-[40vw] h-[40vw] bg-neutral-100 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <span class="inline-flex items-center px-3 py-1 text-[11px] font-bold tracking-[0.2em] uppercase rounded-full bg-neutral-100 text-neutral-600 border border-neutral-200 mb-6 font-mono">
                    Plataforma Oficial
                </span>
                <h1 class="text-4xl sm:text-6xl font-extrabold text-neutral-900 tracking-tight mb-6 leading-[1.1]">
                    Descubra as melhores <br/> experiências.
                </h1>
                <p class="text-lg text-neutral-500 font-normal leading-relaxed mb-8 max-w-2xl">
                    Agende sua presença nos eventos corporativos e palestras mais exclusivas com um único clique. Seu ingresso seguro, centralizado e digital.
                </p>
                <div class="flex items-center space-x-4">
                    <a href="#catalogo" class="inline-flex items-center px-6 py-3 bg-neutral-900 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 transition-all">
                        Explorar Catálogo
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Events Section --}}
    <div id="catalogo" class="py-16 sm:py-24 bg-stone-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('info'))
                <div class="mb-10 bg-white border border-neutral-200 text-neutral-700 px-5 py-4 rounded-xl flex items-center shadow-sm" role="alert">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium text-sm">{{ session('info') }}</span>
                </div>
            @endif

            <div class="flex items-center justify-between mb-10">
                <h2 class="text-2xl font-bold text-neutral-900 tracking-tight">Programação</h2>
            </div>

            @if($events->isEmpty())
                <div class="bg-white rounded-2xl border border-neutral-200 p-16 text-center shadow-sm">
                    <div class="w-16 h-16 bg-neutral-50 rounded-2xl flex items-center justify-center mx-auto mb-6 border border-neutral-100">
                        <svg class="h-8 w-8 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-neutral-900 mb-2">Sem eventos no radar</h3>
                    <p class="text-neutral-500 text-sm">Estamos preparando a nossa pauta. Retorne mais tarde.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($events as $event)
                        <a href="{{ route('events.show', $event) }}" class="group flex flex-col bg-white rounded-2xl overflow-hidden border border-neutral-200 hover:border-neutral-300 hover:shadow-xl hover:shadow-neutral-200/50 transition-all duration-300">
                            
                            {{-- Banner --}}
                            <div class="h-56 bg-neutral-100 relative overflow-hidden">
                                @if($event->banner_path)
                                    <img src="{{ asset($event->banner_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover grayscale-[30%] transition-transform duration-700 group-hover:scale-[1.03] group-hover:grayscale-0">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-stone-100">
                                        <svg class="h-16 w-16 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                                {{-- Date Badge --}}
                                <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-md px-3 py-2 rounded-xl text-center shadow-sm min-w-[3.5rem] border border-neutral-100">
                                    <span class="block text-[10px] font-bold text-neutral-500 uppercase tracking-widest leading-none mb-1">{{ $event->event_date->translatedFormat('M') }}</span>
                                    <span class="block text-xl font-extrabold text-neutral-900 leading-none">{{ $event->event_date->format('d') }}</span>
                                </div>
                            </div>
                            
                            {{-- Content --}}
                            <div class="p-6 flex-1 flex flex-col">
                                <h3 class="text-xl font-bold text-neutral-900 mb-4 line-clamp-2 leading-tight group-hover:text-neutral-500 transition-colors">{{ $event->title }}</h3>
                                
                                <div class="space-y-2 mb-5">
                                    <div class="flex items-center text-sm text-neutral-500">
                                        <svg class="w-4 h-4 mr-2.5 text-neutral-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span class="line-clamp-1 break-all">{{ $event->location }}</span>
                                    </div>
                                    <div class="flex items-center text-sm text-neutral-500">
                                        <svg class="w-4 h-4 mr-2.5 text-neutral-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>{{ $event->event_date->format('H:i') }}h</span>
                                    </div>
                                </div>
                                
                                <p class="text-sm text-neutral-500 mb-6 flex-1 line-clamp-2 leading-relaxed">
                                    {{ $event->description }}
                                </p>
                                
                                <span class="block w-full text-center px-4 py-3 bg-white border border-neutral-200 text-neutral-900 rounded-xl font-semibold text-sm group-hover:bg-neutral-900 group-hover:text-white transition-all">
                                    Acessar Informações
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
                
                <div class="mt-12">
                    {{ $events->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
