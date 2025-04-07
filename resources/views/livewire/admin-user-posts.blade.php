<x-propios.base>
    <h3 class="mb-2 text-center font-semibold text-2xl">Gestionar Posts</h3>
    <div class="flex my-2 w-full justify-between items-center">
        <div class="w-1/2">
            <x-input type="search" placeholder="Buscar..." wire:model.live="buscar" class="w-full" />
        </div>
        <div>
            @livewire('crear-post')
        </div>
    </div>
    @if (!$posts->isEmpty())
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-16 py-3">
                            <span class="sr-only">Imagen</span>
                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('titulo')">
                            Título<i class="ml-1 fas fa-sort"></i>
                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('contenido')">
                            Contenido<i class="ml-1 fas fa-sort"></i>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tags
                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('estado')">
                            Estado<i class="ml-1 fas fa-sort"></i>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $item)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="p-4">
                                <img src="{{ Storage::url($item->imagen) }}" class="w-16 md:w-32 max-w-full max-h-full"
                                    alt="">
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white italic">
                                {{ $item->titulo }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->contenido }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                <ul class="flex flex-wrap gap-2">
                                    @foreach ($item->tags as $tag)
                                        <li class="inline-flex items-center justify-center w-32 h-6">
                                            <span
                                                class="flex items-center justify-center w-full h-full px-2 py-1 rounded-xl text-white"
                                                style="background-color: {{ $tag->color }}">
                                                #{{ $tag->nombre }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-6 py-4">
                                <button @class([
                                    'p-2 rounded-xl text-white uppercase font-bold border-2 border-blue-400',
                                    'bg-red-500 hover:bg-red-700' => $item->estado == 'Borrador',
                                    'bg-green-500 hover:bg-green-700' => $item->estado == 'Publicado',
                                ]) wire:click="cambiarEstado({{ $item->id }})">
                                    {{ $item->estado }}
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button wire:click="edit({{ $item->id }})" class="mr-1">
                                    <i class="fas fa-edit text-xl"></i>
                                </button>
                                <button wire:click="confirmarBorrar({{ $item->id }})">
                                    <i class="fas fa-trash text-red-500 text-xl"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-1">
            {{ $posts->links() }}
        </div>
    @else
        <x-propios.alerta>
            No se encontró ningún post o aun no ha creado ninguno.
        </x-propios.alerta>
    @endif
    <!-------------------------------     Update Post    ------------------------------------------------- -->
    @if (!is_null($this->uform->post))
        <x-dialog-modal maxWidth='4xl' wire:model='openUpdate'>
            <x-slot name="title">
                Editar Post
            </x-slot>

            <x-slot name="content">
                <x-label for="titulo" value="Título" />
                <x-input type="text" id="titulo" class="w-full mt-1" wire:model="uform.titulo" />
                <x-input-error for="uform.titulo" />

                <x-label for="contenido" class="mt-2" value="Contenido" />
                <textarea rows='5' id="contenido" class="w-full mt-1 rounded-lg" wire:model="uform.contenido"></textarea>
                <x-input-error for="uform.contenido" />

                <x-label class="mt-2" value="Estado" />
                <div class="flex items-center space-x-4">
                    <!-- Radio Button: Publicado -->
                    <label class="flex items-center">
                        <input type="radio" name="estado" value="Publicado" class="form-radio text-blue-500 h-4 w-4"
                            wire:model="uform.estado">
                        <span class="ml-2 text-gray-700">Publicado</span>
                    </label>

                    <!-- Radio Button: Borrador -->
                    <label class="flex items-center">
                        <input type="radio" name="estado" value="Borrador" class="form-radio text-blue-500 h-4 w-4"
                            wire:model="uform.estado">
                        <span class="ml-2 text-gray-700">Borrador</span>
                    </label>
                </div>
                <x-input-error for="uform.estado" />

                <x-label class="mt-2" value="Etiquetas" />
                <div class="flex items-center space-x-4 mt-1 overflow-scroll p-6">
                    <!-- Check: Tags -->
                    @foreach ($tags as $tag)
                        <label class="flex items-center">
                            <input type="checkbox" value="{{ $tag->id }}"
                                class="form-checkbox text-blue-500 h-4 w-4" wire:model="uform.atags">
                            <span class="ml-2 text-gray-700">#{{ $tag->nombre }}</span>
                        </label>
                    @endforeach
                </div>
                <x-input-error for="uform.atags" />

                <!-- Imagen -->
                <x-label class="mt-2 mb-1" value="Imagen" />
                <div class="w-full h-80 bg-slate-200 rounded-lg relative">
                    <input type="file" class="hidden" accept="image/*" id="uimagen"
                        wire:model="uform.imagen" />
                    <label for="uimagen"
                        class="p-2 absolute bottom-2 end-2 rounded-xl font-bold uppercase bg-purple-600 hover:bg-purple-800 text-white">
                        <i class="fas fa-upload mr-2"></i>Subir
                    </label>
                    @if ($uform->imagen)
                        <img src="{{ $uform->imagen->temporaryUrl() }}"
                            class="size-full object-cover object-center bg-no-repeat" />
                    @else
                        <img src="{{ Storage::url($uform->post->imagen) }}"
                            class="size-full object-cover object-center bg-no-repeat" />
                    @endif

                </div>
                <x-input-error for="uform.imagen" />

            </x-slot>

            <x-slot name="footer">
                <div class="flex flex-row-reverse gap-2">
                    <button class="p-2 bg-slate-500 hover:bg-slate-700 text-white font-bold uppercase rounded-lg"
                        wire:click="update()" wire:loading.remove>
                        <i class="fas fa-editar mr-2"></i>Editar
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
