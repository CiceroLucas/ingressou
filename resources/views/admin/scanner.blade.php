<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leitor de Ingresso na Portaria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Feedback Messages --}}
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-sm" role="alert" id="success-alert">
                    <strong class="font-bold block text-lg mb-1">ENTRADA LIBERADA!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative shadow-sm" role="alert" id="error-alert">
                    <strong class="font-bold block text-lg mb-1">ACESSO NEGADO</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <svg class="w-12 h-12 text-red-500 absolute top-1/2 right-4 transform -translate-y-1/2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            @endif

            {{-- Scanner Main Interface --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-10 text-center">
                    <h3 class="text-xl font-medium text-gray-900 mb-6">Aponte a Câmera para o QR Code</h3>

                    {{-- Reader Container --}}
                    <div id="reader" class="mx-auto rounded-lg overflow-hidden border-4 border-dashed border-gray-300 w-full max-w-[500px]"></div>

                    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                        <p class="text-sm text-gray-500">
                            A leitura do ingresso redirecionará automaticamente para validação.
                        </p>
                        
                        {{-- Fallback input for manual code entry (optional UX enhancement) --}}
                        <div class="hidden">
                            <input type="text" id="manual-code" placeholder="Código do Ingresso" class="border-gray-300 rounded-md shadow-sm text-sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- html5-qrcode Library --}}
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Dismiss alerts after 5 seconds to clear the screen for next scanning
            setTimeout(() => {
                const alerts = document.querySelectorAll('#success-alert, #error-alert');
                alerts.forEach(alert => {
                    alert.style.transition = "opacity 0.5s ease";
                    alert.style.opacity = "0";
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);

            // Scanner Initialization
            function onScanSuccess(decodedText, decodedResult) {
                // Assuming decodedText is the full validation URL: https://.../admin/validate-ticket/{code}
                // Stop the scanner to prevent multiple rapid reads
                html5QrcodeScanner.clear();
                
                // Add loading state feedback
                document.getElementById('reader').innerHTML = `
                    <div class="flex flex-col items-center justify-center p-12 h-[300px]">
                        <svg class="animate-spin h-10 w-10 text-neutral-900 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <p class="text-gray-600 font-medium tracking-wide">Validando Ingresso...</p>
                    </div>`;

                // Redirect to actual URL. The backend handles validation and redirects back here.
                window.location.href = decodedText;
            }

            function onScanFailure(error) {
                // handle scan failure, usually better to ignore and keep scanning
                // console.warn(`Code scan error = ${error}`);
            }

            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader",
                { fps: 10, qrbox: {width: 250, height: 250} },
                /* verbose= */ false
            );

            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        });
    </script>

    <style>
        /* Customizing html5-qrcode ugly default buttons via CSS since it lacks extensive JS theming */
        #reader {
            background-color: #f9fafb;
        }
        #reader__dashboard_section_csr button {
            background-color: #4f46e5;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 10px;
        }
        #reader__dashboard_section_csr button:hover {
            background-color: #4338ca;
        }
        #reader select {
            border-color: #d1d5db;
            border-radius: 4px;
            padding: 4px;
            margin-bottom: 10px;
        }
    </style>
</x-app-layout>
