@extends('layouts.upload')

@section('uploader')
<!--內容-->
<div>
    <div class="uploadBox1">
        <div class="uploadCenter">
            <h1>成就條件</h1>
            <form action="{{ route('upLoader.store') }}" method="POST">
                @csrf
                <input type="String" name="name" placeholder="name" required></textarea> <br>
                <input type="String" name="content" placeholder="content" required></textarea>
                <button type="submit">新增</button>
            </form>
        </div>
    </div>
    <br>

    <div class="uploadBox2">
    @foreach ($postAchievement as $post)
        <div class="uploadInnerBox">
            <form id="form{{ $post->id }}" action="{{ route('upLoader.edit',$post) }}" method="POST">
                @csrf
                @method('patch')
                <div>
                    <p id="name{{ $post->id }}" style="display: inline;">Name: {{ $post->name }}</p>
                    <input id="nameInput{{ $post->id }}" type="text" name="name" placeholder="name" value="{{ $post->name }}" style="display: none;" required>
                </div>
                <div>
                    <p id="content{{ $post->id }}" style="display: inline;">Content: {{ $post->content }}</p>
                    <input id="contentInput{{ $post->id }}" type="text" name="content" placeholder="content" value="{{ $post->content }}" style="display: none;" required>
                </div>
                <div>
                    <button id="editButton{{ $post->id }}" type="button" onclick="toggleEdit({{ $post->id }})">編輯</button>
                    <button id="confirmButton{{ $post->id }}" type="submit" style="display: none;">確認</button>
                </div>
            </form>

            <form action="{{route('upLoader.destroy',$post)}}" method="POST">
                @csrf
                @method('delete')
                <button type="submit">刪除</button>
            </form>
        </div>
    @endforeach
    </div>

    <script>
        function toggleEdit(id) {
            const name = document.getElementById(`name${id}`);
            const nameInput = document.getElementById(`nameInput${id}`);
            const content = document.getElementById(`content${id}`);
            const contentInput = document.getElementById(`contentInput${id}`);
            const editButton = document.getElementById(`editButton${id}`);
            const confirmButton = document.getElementById(`confirmButton${id}`);

            // 切換顯示元素
            name.style.display = (name.style.display === 'none') ? 'inline' : 'none';
            nameInput.style.display = (nameInput.style.display === 'none') ? 'inline-block' : 'none';
            content.style.display = (content.style.display === 'none') ? 'inline' : 'none';
            contentInput.style.display = (contentInput.style.display === 'none') ? 'inline-block' : 'none';

            // 切換按鈕顯示
            editButton.style.display = (editButton.style.display === 'none') ? 'inline-block' : 'none';
            confirmButton.style.display = (confirmButton.style.display === 'none') ? 'inline-block' : 'none';
        }
    </script>
</div>

@endsection