<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CrearTag extends Component
{
    public bool $openCrear = false;

    #[Rule(['required', 'string', 'min:3', 'max:20', 'unique:tags,nombre'])]
    public string $nombre = '';

    #[Rule(['required', 'color_hex'])]
    public string $color = '';

    public function render()
    {
        return view('livewire.crear-tag');
    }

    public function crear()
    {
        $datos = $this->validate();
        Tag::create($datos);
        $this->dispatch('mensaje', 'Categoria guardada');
        $this->dispatch('onCreateTag')->to(Tags::class);
        $this->cancelar();
    }

    public function cancelar()
    {
        $this->reset();
        $this->resetValidation();
    }
}
