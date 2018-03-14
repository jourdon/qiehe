<?php

use Illuminate\Database\Seeder;

class MunesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
                'title' =>'内容管理',
                'name_en'   =>  'contentManagement',
                'parent_id' =>  0,
                'icon'  =>  '&#xe63c;',
                'href'  =>  '',
                'created_at'    =>  time(),
                'updated_at'    =>  time(),
            ],
            [
                'title' =>'用户中心',
                'name_en'   =>  'memberCenter',
                'parent_id' =>  0,
                'icon'  =>  '&#xe612;',
                'href'  =>  '',
                'created_at'    =>  time(),
                'updated_at'    =>  time(),
            ],
            [
                'title' =>'系统设置',
                'name_en'   =>  'systemeSttings',
                'parent_id' =>  0,
                'icon'  =>  '&#xe620;',
                'href'  =>  '',
                'created_at'    =>  time(),
                'updated_at'    =>  time(),
            ],
            [
                'title' =>'使用文档',
                'name_en'   =>  'seraphApi',
                'parent_id' =>  0,
                'icon'  =>  '&#xe705;',
                'href'  =>  '',
                'created_at'    =>  time(),
                'updated_at'    =>  time(),
            ],
            [
                'title' =>'文章列表',
                'name_en'   =>  '',
                'parent_id' =>  1,
                'icon'  =>  'icon-text',
                'href'  =>  '/admin/posts',
                'created_at'    =>  time(),
                'updated_at'    =>  time(),
            ],
            [
                'title' =>'图片管理',
                'name_en'   =>  '',
                'parent_id' =>  1,
                'icon'  =>  '&#xe634;',
                'href'  =>  '/error',
                'created_at'    =>  time(),
                'updated_at'    =>  time(),
            ],
            [
                'title' =>'其他页面',
                'name_en'   =>  '',
                'parent_id' =>  1,
                'icon'  =>  '&#xe630;',
                'href'  =>  '/error',
                'created_at'    =>  time(),
                'updated_at'    =>  time(),
            ],
            [
                'title' =>'404页面',
                'name_en'   =>  '',
                'parent_id' =>  1,
                'icon'  =>  'icon-text',
                'href'  =>  '/error',
                'created_at'    =>  time(),
                'updated_at'    =>  time(),
            ],
            [
                'title' =>'登录',
                'name_en'   =>  '',
                'parent_id' =>  1,
                'icon'  =>  '&#xe609;',
                'href'  =>  '/error',
                'created_at'    =>  time(),
                'updated_at'    =>  time(),
            ],
            [
                'title' =>'用户中心',
                'name_en'   =>  '',
                'parent_id' =>  2,
                'icon'  =>  '&#xe609;',
                'href'  =>  '/admin/users',
                'created_at'    =>  time(),
                'updated_at'    =>  time(),
            ],
            [
                'title' =>'会员等级',
                'name_en'   =>  '',
                'parent_id' =>  2,
                'icon'  =>  '&#xe609;',
                'href'  =>  '/error',
                'created_at'    =>  time(),
                'updated_at'    =>  time(),
            ],
            [
                'title' =>'系统基本参数',
                'name_en'   =>  '',
                'parent_id' =>  3,
                'icon'  =>  '&#xe609;',
                'href'  =>  '/error',
                'created_at'    =>  time(),
                'updated_at'    =>  time(),
            ],
            [
                'title' =>'系统日志',
                'name_en'   =>  '',
                'parent_id' =>  3,
                'icon'  =>  '&#xe609;',
                'href'  =>  '/error',
                'created_at'    =>  time(),
                'updated_at'    =>  time(),
            ],
            [
                'title' =>'友情链接',
                'name_en'   =>  '',
                'parent_id' =>  3,
                'icon'  =>  '&#xe609;',
                'href'  =>  '/error',
                'created_at'    =>  time(),
                'updated_at'    =>  time(),
            ],
            [
                'title' =>'图标管理',
                'name_en'   =>  '',
                'parent_id' =>  3,
                'icon'  =>  '&#xe609;',
                'href'  =>  '/error',
                'created_at'    =>  time(),
                'updated_at'    =>  time(),
            ],
            [
                'title' =>'三级联动模块',
                'name_en'   =>  '',
                'parent_id' =>  4,
                'icon'  =>  '&#xe609;',
                'href'  =>  '/error',
                'created_at'    =>  time(),
                'updated_at'    =>  time(),
            ],
            [
                'title' =>'bodyTab模块',
                'name_en'   =>  '',
                'parent_id' =>  4,
                'icon'  =>  '&#xe609;',
                'href'  =>  '/error',
                'created_at'    =>  time(),
                'updated_at'    =>  time(),
            ],
            [
                'title' =>'三级菜单',
                'name_en'   =>  '',
                'parent_id' =>  4,
                'icon'  =>  '&#xe609;',
                'href'  =>  '/error',
                'created_at'    =>  time(),
                'updated_at'    =>  time(),
            ],

        ];
        foreach($data as $item){
            \App\Models\Mune::create($item);
        }

    }
}
