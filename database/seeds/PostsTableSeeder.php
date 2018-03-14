<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        $user_ids= \App\Models\User::all()->pluck('id')->toArray();

        $category_ids= \App\Models\Category::all()->pluck('id')->toArray();

        // 生成数据集合
        $posts = factory(\App\Models\Post::class)
            ->times(30)
            ->make()
            ->each(function ($posts, $index)
            use ($faker, $user_ids,$category_ids)
            {
                // 从头像数组中随机取出一个并赋值
                $posts->user_id = $faker->randomElement($user_ids);
                $posts->category_id = $faker->randomElement($category_ids);
                $posts->status = $faker->randomElement([0,1]);
                $posts->look = $faker->randomElement([0,1]);
                $posts->top = $faker->randomElement([0,1]);
            });

        // 插入到数据库中
        \App\Models\Post::insert($posts->toArray());
    }
}
