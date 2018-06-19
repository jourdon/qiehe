@if (count($replies))

    <ul class="list-group list-group-flush">
        @foreach ($replies as $reply)
            <li class="list-group-item">
                <a href="{{ $reply->post->link(['#reply' . $reply->id]) }}">
                    {{ $reply->post->title }}
                    <div class="meta float-right text-grap">
                        <span class="far fa-clock" aria-hidden="true"></span> 回复于 {{$reply->created_at->diffForHumans() }}
                    </div>
                </a>

                <div class="reply-content" style="margin: 6px 0;">
                    {!! clean(ParsedownExtra::instance()->text($reply->body),'user_post_body') !!}
                </div>

            </li>
        @endforeach
    </ul>

@else
    <div class="empty-block">暂无数据 ~_~ </div>
@endif

{{-- 分页 --}}
{!! $replies->appends(Request::except('page'))->render() !!}