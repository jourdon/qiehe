<li class="media">
    <a href="{{ route('users.show', $notification->data['user_id']) }}">
        <img class="mr-3 img-thumbnail" alt="{{ $notification->data['user_name'] }}" src="{{ $notification->data['user_avatar'] }}"  style="width:48px;height:48px;"/>
    </a>

    <div class="media-body">
        <h5 class=mt-0">
            <a href="{{ route('users.show', $notification->data['user_id']) }}">{{ $notification->data['user_name'] }}</a>
            评论了
            <a href="{{ $notification->data['post_link'] }}">{{ $notification->data['post_title'] }}</a>

            {{-- 回复删除按钮 --}}
            <span class="meta pull-right" title="{{ $notification->created_at }}">
                <span class="far fa-clock" aria-hidden="true"></span>
                {{ $notification->created_at->diffForHumans() }}
            </span>
        </h5>
        <p>
            {!! $notification->data['reply_content'] !!}
        </p>
    </div>
</li>
<hr>
