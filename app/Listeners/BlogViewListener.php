<?php

namespace App\Listeners;

use App\Events\BlogView;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Session\Store;

class BlogViewListener implements ShouldQueue
{
     protected  $session;
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  BlogView  $event
     * @return void
     */
    public function handle(BlogView $event)
    {
        $post = $event->post;
        //先进行判断是否已经查看过
        if(!$this->hasViewedBlog($post)) {
            //保存到数据库
            $post->view_count += 1;
            $post->save();
            //看过之后将保存到Session
            $this->storeViewedBlog($post);
        }
    }
    protected function hasViewedBlog($post)
    {
        return array_key_exists($post->id,$this->getViewedBlog());
    }
    protected function getViewedBlog()
    {
        return $this->session->get('Viewed_Blogs',[]);
    }
    protected function storeViewedBlog($post)
    {
        $key = 'Viewed_Blogs.'.$post->id;
        $this->session->put($key,time());
    }
}
