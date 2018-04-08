<?php

use App\Models\Tag;

return [
    'title'   => '标签',
    'single'  => '标签',
    'model'   => Tag::class,

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
            'title'    => 'slug',
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
    ],
    'filters' => [
        'id' => [
            'title' => '标签 ID',
        ],
        'title' => [
            'title' => '名称',
        ],

    ],
    // 新建和编辑时的表单验证规则
    'rules' => [
        'title' => 'required|max:15|unique:tags,title',
    ],

    // 表单验证错误时定制错误消息
    'messages' => [
        'title.required' => '标签不能为空',
        'title.unique' => '标签已存在',
    ]
];