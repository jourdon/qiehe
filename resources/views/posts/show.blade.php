@extends('layouts.app')

@section('title', $post->title)
@section('description', $post->excerpt)

@section('content')

    <div class="row">
        <div class="col-lg-8  post-list">
            <div class="card">
                @if($post->thumbnail)
                    <div class="">
                        <img  class="card-img-top" src="{{ $post->thumbnail }}" alt="Card image cap">
                    </div>
                @endif
                <div class="card-header">
                    <div class="float-left title-left">
                        <i class="fas fa-bars text-grep"></i> <a href="{{ route('categories.show', $post->category->id) }}" class="card-link" title="{{ $post->category->name }}">{{ $post->category->name }}</a>
                        <span class="text-grap">   /  {{ $post->updated_at->diffForHumans() }}</span>
                        <h2 class="card-title" style="padding-top: 10px">
                            {{ $post->title }}
                        </h2>
                    </div>

                    <div class="d-flex flex-wrap align-items-end flex-column">

                        <div class="p-2">
                            <i class="fas fa-tags"></i>
                            @foreach($post->tags()->get() as $tag)
                            <a href="#" class="badge badge-danger btn-red" >{{ $tag->title }}</a>
                                @endforeach
                        </div>
                        <div class="p-2">
                            <i class="fas fa-user"></i> <a href="{{ route('users.show', [$post->user_id]) }}" class="card-link text-right text-red">{{ $post->user->name }}</a>
                        </div>
                        <div class="p-2">
                            <span class="text-grap"><i class="fas fa-eye"></i>
                                {{ $post->view_count }} /
                                <i class="fas fa-comment-alt"></i>
                                {{ $post->reply_count }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="markdown" >
                        <p>
                            {!! clean(ParsedownExtra::instance()->text($post->body),'user_post_body') !!}
                        </p>
                    </div>
                </div>
                    @can('update',$post)
                        <div class="card-footer footer-grap">
                            <div class="float-right">
                                <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-default btn-xs" role="button">
                                        <i class="far fa-edit"></i> 编辑
                                    </a>
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-default btn-xs">
                                        <i class="far fa-trash-alt"></i>
                                        删除
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endcan
            </div>
            {{-- 用户回复列表 --}}
            <div class="card">
                <div class="card-body">
                    @include('posts._reply_box', ['post' => $post])
                    @include('posts._reply_list', ['replies' => $post->replies()->with('user')->get()])
                </div>
            </div>
        </div>
        <div class="col-lg-4 sidebar">
            @include('posts._sidebar')
        </div>
    </div>
@stop

@section('scripts')
    <script src="https://cdn.bootcss.com/showdown/1.8.6/showdown.js"></script>
    <script>
        function OnInput(event){
            $('#preview-box').show();
            var converter = new showdown.Converter();
            var html = converter.makeHtml(event.target.value);
            console.log(event.target.value);
            console.log(html);
            $("#preview-box").html(html);
        }
    </script>
    @endsection