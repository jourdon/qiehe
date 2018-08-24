<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'title'        => 'PHP',
                'description' => '这是最好的言，谁有意见',
            ],
            [
                'title'        => '前端',
                'description' => '作为一个后端，前端知识也是要了解一下滴',
            ],
            [
                'title'        => 'Linux',
                'description' => '服务器不懂可不行哦',
            ],
            [
                'title'        => 'Other',
                'description' => '其它分类的技术都在这里',
            ],
            [
                'title'        => '技术之外',
                'description' => '除了技术还是要有点其它东西的',
            ],
        ];

        Db::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
}
