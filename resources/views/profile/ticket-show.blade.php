<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('profile.tickets') }}" class="text-neutral-900 hover:text-neutral-800 mr-3 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Seu Ingresso') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200">

                {{-- Ticket Header / Banner --}}
                <div class="h-40 bg-neutral-900 relative overflow-hidden">
                    @if($registration->event->banner_path)
                        <img src="{{ asset($registration->event->banner_path) }}" alt="Banner"
                            class="w-full h-full object-cover opacity-60 mix-blend-overlay">
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-neutral-500 to-purple-600"></div>
                    @endif

                    <div
                        class="absolute inset-0 flex flex-col items-center justify-center text-white px-4 text-center pb-6">
                        <span
                            class="px-2 py-1 bg-white/20 backdrop-blur-sm rounded text-xs font-semibold uppercase tracking-widest mb-2 shadow-sm">Ingresso
                            Oficial</span>
                        <h3 class="text-2xl font-bold drop-shadow-md leading-tight">{{ $registration->event->title }}
                        </h3>
                    </div>

                    {{-- Ticket Cutout --}}
                    <div class="absolute -bottom-4 -left-4 w-8 h-8 bg-gray-100 rounded-full border border-gray-200">
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-8 h-8 bg-gray-100 rounded-full border border-gray-200">
                    </div>
                </div>

                <div class="border-b-2 border-dashed border-gray-300 relative"></div>

                {{-- Ticket Body --}}
                <div class="p-8 flex flex-col items-center bg-white relative">
                    <div class="absolute -top-4 -left-4 w-8 h-8 bg-gray-100 rounded-full border border-gray-200"></div>
                    <div class="absolute -top-4 -right-4 w-8 h-8 bg-gray-100 rounded-full border border-gray-200"></div>

                    @if($registration->status === 'used')
                        <div
                            class="w-full text-center py-2 mb-6 bg-red-100 text-red-800 rounded font-bold uppercase tracking-wider text-sm border border-red-200 shadow-sm">
                            Ingresso Utilizado
                        </div>
                    @endif

                    {{-- Event Info --}}
                    <div class="w-full grid grid-cols-2 gap-4 mb-8">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Titular</p>
                            <p class="font-semibold text-gray-900 border-b border-gray-100 pb-1 line-clamp-1">
                                {{ $registration->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Data</p>
                            <p class="font-semibold text-gray-900 border-b border-gray-100 pb-1">
                                {{ $registration->event->event_date->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Local</p>
                            <p class="font-semibold text-gray-900 border-b border-gray-100 pb-1">
                                {{ $registration->event->location }}</p>
                        </div>
                    </div>

                    {{-- QR Code Area --}}
                    <div
                        class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6 flex flex-col items-center">
                        <div class="mb-2">
                            {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(220)->margin(1)->generate(url('/admin/validate-ticket/' . $registration->ticket_code)) !!}
                        </div>
                        <p class="text-xs text-center text-gray-500 mt-2 max-w-[220px]">
                            Apresente este QR Code na portaria do evento para validação.
                        </p>
                    </div>

                    <div class="text-center w-full">
                        <p class="text-xs text-gray-400 uppercase tracking-widest font-mono">ID:
                            {{ substr($registration->ticket_code, 0, 18) }}...</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-6">
                <button onclick="window.print()"
                    class="text-neutral-900 hover:text-neutral-800 text-sm font-medium flex items-center justify-center mx-auto transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                        </path>
                    </svg>
                    Imprimir ou Salvar PDF
                </button>
            </div>
        </div>
    </div>

    {{-- Hide navigation/header when printing --}}
    <style type="text/css" media="print">
        nav,
        header,
        button {
            display: none !important;
        }

        .py-12 {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }

        body {
            background-color: white !important;
        }

        .bg-gray-100 {
            background-color: white !important;
        }

        .shadow-xl {
            box-shadow: none !important;
            border: 2px solid #ccc !important;
        }
    </style>
</x-app-layout>
