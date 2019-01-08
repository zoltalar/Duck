<?php

namespace App\Observers;

use App\Post;

class PostObserver
{
    /**
     * Post deleted observer.
     *
     * @param   Post $post
     * @return  void
     */
    public function deleted(Post $post)
    {
        if ( ! empty($post->photo)) {
            \Storage::disk('public')->delete($post->photo);
        }
    }
}
