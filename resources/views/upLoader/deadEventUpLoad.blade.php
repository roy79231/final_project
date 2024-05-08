@extends('layouts.upload')

@section('name')
<!--內容-->
<div class="content">
    <h1>死亡事件</h1>
    <form action="{{ route('deadUpLoader.store') }}" method="POST">
        @csrf
        <input type="String" name="name" placeholder="name" required></textarea> <br>
        <input type="String" name="content" placeholder="content" required></textarea> <br>
        <input type="String" name="way" placeholder="way" required></textarea>
        <button type="submit">新增</button>
    </form>

    <br>

    @foreach ($postAchievement as $post)
        <div class=box>
            <form id="form{{ $post->id }}" action="{{ route('deadUpLoader.edit',$post) }}" method="POST">
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
                    <p id="way{{ $post->id }}" style="display: inline;">Way: {{ $post->way }}</p>
                    <input id="wayInput{{ $post->id }}" type="text" name="way" placeholder="way" value="{{ $post->way }}" style="display: none;" required>
                </div>
                <div>
                    <button id="editButton{{ $post->id }}" type="button" onclick="toggleEdit({{ $post->id }})">編輯</button>
                    <button id="confirmButton{{ $post->id }}" type="submit" style="display: none;">確認</button>
                </div>
            </form>

            <form action="{{route('deadUpLoader.destroy',$post)}}" method="POST">
                @csrf
                @method('delete')
                <button type="submit">刪除</button>
            </form>
        </div>
    @endforeach

    <script>
        function toggleEdit(id) {
            const name = document.getElementById(`name${id}`);
            const nameInput = document.getElementById(`nameInput${id}`);
            const content = document.getElementById(`content${id}`);
            const contentInput = document.getElementById(`contentInput${id}`);
            const way = document.getElementById(`way${id}`);
            const wayInput = document.getElementById(`wayInput${id}`);
            const editButton = document.getElementById(`editButton${id}`);
            const confirmButton = document.getElementById(`confirmButton${id}`);

            // 切換顯示元素
            name.style.display = (name.style.display === 'none') ? 'inline' : 'none';
            nameInput.style.display = (nameInput.style.display === 'none') ? 'inline-block' : 'none';
            content.style.display = (content.style.display === 'none') ? 'inline' : 'none';
            contentInput.style.display = (contentInput.style.display === 'none') ? 'inline-block' : 'none';
            way.style.display = (way.style.display === 'none') ? 'inline' : 'none';
            wayInput.style.display = (wayInput.style.display === 'none') ? 'inline-block' : 'none';

            // 切換按鈕顯示
            editButton.style.display = (editButton.style.display === 'none') ? 'inline-block' : 'none';
            confirmButton.style.display = (confirmButton.style.display === 'none') ? 'inline-block' : 'none';
        }
    </script>
</div>

@endsection