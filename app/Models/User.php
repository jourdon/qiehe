<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Cache;
use Auth;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable {
        notify as protected laravelNotify;
    }
    public function notify($instance)
    {
        // 如果要通知的人是当前用户，就不必通知了
        if($this->id==Auth::id()) {
            return ;
        }
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    protected $fillable = [
        'name', 'email', 'password','introduction','avatar','platform','openid','status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }
    public function setPasswordAttribute($value)
    {

        if (strlen($value) != 60) {

            $value = bcrypt($value);
        }
        $this->attributes['password'] = $value;
    }
    public function setAvatarAttribute($path)
    {
        // 如果不是 `http` 子串开头，那就是从后台上传的，需要补全 URL
        if ( ! starts_with($path, 'http')) {

            // 拼接完整的 URL
            $path = config('app.url') . "/uploads/images/avatars/$path";
        }

        $this->attributes['avatar'] = $path;
    }

    public function getAtCached($name,$user_id)
    {
        $cache_key = $user_id.'_userJson';
        $users=Cache::get($cache_key);

        if(!$users || !in_array($name,$users)) {
            $users[] = $name;
        }
        Cache::put($cache_key,$users,now()->addWeeks(1));
        return $users;
    }
}
