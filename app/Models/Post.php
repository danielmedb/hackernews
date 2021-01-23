<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'comment',
        'source',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function replyComments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function topVotes()
    {
        return $this->hasMany(Vote::class);
    }

    public function likedBy(User $user)
    {
        return $this->votes->contains('user_id', $user->id);
    }

    public function userVoted()
    {
        return $this->hasOneThrough(Vote::class, User::class, 'id', 'user_id');
    }
}
