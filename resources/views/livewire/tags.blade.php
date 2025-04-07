<x-propios.base>
    <h3 class="mb-2 text-center font-semibold text-2xl">Gestionar Tags</h3>
    <div class="flex my-2 w-full justify-between items-center">
        <div class="w-1/2">
            <x-input type="search" placeholder="Buscar..." wire:model.live="search" class="w-full" />
        </div>
        <div>
            @livewire('crear-tag')
        </div>
    </div>
    @if (!$tags->isEmpty())
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('id')">
                            ID<i class="ml-2 fas fa-sort"></i>
                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('nombre')">
                            NOMBRE<i class="ml-2 fas fa-sort"></i>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            COLOR
                        </th>
                        <th scope="col" class="px-6 py-3">
                            ACCIONES
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->id }}
                            </th>
                            <td class="px-6 py-4" wire:click="ordenar('nombre')">
                                {{ $item->nombre }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="p-2 rounded-xl text-center font-bold uppercase text-white"
                                    style="background-color: {{ $item->color }}">
                                    {{ $item->color }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="edit({{ $item->id }})" class="mr-2">
                                    <i class="fas fa-edit text-2xl"></i>
                                </button>
                                <button wire:click="confirmarBorrar({{ $item->id }})">
                                    <i class="fas fa-trash text-2xl"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    @else
        <x-propios.alerta>
            No se encontró ningúna etiqueta o aun no ha creado ninguna.
        </x-propios.alerta>
    @endif
    <!-- ------------------------------------------ MODAL UPDATE TAG ------------------------------- -->
    @if (!is_null($tag))
        <x-dialog-modal wire:model="openModalEditar" maxWidth='2xl'>
            <x-slot name="title">
                Editar Etiqueta
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
                        wire:click="update" wire:loading.remove>
                        <i class="fas fa-edit mr-2"></i>Editar
                    </button>
                    <button class="p-2 bg-red-500 hover:bg-red-700 text-white font-bold uppercase rounded-lg"
                        wire:click="cancelar">
                        <i class="fas fa-xmark mr-2"></i>Cancelar
                    </button>

                </div>
            </x-slot>
        </x-dialog-modal>
    @endif
</x-propios.base>
