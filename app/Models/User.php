<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profileimage',
        'biography',
        'password_token',
    ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function vote()
    {
        return $this->hasMany(Vote::class);
    }

    public function hasVotes()
    {
        return $this->belongsTo(Vote::class);
    }

    public function commentLike()
    {
        return $this->hasMany(CommentLike::class);
    }

    public function hasCommentLikes()
    {
        return $this->belongsTo(CommentLike::class);
    }

    public function following()
    {
        return $this->hasMany(Following::class);
    }
}
