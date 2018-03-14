<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\ImageUploadHandler;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function users(User $users,Request $request)
    {
        $data= [
            'code'  =>  0,
            'msg'   =>  '',
            'count' =>  0,
            'data'  =>'',
        ];

        $data['count']=$users->count();

        $page=$request->page?:1;
        $limit=$request->limit?:config('services.limit');
        $data['data']=$users->skip($limit*($page-1))->take($limit)->get();
        //$data=$user->skip($limit*($page-1))->take($limit)->get()->toArray();
        return $data;
    }

    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return 'create';
    }

    public function store(Request $request)
    {
        return 'store';
    }

    public function show($id)
    {
        return 'show';
    }

    public function edit(User $user)
    {
        return view('users.create_and_edit',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data=$request->all();
        $user->update($data);
        return response(['code'=>1,'msg'=>$user,'data'=>$data,]);
    }

    public function destroy($id)
    {
        //
    }

    public function imageUpload(Request $request,ImageUploadHandler $upload)
    {
        $data= [
            'code'  =>  0,
            'msg'   =>  '',
            'data'  =>  ['src'  => '']
        ];

        if($request->file){
            $result=$upload->save($request->file, 'avatar', \Auth::id(),$max_width = 200);
            // 图片保存成功的话
            if ($result) {
                $data['data']['src'] = $result['path'];
                $data['msg'] = "上传成功!";
            }
        }
        return $data;
    }
}
