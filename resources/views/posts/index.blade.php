@extends('layouts.app')

@section('title', isset($category)?$category->name:'博文列表')

@section('content')

    <div class="row">
        <div class="col-lg-8 col-md-9 post-list">

            @if (isset($category))
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">{{ $category->name }} </a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $category->description }}</li>
                    </ol>
                </nav>
            @endif
            {{-- 话题列表 --}}
            @include('posts._post_list', ['posts' => $posts])
        </div>

        <div class="col-lg-4 col-md-3 sidebar">
            @include('posts._sidebar')
        </div>
    </div>

@endsection