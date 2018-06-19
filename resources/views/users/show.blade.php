@extends('layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')

    <div class="row">

        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
            <div class="card">
                <img class="card-img-top img-thumbnail rounded" src="{{ $user->avatar }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><strong>个人简介</strong></h5>
                    <p class="card-text">{{ $user->introduction }}</p>
                </div>
                <hr/>
                <div class="card-body">
                    <h5 class="card-title"><strong>注册于</strong></h5>
                    <p class="card-text">{{ $user->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-body">
                <span>
                    <h1 class="card-title pull-left" style="font-size:30px;">{{ $user->name }} <small>{{ $user->email }}</small></h1>
                </span>
                </div>
            </div>
            <hr>

            {{-- 用户发布的内容 --}}
            <div class="card" >
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(if_query('tab', null)) }}" href="{{ route('users.show', $user->id) }}">Ta的文章</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(if_query('tab', 'replies')) }}" href="{{ route('users.show', [$user->id, 'tab' => 'replies']) }}">Ta的回复</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body card-font " style="padding-top: 0px;">
                    @if (if_query('tab', 'replies'))
                        @include('users._replies', ['replies' => $user->replies()->with('post')->orderBy('updated_at','desc')->paginate(5)])
                    @else
                        @include('users._posts', ['posts' => $user->posts()->orderBy('created_at','desc')->paginate(5)])
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop