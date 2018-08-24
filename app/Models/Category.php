<?php

namespace App\Models;

use App\Models\Traits\CategorySlug;
use Illuminate\Database\Eloquent\Model;
use Cache;

class Category extends Model
{
    use CategorySlug;
    protected $fillable= [
        'title','description',
    ];
    public $cache_key = 'blog_categories';
    protected $cache_expire_in_minutes = 1440;

    public function getAllCached()
    {
        // 尝试从缓存中取出 cache_key 对应的数据。如果能取到，便直接返回数据。
        // 否则运行匿名函数中的代码来取出分类，返回的同时做了缓存。
        return Cache::remember($this->cache_key,$this->cache_expire_in_minutes,function(){
            return $this->all();
        });
    }
    public function categorySlugCache()
    {
        $expire_id = $this->cache_expire_in_minutes;
        $categories = self::all();
        $categories->filter(function($category) use ($expire_id){
            Cache::put('Category_'.$category->slug,$category->id,$expire_id);
        });
    }
}
