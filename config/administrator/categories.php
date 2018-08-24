<?php

use App\Models\Category;

return [
    'title'   => '分类',
    'single'  => '分类',
    'model'   => Category::class,

    // 对 CRUD 动作的单独权限控制，其他动作不指定默认为通过
    'action_permissions' => [
        // 删除权限控制
        'delete' => function () {
            // 只有站长才能删除话题分类
            return Auth::user()->hasRole('Founder');
        },
    ],

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'title' => [
            'title'    => '名称',
            'sortable' => false,
        ],
        'slug' => [
            'title'    => 'Slug',
            'sortable' => false,
        ],
        'description' => [
            'title'    => '描述',
            'sortable' => false,
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'title' => [
            'title' => '名称',
        ],
        'slug' => [
            'title' => 'Slug',
        ],
        'description' => [
            'title' => '描述',
            'type'  => 'textarea',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => '分类 ID',
        ],
        'title' => [
            'title' => '名称',
        ],
        'description' => [
            'title' => '描述',
        ],
    ],
    'rules'   => [
        'title' => 'required|min:1|unique:categories'
    ],
    'messages' => [
        'title.unique'   => '分类名在数据库里有重复，请选用其他名称。',
        'title.required' => '请确保名字至少一个字符以上',
    ],
];