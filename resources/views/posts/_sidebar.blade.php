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
        <i class="fas fa-sort-amount-up"></i>
        置顶
    </div>
    <div class="card-body footer-grap text-deal">
        @if(count($tops))
        @foreach($tops as $key=>$top)
            <p class="text-deal">{{ $key+1 }}. <a href="{{ $top->link() }}">{{ $top->title }}</a> </p>
        @endforeach
            @else
            <p class="text-center">暂无数据</p>
        @endif
    </div>
</div>
<div class="card">
    <div class="card-header text-center sidebar-header">
        <i class="fab fa-hotjar"></i>
        最热
    </div>
    <div class="card-body footer-grap text-deal">
        @foreach($hots as $key=>$hot)
            <p class="text-deal">{{ $key+1 }}. <a href="{{ $hot->link() }}">{{ $hot->title }}</a> </p>
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