<div class="max-w-4xl mx-auto p-6 bg-white shadow-xl rounded-lg my-8">
    <div class="relative mb-6 w-full">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-2">{{ __('Revisión de Solicitud') }}</h1>
        <p class="text-lg text-gray-600 mb-6">{{ __('Administra y revisa los detalles de la solicitud de documento.') }}</p>
        <div class="border-b border-gray-200 my-4"></div> {{-- Equivalente a flux:separator --}}
    </div>

    <div class="mb-6">
        <a href="{{ route('documentreviews.index') }}" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-teal-300 to-lime-300 group-hover:from-teal-300 group-hover:to-lime-300 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-lime-800">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">
                Regresar a Revisiones
            </span>
        </a>
    </div>

    <div class="bg-gray-50 p-6 rounded-lg shadow-inner space-y-4">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Detalles de la Solicitud</h3>

        {{-- Información del usuario --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Usuario:</label>
            <p class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $documentRequest->user->name }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Correo:</label>
            <p class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $documentRequest->user->email }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Tipo de Documento:</label>
            <p class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $documentRequest->documentType->nombre }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Fecha de Solicitud:</label>
            <p class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $documentRequest->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Estado Actual:</label>
            <p class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ ucfirst($documentRequest->estado) }}</p>
        </div>
    </div>

    <div class="mt-8 bg-gray-50 p-6 rounded-lg shadow-inner">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Archivos Adjuntos:</h3>
        @if ($documentRequest->files->isNotEmpty())
            <ul class="list-disc list-inside space-y-3 pl-5 text-gray-700">
                @foreach ($documentRequest->files as $file)
                    <li>
                        <span class="font-medium">{{ $file->requirement->nombre }}:</span>
                        <a href="{{ Storage::url($file->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline ml-2">
                            Ver archivo
                            <i class="fas fa-external-link-alt ml-1"></i> {{-- Icono de enlace externo (requiere Font Awesome) --}}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">No hay archivos adjuntos para esta solicitud.</p>
        @endif
    </div>

    <div class="mt-8 bg-white p-6 rounded-lg shadow">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Acciones de Revisión:</h3>

        <div class="mb-4">
            <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Observaciones (opcional):</label>
            <textarea wire:model.defer="descripcion" id="descripcion" rows="4"
                class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm resize-y"
                placeholder="Añade cualquier observación o comentario sobre la revisión..."></textarea>
        </div>

        <div class="mb-4">
            <label for="pdf_respuesta" class="block text-sm font-medium text-gray-700 mb-1">Subir Documento de Respuesta (PDF):</label>
            <input type="file" wire:model="pdf_respuesta" id="pdf_respuesta"
                class="block w-full text-sm text-gray-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0 file:text-sm file:font-semibold
                file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer" />
            @error('pdf_respuesta') <span class="mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col sm:flex-row gap-4 mt-6">
            <button wire:click="aprobar"
                class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150">
                <i class="fas fa-check-circle mr-2"></i> Aprobar Solicitud
            </button>

            <button wire:click="rechazar"
                class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition ease-in-out duration-150">
                <i class="fas fa-times-circle mr-2"></i> Rechazar Solicitud
            </button>
        </div>
    </div>

    {{-- Mensajes de Sesión --}}
    @if (session()->has('success'))
        <div class="mt-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
</div>