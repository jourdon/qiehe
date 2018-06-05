<?php

namespace App\Http\Requests;

class ReplyRequest extends Request
{
    public function rules()
    {
        return [
            'body' => 'required|min:2',
            'email'   =>  'nullable|email'
        ];

    }

    public function messages()
    {
        return [
            'body.required' => '内容不能为空',
            'body.min' => '内容不能少于两个字',
            'email.email' => 'Email格式不正确。',
        ];
    }
}
