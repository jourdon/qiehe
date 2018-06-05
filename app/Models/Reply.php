<?php

namespace App\Models;

class Reply extends Model
{
    protected $fillable = [ 'body','reply_user_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
