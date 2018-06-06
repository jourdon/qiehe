@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <h4 class="card-header header-line">
                <i class="far fa-edit"></i>编辑个人资料
            </h4>

            @include('common.error')

            <div class="card-body">

                <form action="{{ route('users.update', $user->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="name-field">用户名</label>
                        <input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $user->name ) }}" />
                    </div>
                    <div class="form-group">
                        <label for="email-field">邮 箱</label>
                        <input class="form-control" type="text" name="email" id="email-field" value="{{ old('email', $user->email ) }} " placeholder="填写Email后，有用户回复时可邮箱通知您!" />
                    </div>
                    <div class="form-group">
                        <label for="introduction-field">个人简介</label>
                        <textarea name="introduction" id="introduction-field" class="form-control" rows="3">{{ old('introduction', $user->introduction ) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="avatar-label">用户头像</label>
                        <input type="file" name="avatar">

                        @if($user->avatar)
                            <br>
                            <img class="img-thumbnail rounded" src="{{ $user->avatar }}" width="200" />
                        @endif
                    </div>
                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection