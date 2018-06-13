<ul class="list-unstyled">
    @foreach ($replies as $index => $reply)
        <li class="media"  name="reply{{ $reply->id }}" id="reply{{ $reply->id }}">
            <a href="{{ route('users.show', [$reply->user_id]) }}">
                <img class="mr-3 img-thumbnail" alt="{{ $reply->user->name }}" src="{{ $reply->user->avatar }}"  style="width:48px;height:48px;"/>
            </a>

            <div class="media-body markdown">
                <h5 class="mt-0">
                    <a href="{{ route('users.show', [$reply->user_id]) }}" title="{{ $reply->user->name }}">
                        {{ $reply->user->name }}
                    </a>
                    <span> •  </span>
                    <span class="meta" title="{{ $reply->created_at }}">{{ $reply->created_at->diffForHumans() }}</span>


                    <span class="meta float-right footer-grap form-inline">
                        <a role="button" class="btn btn-default btn-xs" href="javascript:;" onclick="replyOne('{{ $reply->user->name }}')" title="回复 {{ $reply->user->name }}">
                                <i class="fa fa-reply"></i>
                            </a>
                        {{-- 回复删除按钮 --}}
                        @can('destroy',$reply)
                        <form action="{{ route('replies.destroy', $reply->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-default btn-xs">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                        @endcan
                    </span>

                 </h5>
                <p>
                    {!! clean(ParsedownExtra::instance()->text($reply->body),'user_post_body') !!}
                </p>
            </div>
        </li>
        <hr>
    @endforeach
</ul>