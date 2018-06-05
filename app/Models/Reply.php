<?php

namespace App\Models;

class Reply extends Model
{
    protected $fillable = [ 'body','reply_user_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function matchAt($reply){
        $userModel=new \App\Models\User();
        $body = $reply->body;
        $reply_user_id=[];
        preg_match_all("/@.*?(?=( |$))/",$body,$matched_name);
        foreach($matched_name[0] as $key=> $name) {
            $name=substr($name,1);
            $user_id  =$userModel->where('name','like binary',$name)->value('id');
            if(!$user_id) {
                continue;
            }
            $reply_user_id[$key]=$user_id;
            $body=str_replace('@'.$name,'[@'.$name.']('.config('app.url').'/users/'.$reply_user_id[$key].')',$body);
            $userModel->getAtCached($name,$reply->user->id);
        }
        return [
            'body'  => $body,
            'reply_user_id' =>  $reply_user_id
        ];
    }
}
