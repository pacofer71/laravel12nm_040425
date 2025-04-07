<div>
    <button class="p-2 bg-slate-500 hover:bg-slate-700 text-white font-bold uppercase rounded-lg"
        wire:click="$set('openCrear', true)">
        <i class="fas fa-add mr-2"></i>NUEVA
    </button>
    <x-dialog-modal wire:model="openCrear" maxWidth='2xl'>
        <x-slot name="title">
            Crear Etiqueta
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Nombre" class="mb-1" />
                <x-input type="text" class="w-full" wire:model="nombre" />
                <x-input-error for="nombre" />
            </div>
            <div class="">
                <x-label value="Color" class="mb-1" />
                <x-input type="color" class="w-full" wire:model="color" />
                <x-input-error for="color" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse gap-2">
                <button class="p-2 bg-slate-500 hover:bg-slate-700 text-white font-bold uppercase rounded-lg"
                    wire:click="crear" wire:loading.remove>
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
