<?php

namespace App\Http\ViewComposers;
use App\Models\Link;
use App\Models\Post;
use App\Models\Reply;
use App\Models\Tag;
use Illuminate\View\View;

class SidebarViewComposer
{
    protected  $post;
    protected  $link;
    protected  $reply;
    public function __construct(Post $post,Link $link,Reply $reply)
    {
        $this->post = $post;
        $this->link = $link;
        $this->reply = $reply;
    }

    public function compose(View $view)
    {
        $new_replies = $this->reply->with('user','post')->latest()->take(10)->get();
        $hots = $this->post->orderBy('top','desc')->orderBy('view_count','desc')->limit(10)->get();
        $links = $this->link->getAllCached();
        $tags=Tag::all();
        //$view->with('sidebar',[$hots,$tops,$links]);
        $view->with('new_replies',$new_replies);
        $view->with('hots',$hots);
        $view->with('links',$links);
        $view->with('tags',$tags);
    }
}