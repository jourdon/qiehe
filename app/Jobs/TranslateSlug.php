<?php

namespace App\Jobs;

use App\Handlers\SlugTranslateHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TranslateSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $model;

    public function __construct($model)
    {
        // 队列任务构造器中接收了 Eloquent 模型，将会只序列化模型的 ID
        $this->model = $model;
    }

    public function handle()
    {
        //请求百度 API 接口进行翻译
        $slug = app(SlugTranslateHandler::class)->translate($this->model->title);
        //为了避免模型监控器死循环调用
        $this->model->where('id',$this->model->id)->update(['slug'=>$slug]);
    }
}
