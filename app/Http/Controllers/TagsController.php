<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function show($slug)
    {
        $posts=Tag::where('slug',$slug)
            ->first()
            ->posts()
            ->with('user','category','tags')
            ->paginate(5);
        return view('posts.index',compact('posts','slug'));
    }
}
