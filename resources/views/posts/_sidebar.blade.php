<div class="card">
    <div class="card-header text-center sidebar-header">
        <i class="fas fa-tags"></i>
        标签云
    </div>
    <div class="card-body">
        @if(count($tags))
            @foreach($tags as $key=>$tag)
                <a href="{{ route('tags.show',$tag->slug) }}" class="badge badge-danger btn-red tags-list" >
                    {{ $tag->title }}
                        <span class="badge badge-light">{{ count($tag->posts) }}</span>
                        </a>
            @endforeach
        @else
            <p class="text-center">暂无数据</p>
        @endif
    </div>
</div>

<div class="card">
    <div class="card-header text-center sidebar-header">
        <i class="fas fa-pencil-alt"></i>
        最新留言
    </div>
    <div class="card-body footer-grap text-deal">
        @foreach($new_replies as $key=>$reply)
            <p class="text-deal">
                <a href="{{ route('users.show', [$reply->user_id]) }}"><img class="img-fluid img-thumbnail" src="{{$reply->user->avatar }}" style="width:35px;"></a>
                <a href="{{ route('users.show', [$reply->user_id]) }}">{{$reply->user->name}}</a> :
                <a href="{{ $reply->post->link(['#reply'.$reply->id]) }}" title="{!! strip_tags(ParsedownExtra::instance()->text($reply->body)) !!}">{!! strip_tags(ParsedownExtra::instance()->text($reply->body)) !!}</a>
            </p>
        @endforeach
    </div>
</div>

<div class="card">
    <div class="card-header text-center sidebar-header">
        <i class="fab fa-hotjar"></i>
        最热文章
    </div>
    <div class="card-body footer-grap text-deal">
        @foreach($hots as $key=>$hot)
            <p class="text-deal">@if($hot->top)<span class="badge badge-danger btn-red tags-list">置顶</span>@else<i class="fas fa-eye"></i>/{{$hot->view_count}}@endif . <a href="{{ $hot->link() }}" title="{{ $hot->title }}">{{ $hot->title }}</a> </p>
        @endforeach
    </div>
</div>

<div class="card">
    <div class="card-header text-center sidebar-header">
        <i class="fas fa-external-link-alt"></i>
        友情链接
    </div>
    <div class="card-body footer-grap text-deal">
        @foreach($links as $key=>$link)
            <p class="text-deal"><a href="{{ $link->link }}">{{ $link->title }}</a> </p>
        @endforeach
    </div>
</div>