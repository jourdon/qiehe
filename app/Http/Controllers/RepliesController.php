<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


	public function store(ReplyRequest $request,Reply $reply)
	{
		$reply->body = $request->body;
		$reply->user_id = Auth::id();
		$reply->post_id = $request->post_id;
		$reply->save();
		return redirect()->to($reply->post->link())->with('message', '创建成功.');
	}

	public function destroy(Reply $reply)
	{
		$this->authorize('destroy', $reply);
		$reply->delete();

		return redirect()->to($reply->post->link())->with('message', '删除成功！.');
	}
}