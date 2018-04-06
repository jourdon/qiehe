<?php

namespace App\Http\ViewComposers;
use App\Models\Link;
use App\Models\Post;
use Illuminate\View\View;

class SidebarViewComposer
{
    protected  $post;
    protected  $link;
    public function __construct(Post $post,Link $link)
    {
        $this->post = $post;
        $this->link = $link;
    }

    public function compose(View $view)
    {
        $hots = $this->post->orderBy('view_count','desc')->limit(10)->get();
        $tops = $this->post->where('top',1)->orderBy('updated_at','desc')->limit(10)->get();
        $links = $this->link->getAllCached();
        //$view->with('sidebar',[$hots,$tops,$links]);
        $view->with('hots',$hots);
        $view->with('tops',$tops);
        $view->with('links',$links);
    }
}