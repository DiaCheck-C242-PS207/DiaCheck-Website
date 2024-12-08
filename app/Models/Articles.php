<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'thumbnail',
        'body'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
