<?php

namespace App\Observers;

use App\Jobs\TranslateSlug;
use App\Models\Post;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class PostObserver
{
    public function saving(Post $post)
    {
        //XSS过滤
        //$post->title = clean($post->title,'user_post_body');
        //$post->body = clean($post->body,'user_post_body');
        //生成帖子摘要
        if(!$post->excerpt){
            $post->excerpt = make_excerpt($post->body);
        }
    }
    public function saved(Post $post)
    {
        //如 sulg 字段无内容 即时用翻译器对title 进行翻译
        if(!$post->slug){
            //推送任到进队列
            dispatch(new TranslateSlug($post));
        }
    }
    public function updated(Post $post)
    {
        //如果有更新标题更新slug
        if($post->getOriginal('title')!=$post->title){
            //推送任到进队列
            dispatch(new TranslateSlug($post));
        }
    }

}