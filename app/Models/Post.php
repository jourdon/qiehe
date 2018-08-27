<?php

namespace App\Models;

use App\Models\Traits\TitleSlug;

class Post extends Model
{
    use TitleSlug;
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
        return route('posts.show',array_merge([$this->slug??$this->id],$params));
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
    public function SlugCache()
    {
        $this->modelSlugCache($this);
    }
}
