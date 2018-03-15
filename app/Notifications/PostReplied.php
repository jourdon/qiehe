<?php

namespace App\Notifications;

use App\Models\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PostReplied extends Notification implements ShouldQueue
{
    use Queueable;

    public $reply;

    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    public function via($notifiable)
    {
        //开启通知频道，mail,database
        return ['database','mail'];
    }

    public function toMail($notifiable)
    {
        $url =$this->reply->post->link(['#reply'.$this->reply->id]);
        return (new MailMessage)
                    ->line('你的文章有新回复！')
                    ->action('查看回复', $url);
    }

    public function toDatabase($notifiable)
    {
        $post = $this->reply->post;
        $link = $post->link(['#reply'.$this->reply->id]);
        return [
            'reply_id'  =>  $this->reply->id,
            'reply_content'  =>  $this->reply->content,
            'user_id'  =>  $this->reply->user->id,
            'user_name'  =>  $this->reply->user->name,
            'user_avatar'  =>  $this->reply->user->avatar,
            'post_link'  =>  $link,
            'post_id'   => $post->id,
            'post_title'  =>  $post->title,
        ];
    }
}
