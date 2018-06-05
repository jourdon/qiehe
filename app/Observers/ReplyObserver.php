<?php

namespace App\Observers;

use App\Jobs\NotifySomeone;
use App\Models\Reply;
use App\Models\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function  created(Reply $reply)
    {
        //回复数增加
        $reply->post->increment('reply_count',1);
        //队列通知作者或At的某人
        dispatch(new NotifySomeone($reply));
    }

    public function deleted(Reply $reply)
    {
        $reply->post->decrement('reply_count',1);
    }

}