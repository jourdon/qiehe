@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/hight-styles.css') }}" media="all" />
    <link rel="stylesheet" href="{{ asset('css/simplemde-editor.css') }}" media="all" />
    @endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-header text-center header-line">
                        <i class="far fa-edit"></i>
                        @if($post->id)编辑话题@else新建话题@endif
                    </h2>
                    @include('common.error')

                    @if($post->id)
                        <form action="{{ route('posts.update', $post->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                            @else
                                <form action="{{ route('posts.store') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                                    @endif

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group row">
                                        <label for="title" class="col-sm-1 col-form-label">标题 :</label>
                                        <div class="col-sm-11">
                                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $post->title ) }}" placeholder="请填写标题" required/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="category" class="col-sm-1 col-form-label">分类 :</label>
                                        <div class="col-sm-11">
                                            <select class="form-control" id="category" name="category_id" required>
                                            <option value="" hidden disabled selected>请选择分类</option>
                                            @foreach ($categories as $value)
                                                <option value="{{ $value->id }}" {{ $post->category_id==$value->id?'selected':'' }}>{{ $value->title }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inlineCheckbox1" class="col-sm-1 col-form-label">标签 :</label>
                                        <div class="col-sm-11">
                                            @foreach($tags as $tag=>$id)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $id }}" {{in_array($id,$post->tags()->allRelatedIds()->toArray())?'checked':''}}>
                                                <label class="form-check-label" >{{ $tag }}</label>
                                            </div>
                                                @endforeach
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label  class="col-sm-1 col-form-label">缩略图 </label>
                                        <div class="col-sm-11">
                                            <div class="custom-file">
                                            <input type="file" name="thumbnail" class="custom-file-input" id="inputGroupFile">
                                            <label class="custom-file-label" for="inputGroupFile">选择缩略图上传</label>
                                        </div>
                                            <br>
                                            <img class="img-thumbnail rounded imgshow" src="{{ $post->thumbnail }}" width="728" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label  class="col-sm-1 col-form-label">摘要 :</label>
                                        <div class="col-sm-11">
                                            <textarea name="excerpt" class="form-control"  rows="3" placeholder="如没有输入，自动截取文章前200个字符">{{ old('excerpt', $post->excerpt ) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label  class="col-sm-1 col-form-label">正文 :</label>
                                        <div class="col-sm-11">
                                            <textarea name="body" class="form-control" id="body" rows="3" placeholder="请使用 Markdown 格式书写 ;-)，代码块请标语言,示例如下，否则无高亮
```php
  //代码开始
```
OK！开始你的创作吧！" required>{{ old('body', $post->body ) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-11 text-center">
                                            <button type="submit" class="btn btn-primary text-right"><span class="fas fa-check" aria-hidden="true"></span> 保存</button>
                                        </div>
                                    </div>
                                </form>
                </div>
            </div>
        </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/simplemde-editor.js') }}"></script>
    <script>
        var simplemde =  new SimpleMDE({
            element: document.getElementById("body"),
            autosave: {
                enabled: true,
                delay: 5000,
                unique_id: "content_{{ $post->id?:0 }}",
            },
            forceSync: true,
            toolbar: ["bold", "italic",'strikethrough', "heading",'|',"quote",'code','table','horizontal-rule','unordered-list','ordered-list','|','link','image','|','clean-block','preview','side-by-side','fullscreen', "|", ],
            toolbarTips: true,
            spellChecker: false,
        });

        $(function() {
            $('textarea').inlineattachment({
                uploadUrl: "{{ route('posts.upload') }}",
                extraParams: {
                    '_token': "{{ csrf_token() }}",
                },
            });
        });

        $('#inputGroupFile').change(function(ev){
            file=$(this).get(0).files[0];
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload=function(e){
                $('.imgshow').attr('src',e.target.result);
            }
        });
    </script>

@endsection