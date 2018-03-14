<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function posts(Request $request)
    {
        $data= [
            'code'  =>  0,
            'msg'   =>  '',
            'count' =>  0,
            'data'  =>'',
        ];
        $posts=new Post();
        $data['count']=$posts->count();

        $page=$request->page?:1;
        $limit=$request->limit?:config('services.limit');
        $data['data']=$posts->skip($limit*($page-1))->take($limit)->get();
        foreach($data['data'] as $key=>$item){
            $data['data'][$key]['user_name']=$item->user->name;
            $data['data'][$key]['category_name']=$item->category->name;
            unset($data['data'][$key]['user']);
            unset($data['data'][$key]['category']);
            unset($data['data'][$key]['user_id']);
            unset($data['data'][$key]['category_id']);
        }
        //$data=$user->skip($limit*($page-1))->take($limit)->get()->toArray();
        return $data;
    }
    public function index()
    {
        return view('posts.index');
    }
}
