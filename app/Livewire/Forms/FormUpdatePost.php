<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormUpdatePost extends Form
{
    public string $titulo = '';

    public ?Post $post = null;

    #[Validate(['nullable', 'image', 'max:2048'])]
    public $imagen;

    #[Validate(['required', 'string', 'min:5', 'max:500'])]
    public string $contenido = '';

    #[Validate(['required', 'in:Publicado,Borrador'])]
    public string $estado = '';

    #[Validate(['required', 'array', 'min:1', 'exists:tags,id'])]
    public array $atags = [];

    public function setPost(Post $post)
    {
        $this->post = $post;
        $this->titulo = $post->titulo;
        $this->contenido = $post->contenido;
        $this->estado = $post->estado;
        $this->atags = $post->tags()->pluck('tags.id')->toArray();
    }

    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'min:3', 'max:100', 'unique:posts,titulo,'.$this->post->id],
        ];
    }

    public function formUpdatePost()
    {
        $datos = $this->validate();
        $datos['imagen'] = $this->imagen?->store('img/posts') ?? $this->post->imagen;
        $this->post->update($datos);
        $this->post->tags()->sync($this->atags);
    }

    public function formCancelar()
    {
        $this->resetValidation();
        $this->reset();
    }
}
