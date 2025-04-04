<?php

namespace App\Livewire;

use App\Livewire\Forms\FormCrearPost;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearPost extends Component
{
    use WithFileUploads;

    public bool $openCrear = false;

    public FormCrearPost $cform;

    public function render()
    {
        $tags = Tag::orderBy('nombre')->get();

        return view('livewire.crear-post', compact('tags'));
    }

    public function create()
    {
        $this->cform->formCrearPost();
        $this->cancelar();
        $this->dispatch('onCreate')->to(AdminUserPosts::class);
        $this->dispatch('mensaje', 'Post Creado');
    }

    public function cancelar()
    {
        $this->openCrear = false;
        $this->cform->formCancelar();
    }
}
