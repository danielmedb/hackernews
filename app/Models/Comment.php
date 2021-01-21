<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'post_id',
        'reply_to',
        'commentable_id',
        'commentable_type'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'reply_to');
    }

    public function commentLikes()
    {
        return $this->hasMany(CommentLike::class);
    }

    public function topCommentLikes()
    {
        return $this->hasMany(Vote::class);
    }

    public function likedBy(User $user)
    {
        return $this->commentLikes->contains('user_id', $user->id);
    }

    public function userVoted()
    {
        return $this->hasOneThrough(CommentLike::class, User::class, 'id', 'user_id');
    }
}
