<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reply;
use App\Http\Requests\ReplyRequest;
use App\Models\User;
use App\Notifications\PostReplied;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function store(ReplyRequest $request,Reply $reply)
	{
        $reply->user_id = Auth::id();
        $reply->post_id = $request->post_id;
        $reply->body = $request->body;
        $re=$reply->save();
        $email = $request->email;
        if($email && $re) {
            User::find(Auth::id())->update(['email' => $email]);
        }
        return redirect()->to($reply->post->link())->with('message', '创建成功.');
	}

	public function destroy(Reply $reply)
	{
		$this->authorize('destroy', $reply);
		$reply->delete();

		return redirect()->to($reply->post->link())->with('message', '删除成功！.');
	}
}