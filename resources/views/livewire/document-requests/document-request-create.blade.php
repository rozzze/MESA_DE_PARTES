<form wire:submit.prevent="{{ $currentStep === 1 ? 'goToStep2' : 'submit' }}" enctype="multipart/form-data" class="space-y-6">
    
    {{-- Paso 1: Selección del tipo de documento --}}
    @if ($currentStep === 1)
        <div>
            <flux:heading size="md">Paso 1: Selecciona un tipo de documento</flux:heading>
            <flux:select wire:model="document_type_id" label="Tipo de Documento">
                <option value="">Selecciona un documento</option>
                @foreach ($availableDocuments as $doc)
                    <option value="{{ $doc->id }}">{{ $doc->nombre }}</option>
                @endforeach
            </flux:select>

            @error('document_type_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <div class="mt-6">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Siguiente
                </button>
            </div>
        </div>
    @endif

    {{-- Paso 2: Mostrar requisitos y subir archivos --}}
    @if ($currentStep === 2)
        <div>
            <flux:heading size="md">Paso 2: Sube los requisitos</flux:heading>

            @foreach ($requirements as $req)
                <div class="mb-4">
                    <label class="block mb-1 font-medium">{{ $req->nombre }}</label>

                    <input type="file" wire:model="files.{{ $req->id }}"
                        class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0 file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />

                    @error('files.' . $req->id)
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            @endforeach

            <div class="mt-6 flex justify-between">
                <button type="button"
                    wire:click="goBack"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Atrás
                </button>

                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Enviar Solicitud
                </button>
            </div>
        </div>
    @endif

</form>
