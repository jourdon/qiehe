<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Models\User;
use App\Models\Post;

class ReplysTableSeeder extends Seeder
{
    public function run()
    {
        //所有用户ID
        $user_ids = User::all()->pluck('id')->toArray();
        //所有文章id
        $post_ids = Post::all()->pluck('id')->toArray();

        $faker = app(\Faker\Generator::class);

        $replys = factory(Reply::class)
            ->times(100)
            ->make()
            ->each(function ($reply, $index)
            use ($user_ids,$post_ids,$faker)
            {
                //随机回复用户
                $reply->user_id = $faker ->randomElement($user_ids);
                //随机被回复用户
                $reply->reply_user_id = $faker ->randomElement($user_ids);
                //随机文章
                $reply->post_id = $faker ->randomElement($post_ids);
            });
        // 将数据集合转换为数组，并插入到数据库
        Reply::insert($replys->toArray());
    }

}

