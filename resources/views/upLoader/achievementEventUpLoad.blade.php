@extends('layouts.upload')

@section('uploader')

    <!--內容-->
    <div>
        <div class="uploadBox1">
            <div class="uploadCenter">
                <h1>成就事件</h1>
                <form action="{{ route('achievementEventUpLoader.store') }}" method="POST">
                    @csrf
                    <input type="String" name="name" placeholder="name" required></textarea> <br>
                    <input type="String" name="content" placeholder="content" required></textarea> <br>
                    <input type="number" name="intelligence" placeholder="intelligence" required></textarea> <br>
                    <input type="number" name="wealth" placeholder="wealth" required></textarea> <br>
                    <input type="number" name="appearance" placeholder="appearance" required></textarea> <br>
                    <input type="number" name="luck" placeholder="luck" required></textarea> <br>
                    <input type="number" name="morality" placeholder="morality" required></textarea> <br>
                    <input type="number" name="happiness" placeholder="happiness" required></textarea> <br>
                    <input type="number" name="achievement_id" placeholder="achievement_id" required></textarea>
                    <button type="submit">新增</button>
                </form>
            </div>
        </div>
        <br>

        <div class="uploadBox2">
            @foreach ($postAchievement as $post)
                <div class="uploadInnerBox">
                    <form id="form{{ $post->id }}" action="{{ route('achievementEventUpLoader.edit',$post) }}" method="POST">
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
                            <p id="intelligence{{ $post->id }}" style="display: inline;">Intelligence: {{ $post->intelligence }}</p>
                            <input id="intelligenceInput{{ $post->id }}" type="text" name="intelligence" placeholder="intelligence" value="{{ $post->intelligence }}" style="display: none;" required>
                        </div>
                        <div>
                            <p id="wealth{{ $post->id }}" style="display: inline;">Wealth: {{ $post->wealth }}</p>
                            <input id="wealthInput{{ $post->id }}" type="text" name="wealth" placeholder="wealth" value="{{ $post->wealth }}" style="display: none;" required>
                        </div>
                        <div>
                            <p id="appearance{{ $post->id }}" style="display: inline;">Appearance: {{ $post->appearance }}</p>
                            <input id="appearanceInput{{ $post->id }}" type="text" name="appearance" placeholder="appearance" value="{{ $post->appearance }}" style="display: none;" required>
                        </div>
                        <div>
                            <p id="luck{{ $post->id }}" style="display: inline;">Luck: {{ $post->luck }}</p>
                            <input id="luckInput{{ $post->id }}" type="text" name="luck" placeholder="luck" value="{{ $post->luck }}" style="display: none;" required>
                        </div>
                        <div>
                            <p id="morality{{ $post->id }}" style="display: inline;">Morality: {{ $post->morality }}</p>
                            <input id="moralityInput{{ $post->id }}" type="text" name="morality" placeholder="morality" value="{{ $post->morality }}" style="display: none;" required>
                        </div>
                        <div>
                            <p id="happiness{{ $post->id }}" style="display: inline;">Happiness: {{ $post->happiness }}</p>
                            <input id="happinessInput{{ $post->id }}" type="text" name="happiness" placeholder="happiness" value="{{ $post->happiness }}" style="display: none;" required>
                        </div>
                        <div>
                            <p id="achievement_id{{ $post->id }}" style="display: inline;">Achievement_id: {{ $post->achievement_id }}</p>
                            <input id="achievement_idInput{{ $post->id }}" type="text" name="achievement_id" placeholder="achievement_id" value="{{ $post->achievement_id }}" style="display: none;" required>
                        </div>
                        <div>
                            <button id="editButton{{ $post->id }}" type="button" onclick="toggleEdit({{ $post->id }})">編輯</button>
                            <button id="confirmButton{{ $post->id }}" type="submit" style="display: none;">確認</button>
                        </div>
                    </form>

                    <form action="{{route('achievementEventUpLoader.destroy',$post)}}" method="POST">
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
                //請補完剩餘的程式
                const intelligence = document.getElementById(`intelligence${id}`);
                const intelligenceInput = document.getElementById(`intelligenceInput${id}`);
                const wealth = document.getElementById(`wealth${id}`);
                const wealthInput = document.getElementById(`wealthInput${id}`);
                const appearance = document.getElementById(`appearance${id}`);
                const appearanceInput = document.getElementById(`appearanceInput${id}`);
                const luck = document.getElementById(`luck${id}`);
                const luckInput = document.getElementById(`luckInput${id}`);
                const morality = document.getElementById(`morality${id}`);
                const moralityInput = document.getElementById(`moralityInput${id}`);
                const happiness = document.getElementById(`happiness${id}`);
                const happinessInput = document.getElementById(`happinessInput${id}`);
                const achievementId = document.getElementById(`achievement_id${id}`);
                const achievementIdInput = document.getElementById(`achievement_idInput${id}`);

                const editButton = document.getElementById(`editButton${id}`);
                const confirmButton = document.getElementById(`confirmButton${id}`);

                // 切換顯示元素
                name.style.display = (name.style.display === 'none') ? 'inline' : 'none';
                nameInput.style.display = (nameInput.style.display === 'none') ? 'inline-block' : 'none';
                content.style.display = (content.style.display === 'none') ? 'inline' : 'none';
                contentInput.style.display = (contentInput.style.display === 'none') ? 'inline-block' : 'none';
                intelligence.style.display = (intelligence.style.display === 'none') ? 'inline' : 'none';
                intelligenceInput.style.display = (intelligenceInput.style.display === 'none') ? 'inline-block' : 'none';
                wealth.style.display = (wealth.style.display === 'none') ? 'inline' : 'none';
                wealthInput.style.display = (wealthInput.style.display === 'none') ? 'inline-block' : 'none';
                appearance.style.display = (appearance.style.display === 'none') ? 'inline' : 'none';
                appearanceInput.style.display = (appearanceInput.style.display === 'none') ? 'inline-block' : 'none';
                luck.style.display = (luck.style.display === 'none') ? 'inline' : 'none';
                luckInput.style.display = (luckInput.style.display === 'none') ? 'inline-block' : 'none';
                morality.style.display = (morality.style.display === 'none') ? 'inline' : 'none';
                moralityInput.style.display = (moralityInput.style.display === 'none') ? 'inline-block' : 'none';
                happiness.style.display = (happiness.style.display === 'none') ? 'inline' : 'none';
                happinessInput.style.display = (happinessInput.style.display === 'none') ? 'inline-block' : 'none';
                achievementId.style.display = (achievementId.style.display === 'none') ? 'inline' : 'none';
                achievementIdInput.style.display = (achievementIdInput.style.display === 'none') ? 'inline-block' : 'none';
                // 切換按鈕顯示
                editButton.style.display = (editButton.style.display === 'none') ? 'inline-block' : 'none';
                confirmButton.style.display = (confirmButton.style.display === 'none') ? 'inline-block' : 'none';
            }
        </script>
    </div>
@endsection