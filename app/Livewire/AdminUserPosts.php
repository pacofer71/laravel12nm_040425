<?php

namespace App\Livewire;

use App\Livewire\Forms\FormUpdatePost;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AdminUserPosts extends Component
{
    use WithFileUploads;
    use WithPagination;

    public string $buscar = '';

    public string $orden = 'desc';

    public string $campo = 'id';

    public bool $openUpdate = false;

    public FormUpdatePost $uform;

    #[On('onCreate')]
    public function render()
    {
        $posts = Post::where('user_id', Auth::id())
            ->where(function ($q) {
                $q->where('titulo', 'like', "%{$this->buscar}%")
                    ->orwhere('contenido', 'like', "%{$this->buscar}%")
                    ->orWhere('estado', 'like', "%{$this->buscar}%")
                    ->orWhereHas('tags', function ($q1) {
                        $q1->where('nombre', 'like', "%{$this->buscar}%");
                    });
            })
            ->orderBy($this->campo, $this->orden)
            ->paginate(4);

        $tags = Tag::orderBy('nombre')->get();

        return view('livewire.admin-user-posts', compact('posts', 'tags'));
    }

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function ordenar(string $campo)
    {
        $this->orden = ($this->orden == 'desc') ? 'asc' : 'desc';
        $this->campo = $campo;
    }

    public function cambiarEstado(int $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('update', $post);
        $estado = $post->estado == 'Publicado' ? 'Borrador' : 'Publicado';
        $post->update(compact('estado'));
    }

    public function confirmarBorrar(int $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('delete', $post);
        $this->dispatch('globalOnDelete', $id);
    }

    #[On('onDelete')]
    public function borrar(int $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('delete', $post);
        $post->delete();
        // el borrado de la imagen lo controla un observer
        $this->dispatch('mensaje', 'Post Borrado');
    }

    // --------------------------------------------------------------------------------------
    public function edit(int $id)
    {
        $post = Post::findOrfail($id);
        $this->authorize('update', $post);
        $this->uform->setPost($post);
        $this->openUpdate = true;
    }

    public function update()
    {
        $this->uform->formUpdatePost();
        $this->dispatch('mensaje', 'Post editado');
        $this->cancelar();
    }

    public function cancelar()
    {
        $this->uform->formCancelar();
    }
}
