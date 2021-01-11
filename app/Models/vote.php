<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{

    protected $fillable = [
        'vote',
        'post_id',
        'user_id'
    ];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function voteUser()
    {
        return $this->belongsTo(User::class);
    }

    public function topVotes()
    {
        return $this->belongsTo(Post::class);
    }
}
