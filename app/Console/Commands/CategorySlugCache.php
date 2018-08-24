<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class CategorySlugCache extends Command
{

    protected $signature = 'qiehe:category-slug-cache';

    protected $description = '分类Slug生成缓存';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle(Category $category)
    {
        // 在命令行打印一行信息
        $this->info("开始生成缓存...");

        $category->categorySlugCache();

        $this->info("成功存入！");
    }
}
