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

    public function voteUser()
    {
        return $this->belongsTo(User::class);
    }

}
