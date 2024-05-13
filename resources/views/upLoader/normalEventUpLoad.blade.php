@extends('layouts.upload')

@section('name')
<!--內容-->
<div class="content">
    <h1>一般事件</h1>
    <form action="{{ route('normalEventUpLoader.store') }}" method="POST">
        @csrf
        <input type="String" name="name" placeholder="name" required> <br>
        <input type="String" name="content" placeholder="content" required> <br>
        <select name="time_type" id="time_type" required>
            <option value="1">Time type: 1</option>
            <option value="2">Time type: 2</option>
            <option value="3">Time type: 3</option>
            <option value="4">Time type: 4</option>
            <option value="5">Time type: 5</option>
        </select>
        <button type="submit">新增</button>
    </form>

    <br>

    @foreach ($postAchievement as $post)
        <div class=box>
            <form id="form{{ $post->id }}" action="{{ route('normalEventUpLoader.edit',$post) }}" method="POST">
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
                    <p id="time_type{{ $post->id }}" style="display: inline;">Time Type: {{ $post->time_type }}</p>
                    <select id="time_typeInput{{ $post->id }}" name="time_type" style="display: none;" required>
                        <option value="1">Time type: 1</option>
                        <option value="2">Time type: 2</option>
                        <option value="3">Time type: 3</option>
                        <option value="4">Time type: 4</option>
                        <option value="5">Time type: 5</option>
                    </select>
                </div>
                <div>
                    <button id="editButton{{ $post->id }}" type="button" onclick="toggleEdit({{ $post->id }})">編輯</button>
                    <button id="confirmButton{{ $post->id }}" type="submit" style="display: none;">確認</button>
                </div>
            </form>

            <form action="{{route('normalEventUpLoader.destroy',$post)}}" method="POST">
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
            const timeType = document.getElementById(`time_type${id}`); // 新增time_type變數
            const timeTypeInput = document.getElementById(`time_typeInput${id}`); // 新增time_type輸入框變數
            const editButton = document.getElementById(`editButton${id}`);
            const confirmButton = document.getElementById(`confirmButton${id}`);

            // 切換顯示元素
            name.style.display = (name.style.display === 'none') ? 'inline' : 'none';
            nameInput.style.display = (nameInput.style.display === 'none') ? 'inline-block' : 'none';
            content.style.display = (content.style.display === 'none') ? 'inline' : 'none';
            contentInput.style.display = (contentInput.style.display === 'none') ? 'inline-block' : 'none';
            timeType.style.display = (timeType.style.display === 'none') ? 'inline' : 'none'; // 切換time_type顯示
            timeTypeInput.style.display = (timeTypeInput.style.display === 'none') ? 'inline-block' : 'none'; // 切換time_type輸入框顯示

            // 切換按鈕顯示
            editButton.style.display = (editButton.style.display === 'none') ? 'inline-block' : 'none';
            confirmButton.style.display = (confirmButton.style.display === 'none') ? 'inline-block' : 'none';
        }
    </script>
</div>

@endsection
