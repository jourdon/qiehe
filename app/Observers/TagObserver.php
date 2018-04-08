<?php

namespace App\Observers;

use App\Jobs\TranslateSlug;
use App\Models\Tag;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TagObserver
{

    public function saved(Tag $tag)
    {
        //如 sulg 字段无内容 即时用翻译器对title 进行翻译
        if(!$tag->slug){
            //推送任到进队列
            dispatch(new TranslateSlug($tag));
        }
    }
    public function updated(Tag $tag)
    {
        if($tag->getOriginal('title')!=$tag->title){
            //推送任到进队列
            dispatch(new TranslateSlug($tag));
        }
    }
}