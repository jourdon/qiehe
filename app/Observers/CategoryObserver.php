<?php

namespace App\Observers;

use App\Jobs\TranslateSlug;
use App\Models\Category;
use Cache;

class  CategoryObserver
{
    // 在保存时清空 cache_key 对应的缓存
    public function saved(Category $category)
    {
        Cache::forget($category->cache_key);

        //如 sulg 字段无内容 即时用翻译器对title 进行翻译
        if(!$category->slug){
            //推送任到进队列
            dispatch(new TranslateSlug($category));
        }
    }
    public function updated(Category $category)
    {
        //如果有更新标题更新slug
        if($category->getOriginal('title')!=$category->title){
            //推送任到进队列
            dispatch(new TranslateSlug($category));
        }
    }
}