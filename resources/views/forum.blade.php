@extends('layouts.app')

@section('content')

<body style="background-color: #f5deb3;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 style="text-align: center;">討論區</h1> 
                <div class="card" style="background-color: #f5deb3;">
                    <div class="card-body">
                        @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                    </div>
                    
                    <div class="container">
                        <form action="{{ route('forumcreate') }}" method='POST' class="row justify-content-center">
                            @csrf
                    
                            <div class="col-md-8 mb-3">
                                <textarea name='content' rows='1' class="form-control" style="resize: none;" placeholder="跟大家分享你的想法"></textarea>
                            </div>
                    
                            <div class="col-md-8 mb-3 d-flex justify-content-center">
                                <button type="submit" name="submit" class="btn btn-primary px-5" style="background-color: #d8c49f; border-color: #8d8a83;color: black;">
                                    <i class="bi bi-check-circle"></i> 送出
                                </button>
                            </div>
                    
                        </form>
                    </div>
                       </button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <p style="text-align: center;"></p>
        <div class="row justify-content-center">
            @foreach($posts->reverse() as $post)
            <div class="col-md-8 mb-3">
                <div class="card "style="background-color: #ebcd96">
                    <div class="card-header">
                        <strong>{{$post->inputer}} - {{$post->updated_at->format('Y-m-d')}}</strong>
                    </div>
                    <div class="card-body">
                        <div id="edit_field_{{$post->id}}" style="display: none;">
                            <form action="{{ route('forumchange', $post->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <textarea name='content' rows='3' class="form-control" style="text-align;">{{ $post->content }}</textarea>
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
                                    <button onclick="showEditField({{$post->id}})" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil-square"></i> 編輯
                                    </button>
                                    <p style="text-align: center;"></p>
                                    <form action="{{ route('forumdelete', $post->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" name="delete" class="btn btn-sm btn-outline-danger ml-1">
                                            <i class="bi bi-trash3"></i> 刪除
                                        </button>
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
