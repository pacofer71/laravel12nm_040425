<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormCrearPost extends Form
{
    #[Validate(['nullable', 'image', 'max:2048'])]
    public $imagen;

    #[Validate(['required', 'string', 'min:3', 'max:100', 'unique:posts,titulo'])]
    public string $titulo = '';

    #[Validate(['required', 'string', 'min:5', 'max:500'])]
    public string $contenido = '';

    #[Validate(['required', 'in:Publicado,Borrador'])]
    public string $estado = '';

    #[Validate(['required', 'array', 'min:1', 'exists:tags,id'])]
    public array $atags = [];

    public function formCrearPost()
    {
        $datos = $this->validate();
        $datos['imagen'] = $this->imagen?->store('img/posts') ?? 'img/default.png';
        $datos['user_id'] = Auth::id();
        $post = Post::create($datos);
        $post->tags()->attach($this->atags);
    }

    public function formCancelar()
    {
        $this->resetValidation();
        $this->reset();
    }
}
