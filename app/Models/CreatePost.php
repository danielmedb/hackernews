<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatePost extends Model
{
    use HasFactory;


    protected $fillable = [
        'body',
        'source'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
