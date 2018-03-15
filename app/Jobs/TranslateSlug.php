<?php

namespace App\Jobs;

use App\Handlers\SlugTranslateHandler;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class TranslateSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $post;

    public function __construct(Post $post)
    {
        // 队列任务构造器中接收了 Eloquent 模型，将会只序列化模型的 ID
        $this->post = $post;
    }

    public function handle()
    {
        //请求百度 API 接口进行翻译
        $slug = app(SlugTranslateHandler::class)->translate($this->post->title);
        //为了避免模型监控器死循环调用
        DB::table('posts')->where('id',$this->post->id)->update(['slug'=>$slug]);
    }
}
