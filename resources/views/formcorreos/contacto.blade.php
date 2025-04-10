<x-app-layout>
    <x-propios.base>
        <h3 class="text-center my-4 text-xl text-bold italic">Formulario de Contacto</h3>
        <div class="p-8 rounded-2xl shadow-2xl border-1 border-slate-600 w-1/2 mx-auto">
            <form action="{{ route('contacto.send') }}" method="POST">
                @csrf
                <x-label value="Nombre" />
                <x-input name="nombre" class="w-full mt-2" value="{{ @old('nombre') }}" />
                <x-input-error for="nombre" />
                @guest
                    <x-label value="Email" class="mt-4" />
                    <x-input type="text" name="email" class="w-full mt-2" value="{{ @old('email') }}" />
                    <x-input-error for="email" />
                @endguest
                <x-label value="Comentarios" class="mt-4" />
                <textarea class="w-full mt-2 rounded-lg" rows=6 name="contenido">{{ @old('email') }}</textarea>
                <x-input-error for="contenido" />
                <div class="mt-4 flex flex-row-reverse gap-2">
                    <x-button type="submit">Enviar</x-button>
                    <a href="/"
                        class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent
                     rounded-md font-semibold text-xs text-white uppercase tracking-widest
                      hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none
                       focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50
                        transition ease-in-out duration-150">Cancelar</a>
                    <x-button type="reset" class="bg-green-600">Borrar</x-button>
                </div>
            </form>
        </div>
    </x-propios.base>
</x-app-layout>
