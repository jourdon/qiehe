<?php

namespace App\Models\Traits;

use Cache;
use Artisan;

trait CategorySlug
{
    //返回模型的主键 改写为返回模型slug
    public function getRouteKey()
    {
        return $this->slug;
    }

    //路由模型绑定中间件通过参数查找模型，
    //中间键默认通过模型主键查询的， 改为通过slug查询缓存或数据库拿到id再进行查询
    public function resolveRouteBinding($value)
    {
        $value=Cache::get('Category_'.$value,function()use ($value){
            Artisan::queue('qiehe:category-slug-cache');
            return self::where('slug',$value)->pluck('id');
        });
        if (!$value) {
            return ;
        }
        return parent::resolveRouteBinding($value);
    }
}