<?php

namespace App\Models;

class Post extends Model
{
    protected $fillable = ['title', 'excerpt', 'thumbnail', 'category_id', 'body', 'slug'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function link($params = [])
    {
        return route('posts.show',array_merge([$this->id,$this->slug],$params));
    }
    //public function getViewCountAttribute($value)
    //{
    //
    //    $this->attributes['view_count']+=1;
    //    $this->save();
    //    return $value;
    //}
}
