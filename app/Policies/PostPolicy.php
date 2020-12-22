<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function delete(User $user, Post $post){
        return $user->id == $post->user_id;
    }
    
    public function deleteComment(User $user, Comment $comment){
        return $user->id == $comment->user_id;
    }

    public function editComment(User $user, Comment $comment){
        return $user->id == $comment->user_id;
    }

    public function editProfile(User $user){
        return $user->id === auth()->user()->id;
    }
}
