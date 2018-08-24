<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthorizationsController extends Controller
{
    use RedirectsUsers;
    public function socialStore($type,Request $request)
    {
        if (!in_array($type, ['qq'])) {
            return redirect('login')->with('danger', '第三方接口错误，请重试！');
        }
        return Socialite::with($type)->redirect();
    }

    public function callback($type,Request $request)
    {
        $oauthUser = Socialite::with($type)->user();

        switch ($type) {
            case 'qq':
                $user = User::where('openid', $oauthUser->getId())->where('platform','qq')->first();
                if(!$user) {
                    $user = User::create([
                        'name' => $oauthUser->getNickname(),
                        'avatar' => $oauthUser->getAvatar(),
                        'openid' => $oauthUser->getId(),
                        'platform' => 'qq',
                        'status' => 0,
                    ]);
                    event(new Registered($user));
                }
                break;
        }
        Auth::guard()->login($user);
        return redirect($user->email?'/':url('users/'.$user->id.'/edit'));
    }
}
