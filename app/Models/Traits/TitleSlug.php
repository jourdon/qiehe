<?php

namespace App\Models\Traits;

use Cache;
use Artisan;

trait TitleSlug
{
    //返回模型的主键 改写为返回模型slug
    public function getRouteKey()
    {
        if (!$this->slug) {
            return $this->id;
        }
        return $this->slug;
    }

    //路由模型绑定中间件通过参数查找模型，
    //中间键默认通过模型主键查询的， 改为通过slug查询缓存或数据库拿到id再进行查询
    public function resolveRouteBinding($value)
    {
        $id=Cache::get($this->getTable().'_'.$value,function()use ($value){
            Artisan::queue('qiehe:'.str_singular($this->getTable()).'-slug-cache');
            return self::where('slug',$value)->pluck('id')->first();
        });
        if(!$id) {
            return parent::resolveRouteBinding($value);
        }
        return parent::resolveRouteBinding($id);
    }
}