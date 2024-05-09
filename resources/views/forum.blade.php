@extends('layouts.app')

@section('content')

<body style="background-color: #f5deb3;">
<div class="container">
<div class="container" style="background-color: #f5deb3;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 style="text-align: center;">討論區</h1> 
            <div class="card" style="background-color: #d8c49f;">
                <div class="card-body">
                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                </div>
                
                <div>
                    <form action="{{ route('forumcreate') }}" method='POST'>
                        @csrf
                    
                        <div class="comment">
                            <textarea name='content' rows='3' cols='60' placeholder="跟大家分享你的想法"></textarea>
                        </div>
                        <div class="submit_comment">
                            <input type="submit" value="送出" name="submit" style="background-color: #d8c49f;">
                            <br/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<p style="text-align: center;">討論區</p>
<div class="row justify-content-center">
    @foreach($posts->reverse() as $post)
    <div class="col-md-8 mb-3">
        <div class="card "style="background-color: #ebcd96">
            <div class="card-header">
                <strong>{{$post->inputer}}</strong>
            </div>
            <div class="card-body">
                <div id="edit_field_{{$post->id}}" style="display: none;">
                    <form action="{{ route('forumchange', $post->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name='content' rows='3' class="form-control" style="text-align: center;">{{ $post->content }}</textarea>
                        </div>
                        <input type="submit" name='change' value="完成" class="btn btn-primary btn-sm">
                    </form>
                </div>
                <div id="content_field_{{$post->id}}" class="d-flex justify-content-between align-items-center">
                    <div>
                        <div id="content_{{$post->id}}">
                            <p style="text-align: center;">{{$post->content}}</p>
                        </div>
                    </div>
                    <div id="buttons_{{$post->id}}">
                        @if(Auth::user()->name == $post->inputer)
                            <button onclick="showEditField({{$post->id}})" class="btn btn-primary btn-sm">編輯</button>
                            <form action="{{ route('forumdelete', $post->id) }}" method="POST">
                                @csrf
                                <input type="submit" name="delete" value="刪除" class="btn btn-danger btn-sm ml-1">
                            </form>
                        @endif
                    </div>
                    <div id="edit_field_{{$post->id}}" style="display: none;">
                        <form action="{{ route('forumchange', $post->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea name='content' rows='3' class="form-control">{{ $post->content }}</textarea>
                            </div>
                            <input type="submit" name='change' value="完成" class="btn btn-primary btn-sm">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>
</div>
</body>

@endsection

<script>
    function showEditField(postId) {
    var editField = document.getElementById('edit_field_' + postId);
    var contentField = document.getElementById('content_' + postId);
    var buttons = document.getElementById('buttons_' + postId);

    editField.style.display = 'block';
    contentField.style.display = 'none';
    buttons.style.display = 'none';
}
</script>
