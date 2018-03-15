<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //获取登录用户所有通知
        $notifications = Auth::user()->notifications()->paginate(10);
        Auth::user()->markAsRead();
        //标记为已读，未读清零
        return view('notifications.index',compact('notifications'));
    }
}
