<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Tags extends Component
{
    public string $campo = 'nombre';

    public string $orden = 'asc';

    public string $search = '';

    public string $nombre = '';

    public ?Tag $tag = null;

    public bool $openModalEditar = false;

    #[Rule(['required', 'color_hex'])]
    public string $color = '';

    #[On('onCreateTag')]
    public function render()
    {
        $tags = Tag::where('nombre', 'like', "%{$this->search}%")
            ->orderBy($this->campo, $this->orden)
            ->get();

        return view('livewire.tags', compact('tags'));
    }

    public function ordenar(string|int $campo)
    {
        $this->orden = ($this->orden == 'desc') ? 'asc' : 'desc';
        $this->campo = $campo;
    }

    public function confirmarBorrar(int $id)
    {
        $tag = Tag::findOrFail($id);
        $this->dispatch('globalOnBorrarTag', $id);
    }

    #[On('onDelete')]
    public function delete(int $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
    }

    // -------------------------------------  Update

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'min:3', 'max:20', 'unique:tags,nombre,'.$this->tag->id],
        ];
    }

    public function edit(int $id)
    {
        $tag = Tag::findOrFail($id);
        $this->tag = $tag;
        $this->nombre = $tag->nombre;
        $this->color = $tag->color;
        $this->openModalEditar = true;
    }

    public function update()
    {
        $datos = $this->validate();
        $this->tag->update($datos);
        $this->dispatch('mensaje', 'Tag actualizado');
        $this->cancelar();
    }

    public function cancelar()
    {
        $this->reset(['openModalEditar', 'tag', 'nombre', 'color']);
    }
}
