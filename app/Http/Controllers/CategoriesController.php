<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Link;
use App\Models\Post;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    public function show(Category $category,Post $post)
    {
        $posts = $post->with('user','category','tags')
            ->where('category_id',$category->id)
            ->paginate(5);
        return view('posts.index',compact('posts','category'));
    }
}
