@extends('layouts.app')

@section('content')
<style>
    body {
        position: relative;
        font-size: 20px;
        margin: 0;
        padding: 0;
        height: 100%;
    }
    .background-overlay {
        position: fixed; /* Use fixed to cover the entire viewport */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('{{ asset('_25d6b211-50e8-4220-8a01-9fed3ba11c67.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        opacity: 0.35; /* Adjust the opacity value as needed */
        z-index: -2;
    }
    .custom-card {
        background-color: #ecbd97;
        border: 6px solid rgb(123, 119, 119);
        padding: 15px;
        border-radius: 35px;
    }
    .jamescontainer {
        position: relative;
        z-index: -1;
    }
</style>
<div class="background-overlay"></div>

    
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p style="text-align: center;"></p>
                <h1 style="text-align: center;">討論區</h1> 
                <div class="custom-card">
                
                    <form action="{{ route('forumcreate') }}" method='POST' class="row justify-content-center" >
                            @csrf
                    
                            <div class="col-md-8 mb-1">
                                <textarea name='content' rows='1' class="form-control" style="resize: none;" placeholder="跟大家分享你的想法"></textarea>
                            </div>
                    
                            <div class="col-md-8 mb-3 d-flex justify-content-center" style="padding-top:20px;padding-bottom:0px">
                                <button type="submit" name="submit" class="btn btn-primary px-5" style="background-color: #d8c49f; border-color: #8d8a83; color: black;">
                                    <i class="bi bi-check-circle"></i> 送出
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <p style="text-align: center;"></p>
        <div class="row justify-content-center">
            @foreach($posts->reverse() as $post)
            <div class="col-md-8 mb-3">
                <div class="custom-card">
                    <div class="card-header">
                        <i class="bi bi-person-circle"></i>     <strong>{{$post->inputer}}      {{$post->updated_at->format('Y-m-d')}}</strong>
                    </div>
                    <div class="card-body">
                        <div id="edit_field_{{$post->id}}" style="display: none;">
                            <form action="{{ route('forumchange', $post->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <textarea name='content' rows='3' class="form-control" >{{ $post->content }}</textarea>
                                </div>
                                <input type="submit" name='change' value="完成" class="btn btn-primary btn-sm">
                            </form>
                        </div>
                        <div id="content_field_{{$post->id}}" class="d-flex justify-content-between align-items-center">
                            <div>
                                <div id="content_{{$post->id}}">
                                    <p style="text-align: center; font-size: 35px;">{{$post->content}}</p>
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
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    


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
