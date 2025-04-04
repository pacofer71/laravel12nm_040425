<div>
    <button class="p-2 bg-slate-500 hover:bg-slate-700 text-white font-bold uppercase rounded-lg"
        wire:click="$set('openCrear', true)">
        <i class="fas fa-add mr-2"></i>NUEVO
    </button>
    <x-dialog-modal maxWidth='4xl' wire:model='openCrear'>
        <x-slot name="title">
            Nuevo Post
        </x-slot>

        <x-slot name="content">
            <x-label for="titulo" value="Título" />
            <x-input type="text" id="titulo" class="w-full mt-1" wire:model="cform.titulo" />
            <x-input-error for="cform.titulo" />

            <x-label for="contenido" class="mt-2" value="Contenido" />
            <textarea rows='5' id="contenido" class="w-full mt-1 rounded-lg" wire:model="cform.contenido"></textarea>
            <x-input-error for="cform.contenido" />

            <x-label class="mt-2" value="Estado" />
            <div class="flex items-center space-x-4">
                <!-- Radio Button: Publicado -->
                <label class="flex items-center">
                    <input type="radio" name="estado" value="Publicado" class="form-radio text-blue-500 h-4 w-4"
                        wire:model="cform.estado">
                    <span class="ml-2 text-gray-700">Publicado</span>
                </label>

                <!-- Radio Button: Borrador -->
                <label class="flex items-center">
                    <input type="radio" name="estado" value="Borrador" class="form-radio text-blue-500 h-4 w-4"
                        wire:model="cform.estado">
                    <span class="ml-2 text-gray-700">Borrador</span>
                </label>
            </div>
            <x-input-error for="cform.estado" />

            <x-label class="mt-2" value="Etiquetas" />
            <div class="flex items-center space-x-4 mt-1">
                <!-- Check: Tags -->
                @foreach ($tags as $tag)
                    <label class="flex items-center">
                        <input type="checkbox" value="{{ $tag->id }}" class="form-checkbox text-blue-500 h-4 w-4"
                            wire:model="cform.atags">
                        <span class="ml-2 text-gray-700">#{{ $tag->nombre }}</span>
                    </label>
                @endforeach
            </div>
            <x-input-error for="cform.atags" />

            <!-- Imagen -->
            <x-label class="mt-2 mb-1" value="Imagen" />
            <div class="w-full h-80 bg-slate-200 rounded-lg relative">
                <input type="file" class="hidden" accept="image/*" id="cimagen" wire:model="cform.imagen" />
                <label for="cimagen"
                    class="p-2 absolute bottom-2 end-2 rounded-xl font-bold uppercase bg-purple-600 hover:bg-purple-800 text-white">
                    <i class="fas fa-upload mr-2"></i>Subir
                </label>
                @if ($cform->imagen)
                    <img src="{{ $cform->imagen->temporaryUrl() }}"
                        class="size-full object-cover object-center bg-no-repeat" />
                @endif

            </div>
            <x-input-error for="cform.imagen" />

        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-row-reverse gap-2">
                <button class="p-2 bg-slate-500 hover:bg-slate-700 text-white font-bold uppercase rounded-lg"
                    wire:click="create()" wire:loading.remove>
                    <i class="fas fa-save mr-2"></i>Guardar
                </button>
                <button class="p-2 bg-red-500 hover:bg-red-700 text-white font-bold uppercase rounded-lg"
                    wire:click="cancelar">
                    <i class="fas fa-xmark mr-2"></i>Cancelar
                </button>

            </div>
        </x-slot>
    </x-dialog-modal>
</div>
