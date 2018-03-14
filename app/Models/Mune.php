<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mune extends Model
{
    protected $fillable = [
        'title', 'name_en','parent_id','icon','href'
    ];
    static public function tree()
    {
        $data=self::select('id','title','name_en')
            ->where('parent_id',0)
            ->get()
            ->toArray();
        foreach ($data as $val){
            $re=self::select('title','icon','href')
                ->where('parent_id',$val['id'])
                ->get()
                ->toArray();
            unset($val['id']);
            unset($val['title']);
            $list[$val['name_en']]=$re;
        }
        //dd($list);
        return $list;
    }
}