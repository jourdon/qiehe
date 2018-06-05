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
        $body=$this->reply->body;
        //作者ID
        $post_user_id =$this->reply->post->user->id;
        //匹配@ 返回body 和reply_user_id
        $AtData=matchAt($this->reply,$body);

        //更新 @ body 和被回复ID
        $this->reply->update([
            'body'  => $AtData['body'],
            'reply_user_id' =>  $AtData['reply_user_id'][0]??$post_user_id,
        ]);
        //通知作者
        //作者和At的人合并并且去重
        $AtData['reply_user_id'][]=$post_user_id;
        $reply_user_id=array_unique($AtData['reply_user_id']);
        $key = array_search($this->reply->user->id, $reply_user_id);
        if ($key !== false)  array_splice($reply_user_id, $key, 1);

        //通知作者或被@的人
        Notification::send(User::find($reply_user_id),new PostReplied($this->reply));
        \Log::info('通知成功');
    }
}
