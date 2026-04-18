<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('admin.events.index') }}" class="text-neutral-900 hover:text-neutral-800 mr-3 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Criar Novo Evento') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Title --}}
                        <div class="mb-6">
                            <x-input-label for="title" :value="__('Título do Evento')" />
                            <x-text-input id="title" name="title" type="text"
                                          class="mt-1 block w-full" :value="old('title')"
                                          required autofocus placeholder="Ex: Anime Festival 2026" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        {{-- Description --}}
                        <div class="mb-6">
                            <x-input-label for="description" :value="__('Descrição')" />
                            <textarea id="description" name="description" rows="4"
                                      class="mt-1 block w-full border-gray-300 focus:border-neutral-900 focus:ring-neutral-900 rounded-md shadow-sm"
                                      required placeholder="Descreva o evento, atrações, programação...">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        {{-- Date & Location --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-input-label for="event_date" :value="__('Data e Hora')" />
                                <x-text-input id="event_date" name="event_date" type="datetime-local"
                                              class="mt-1 block w-full" :value="old('event_date')" required />
                                <x-input-error :messages="$errors->get('event_date')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="location" :value="__('Local')" />
                                <x-text-input id="location" name="location" type="text"
                                              class="mt-1 block w-full" :value="old('location')"
                                              required placeholder="Ex: Centro de Convenções" />
                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Banner Upload --}}
                        <div class="mb-6">
                            <x-input-label for="banner" :value="__('Banner do Evento')" />
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-neutral-900 transition-colors">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="banner" class="relative cursor-pointer bg-white rounded-md font-medium text-neutral-900 hover:text-neutral-800 focus-within:outline-none">
                                            <span>Enviar uma imagem</span>
                                            <input id="banner" name="banner" type="file" class="sr-only" accept="image/*">
                                        </label>
                                        <p class="pl-1">ou arraste e solte</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, WEBP até 10MB</p>
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
                                {{ __('Criar Evento') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
