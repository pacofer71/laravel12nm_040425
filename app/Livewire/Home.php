<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $posts = Post::with('user')->where('estado', 'Publicado')->orderBy('id', 'desc')->get();

        return view('livewire.home', compact('posts'));
    }
}
