<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\PostReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function  created(Reply $reply)
    {
        //回复数增加
        $post = $reply->post;
        $post->increment('reply_count',1);
        //通知作者
        $post->user->notify(new PostReplied($reply));
    }

    public function deleted(Reply $reply)
    {
        $reply->post->decrement('reply_count',1);
    }

}