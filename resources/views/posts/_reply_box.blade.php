@include('common.error')
<div>
    <form action="{{ route('replies.store') }}" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        @if(Auth::check() &&!Auth::user()->email)
            <div class="form-group row">
                <label for="Email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="Email" placeholder="填写Email后，有用户回复时可邮箱通知您!">
                </div>
            </div>
        @endif
        <div class="form-group">
            <textarea class="form-control reply" id="reply-body" rows="5" placeholder="@if(Auth::check())请使用 Markdown 格式书写 ;-)，代码块请标语言,示例如下，否则无高亮
```php
  //代码开始
```
OK！开始你的创作吧！@else 登录后才可回复，马上开始你的创作吧！@endif" name="body" oninput="OnInput(event)" @if(!Auth::check()) disabled @endif></textarea>
        </div>
        <div id="preview-box" class="markdown" style="display:none;"></div>
        @if(Auth::check())
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-share"></i> 回复</button>
        @else
        <a class="btn btn-primary btn-sm btn-white" href="/login" role="button"><i class="fas fa-sign-in-alt"></i> 登录</a>
        @endif
    </form>
</div>
<hr>