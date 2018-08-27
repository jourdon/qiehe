<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class PostSlugCache extends Command
{

    protected $signature = 'qiehe:post-slug-cache';

    protected $description = '文章Slug生成缓存';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle(Post $model)
    {
        // 在命令行打印一行信息
        $this->info("开始生成缓存...");

        $model->SlugCache();

        $this->info("成功存入！");
    }
}
