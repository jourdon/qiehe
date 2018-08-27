<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Cache;

class Model extends EloquentModel
{
    protected $expire_id = 3660;

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'desc');
    }

    public function modelSlugCache($model)
    {
        $expire_id = $this->expire_id;
        $data = $model::all();
        $data->filter(function($item) use ($expire_id){
            Cache::put($item->getTable().'_'.$item->slug,$item->id,$expire_id);
        });
    }
}
