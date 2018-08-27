
@if (count($posts))

        @foreach ($posts as $post)
            <div class="card">
            @if($post->thumbnail)
                <a href="{{ $post->link() }}">
                <img class="card-img-top post-img" src="{{ $post->thumbnail }}" alt="Card image">
                </a>
            @endif
                <div class="card-body" style="padding-bottom: 0px" >
                    <div class="float-left">
                        <i class="fas fa-bars text-grep"></i> <a href="{{ route('categories.show', $post->category) }}" class="card-link" title="{{ $post->category->title }}">{{ $post->category->title }}</a>
                        <span class="text-grap">   /  {{ $post->updated_at->diffForHumans() }}</span>
                    </div>
                    <div class="float-right">
                        <i class="fas fa-user"></i>  <a href="{{ route('users.show', [$post->user_id]) }}" class="card-link text-right text-red">{{ $post->user->name }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center"><a href="{{ route('posts.show',$post) }}">{{ $post->title }}</a></h5>
                    <p class="card-text text-grap">
                        {{ $post->excerpt }}
                    </p>
                </div>
                <div class="card-body text-center">
                    <a class="text-grap " href="{{ route('posts.show',$post) }}"><i class="fas fa-hand-point-right"></i>  阅读更多&hellip;</a>
                    <div class="float-right ">
                        <i class="fas fa-tags"></i>
                        @if(count($post->tags))
                        @foreach($post->tags as $tag)
                            <a href="{{ route('tags.show',$tag->slug) }}" class="badge badge-danger btn-red" >{{ $tag->title }}</a>
                        @endforeach
                            @endif
                    </div>
                </div>
                @if($loop->last && $posts->lastPage()!=1)
                    {{-- 分页 --}}
                        <div class="card-footer">
                            {!! $posts->links() !!}
                        </div>
                    @endif
            </div>
        @endforeach
@else
    <div class="card">
        <div class="card-body">
            <h1><i class="far fa-smile"></i>  暂无数据  </h1>
        </div>
    </div>
@endif
