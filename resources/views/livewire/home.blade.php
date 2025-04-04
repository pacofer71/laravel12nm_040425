<div class="bg-purple-950 min-h-screen flex flex-col items-center py-8">
    <!-- Contenedor principal -->
    <div class="w-full max-w-4xl space-y-6">

        <!-- Card de Post -->
        @foreach ($posts as $item)
            <div class="bg-white rounded-xl shadow-2xl overflow-hidden border-2 border-white">
                <img src="{{ Storage::url($item->imagen) }}" alt="Imagen del post" class="w-full h-[48] object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $item->titulo }}</h2>
                    <p class="text-gray-600 mb-4 italic">{{ $item->contenido }}</p>

                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach ($item->tags as $tag)
                            <span class="px-3 py-1 rounded-full text-sm font-semibold text-white"
                                style="background-color: {{ $tag->color }}">#{{ $tag->nombre }}</span>
                        @endforeach

                    </div>

                    <!-- Autor -->
                    <div class="flex justify-between">
                        <div class="flex items-center text-gray-500 text-sm">
                            <i class="fa-solid fa-user text-gray-400 mr-2"></i>
                            <span>Autor: {{ $item->user->email }}</span>
                        </div>
                        <div class="flex items-center text-sm text-green-700">
                            <i class="fa-solid fa-calendar-days text-gray-400 mr-2"></i>
                            <span>Publicado el:<span class="italic"> {{ $item->updated_at->format('d/m/Y h:i:s') }}
                                </span></span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
