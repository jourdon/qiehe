<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['show']]);
    }

    public function show (User $user)
    {
        return view('users.show',compact('user'));
    }
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit',compact('user'));
    }
    public function update(UserRequest $request,User $user,ImageUploadHandler $uploader)
    {
        $this->authorize('update', $user);
        $data=$request->all();

        if($request->avatar) {
            $result = $uploader->save($request->avatar,'avatars',$user->id,362);
            if($result) {
                $data['avatar']=$result;
            }
        }
        if($user->status==0) $data['status']=1;
        $user->update($data);
        return redirect()->route('users.show',$user->id)->with('success','个人资料更新成功');
    }

    public function usersJson()
    {
        $cache_key = \Auth::id().'_userJson';
        $users=\Cache::get($cache_key);
        return response()->json($users);
    }

    public function cacheAt(Request $request)
    {
        if(!$request->name) {
            return false;
        }
        $users=\Auth::user()->getAtCached($request->name,\Auth::id());

        return ['msg'=>'缓存成功','data'=>$users];
    }
}
