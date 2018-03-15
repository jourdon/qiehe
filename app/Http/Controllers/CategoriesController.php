<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Link;
use App\Models\Post;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    public function show(Category $category,Post $post,Link $link)
    {
        $posts = $post->where('category_id',$category->id)->paginate(5);
        $hots = $post->orderBy('view_count','desc')->limit(10)->get();
        $tops = $post->where('top',1)->orderBy('updated_at','desc')->limit(10)->get();
        $links = $link->getAllCached();
        return view('posts.index',compact('posts','category','hots','tops','links'));
    }
}
