<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('admin.events.index') }}" class="text-neutral-900 hover:text-neutral-800 mr-3 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Editar Evento') }}: {{ $event->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="mb-6">
                            <x-input-label for="title" :value="__('Título do Evento')" />
                            <x-text-input id="title" name="title" type="text"
                                          class="mt-1 block w-full" :value="old('title', $event->title)"
                                          required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        {{-- Description --}}
                        <div class="mb-6">
                            <x-input-label for="description" :value="__('Descrição')" />
                            <textarea id="description" name="description" rows="4"
                                      class="mt-1 block w-full border-gray-300 focus:border-neutral-900 focus:ring-neutral-900 rounded-md shadow-sm"
                                      required>{{ old('description', $event->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        {{-- Date & Location --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-input-label for="event_date" :value="__('Data e Hora')" />
                                <x-text-input id="event_date" name="event_date" type="datetime-local"
                                              class="mt-1 block w-full"
                                              :value="old('event_date', $event->event_date->format('Y-m-d\TH:i'))"
                                              required />
                                <x-input-error :messages="$errors->get('event_date')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="location" :value="__('Local')" />
                                <x-text-input id="location" name="location" type="text"
                                              class="mt-1 block w-full" :value="old('location', $event->location)"
                                              required />
                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Current Banner --}}
                        @if($event->banner_path)
                            <div class="mb-4">
                                <x-input-label :value="__('Banner Atual')" />
                                <div class="mt-2 relative inline-block">
                                    <img src="{{ asset($event->banner_path) }}"
                                         alt="{{ $event->title }}"
                                         class="h-32 w-auto rounded-lg object-cover shadow-sm">
                                </div>
                            </div>
                        @endif

                        {{-- Banner Upload --}}
                        <div class="mb-6">
                            <x-input-label for="banner" :value="$event->banner_path ? __('Substituir Banner') : __('Banner do Evento')" />
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-neutral-900 transition-colors">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="banner" class="relative cursor-pointer bg-white rounded-md font-medium text-neutral-900 hover:text-neutral-800 focus-within:outline-none">
                                            <span>Enviar nova imagem</span>
                                            <input id="banner" name="banner" type="file" class="sr-only" accept="image/*">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, WEBP até 2MB</p>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('banner')" class="mt-2" />
                        </div>

                        {{-- Submit --}}
                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('admin.events.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
                                Cancelar
                            </a>
                            <x-primary-button>
                                {{ __('Salvar Alterações') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
