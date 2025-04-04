<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        $imagenAntigua = $post->getOriginal('imagen');
        $imagen = $post->imagen;
        if (basename($imagenAntigua) != basename($imagen) && basename($imagenAntigua) != 'default.png') {
            Storage::delete($imagenAntigua);
        }
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        if (basename($post->imagen) != 'default.png') {
            Storage::delete($post->imagen);
        }
    }

    public function deleting(Post $post): void {}

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
