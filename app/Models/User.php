<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password','is_admin','avatar','status','ip','last_login_in','user_agent','sex'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
     * 访问器是 访问属性时 修改，
     * 修改器是在 写入数据库前 修改。
     * 修改器是数据持久化，访问器是临时修改
     *
     * 以下为修改器
     * 注意命名规范是 set{属性的驼峰式命名}Attribute
     */
    public function setPasswordAttribute($value)
    {
        // 如果值的长度等于 60，即认为是已经做过加密的情况
        if (strlen($value) != 60) {

            // 不等于 60，做密码加密处理
            $value = bcrypt($value);
        }
        $this->attributes['password'] = $value;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
