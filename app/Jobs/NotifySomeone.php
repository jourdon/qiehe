<?php

namespace App\Jobs;

use App\Models\Reply;
use App\Models\User;
use App\Notifications\PostReplied;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use Auth;

class NotifySomeone implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected  $reply;
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    public function handle()
    {
        //作者ID
        $post_user_id =$this->reply->post->user->id;

        //回复者
        $reply_id=$this->reply->user->id;

        //匹配@ 返回body 和reply_user_id
        $AtData=$this->reply->matchAt($this->reply);

        //更新 @ body 和被回复ID 取第一个
        $this->reply->update([
            'body'  => $AtData['body'],
            'reply_user_id' =>  $AtData['reply_user_id'][0]??$post_user_id,
        ]);
        //被AT的人中去除作者
        $user_ids=array_filter($AtData['reply_user_id'],function($item) use ($post_user_id,$reply_id){
            return $item != $post_user_id && $item != $reply_id;
        });

        //通知被@的人
        $users=User::find($user_ids);

        $users->each(function($item,$key){
            $item->notify(new PostReplied($this->reply));
        });

        //通知作者
        $this->reply->post->user->notify(new PostReplied($this->reply,true));

    }
}
