<?php

namespace App\Http\Controllers;

use App\Events\BlogView;
use App\Handlers\ImageUploadHandler;
use App\Models\Category;
use App\Models\Link;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Post $post)
	{
		$posts = $post
            ->with('user','category','tags')
            ->orderBy('created_at','desc')
            ->paginate(5);
		return view('posts.index', compact('posts'));
	}

    public function show(Request $request,Post $post)
    {
        event(new BlogView($post));
        // URL 矫正
        if ( ! empty($post->slug) && $post->slug != $request->slug) {
            return redirect($post->link(), 301);
        }
        return view('posts.show', compact('post'));
    }

	public function create(Post $post)
	{
	    $this->authorize('create',$post);
	    $categories = Category::all();
        $tags = Tag::pluck('id','name');
        return view('posts.create_and_edit', compact('post','categories','tags'));
	}

	public function store(PostRequest $request,Post $post,ImageUploadHandler $uploader)
	{
        $this->authorize('create',$post);
		$post->fill($request->all());
        $post->user_id = Auth::id();
        if($request->thumbnail) {
            $result = $uploader->save($request->thumbnail,'thumbnail',$post->id,728);
            if($result) {
                $post->thumbnail=$result;
            }
        }
        $post->save();
        return redirect()->to($post->link())->with('message', '创建成功.');
	}

	public function edit(Post $post)
	{
        $this->authorize('update', $post);
        $categories = Category::all();
        $tags = Tag::pluck('id','title');
        return view('posts.create_and_edit', compact('post','categories','tags'));
	}

	public function update(PostRequest $request, Post $post,ImageUploadHandler $uploader)
	{
		$this->authorize('update', $post);
        $data=$request->all();
        $post->tags()->sync($request->tags,true);
        if($request->thumbnail) {
            $result = $uploader->save($request->thumbnail,'thumbnail',$post->id,728);
            if($result) {
                $data['thumbnail']=$result;
            }
        }
		$post->update($data);
		return redirect()->to($post->link())->with('message', '编辑成功.');
	}

	public function destroy(Post $post)
	{
		$this->authorize('destroy', $post);
		$post->delete();

		return redirect()->route('posts.index')->with('message', '删除成功.');
	}

	public function upload(Request $request,Post $post,ImageUploadHandler $uploader)
    {
        $result = $uploader->save($request->file,'post',$post->id,728);
        return ['filename'=>$result];
    }
}