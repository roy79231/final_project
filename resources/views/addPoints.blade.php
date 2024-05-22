@extends('layouts.app')

<style>
    p {
        font-family: Arial, sans-serif;
        font-size: 1.2rem;
        font-weight: bold;
    }
    ul {
        list-style-type: none;
    }

    .remaining-points {
        border-right: #000 solid 1px;
    }

    @media (max-width: 767.98px) {
        .remaining-points {
            border-right: none;
            border-bottom: 1px solid #000;
        }
    }

    .addPoints-container {
        background-color: rgb(237, 218, 191);
        min-height: 80vh;
        display: flex;
        flex-direction: column;
    }

    .addPoints-container h2 {
        font-size: 3rem;
    }

    .addPoints-container li {
        font-size: 2.5rem;
        margin: 20px;
    }

    .navbar {
        z-index: 100;
    }

    .talent-choice {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        z-index: 1;
    }

    .action-buttons {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        margin-top: auto;
        margin-right: 70px;
    }

    .reset-btn, .action-buttons .bet-btn, .action-buttons .start-btn{
        border: 5px dashed;
        background-color: transparent;
        margin-left: 5px;
        margin-bottom: 5px;
        font-size: 2rem;
    }

    .bet-btn {
        color: rgba(208, 22, 9, 0.774);
    }

    .start-btn {
        color: rgba(5, 110, 50, 0.863);
    }

    .btn-lighter {
        background-color: rgba(255, 0, 0, 0.5);
        color: #fff;
    }
    .quantity {
        display: inline-block;
        width: 2em;
        text-align: center;
        font-size: 2.5rem;
    }

    .talent-form-check-input {
        width: 2.5rem !important;
        height: 2.5rem !important;
    }
    .talent-form-check-label {
        font-size: 2.5rem;
    }
</style>
@section('content')
<div class="addPoints-container min-vh-100 d-flex flex-column">
    <div class="row d-flex align-items-stretch">
        <div class="col-12 col-md-6 remaining-points">
            <!-- Left Content -->
            <div class="p-3">
                <h2>剩餘屬性點數: </h2>
                <ul>
                    <li id="intelligence">智力:
                        <button class="btn btn-danger decrement-btn">-</button>
                        <span class="quantity">0</span>
                        <button class="btn btn-success increment-btn">+</button>
                    </li>
                    <li id="wealth">財富:
                        <button class="btn btn-danger decrement-btn">-</button>
                        <span class="quantity">0</span>
                        <button class="btn btn-success increment-btn">+</button>
                    </li>
                    <li id="luck">運氣:
                        <button class="btn btn-danger decrement-btn">-</button>
                        <span class="quantity">0</span>
                        <button class="btn btn-success increment-btn">+</button>
                    </li>
                    <li id="morality">道德:
                        <button class="btn btn-danger decrement-btn">-</button>
                        <span class="quantity">0</span>
                        <button class="btn btn-success increment-btn">+</button>
                    </li>
                    <li id="appearance">顏值:
                        <button class="btn btn-danger decrement-btn">-</button>
                        <span class="quantity">0</span>
                        <button class="btn btn-success increment-btn">+</button>
                    </li>
                </ul>
            </div>
            <div id="reset" class="reset text-end">
                <button class="reset-btn btn-lg" id="reset-btn">歸零</button>
            </div>
        </div>
        <?php
        $rand_nums = [];
            for($i=0;$i<4;$i++){
                while(true){
                    $num = rand(1,$talents_len);
                    if(!in_array($num,$rand_nums)){
                        array_push($rand_nums,$num);
                        break;
                    }
                }
            }
            if(isset($_POST['change_btn'])){
                echo '1';
                $rand_nums = [];
                print('嗨');
                for($i=0;$i<4;$i++){
                    while(true){
                        $num = rand(1,$talents_len) ;
                        if(!in_array($num,$rand_nums)){
                            array_push($rand_nums,$num);
                            break;
                        }
                    }
                }
            }
        ?>
        <div class="col-12 col-md-6 d-flex flex-column">
            <div class="p-3">
                <h2>選擇天賦: </h2>
                <form id="talent-form">
                    <div id="talent-options">
                        @foreach ($talents as $talent)
                            @if(in_array($talent->id,$rand_nums))
                                <div class="talent-form-check">
                                    <label class="talent-form-check-label" >
                                        <input class="talent-form-check-input" type="radio" name="talent" value="{{$talent->id}}">{{ $talent->name }}
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </form>
            </div>
            <div class="action-buttons mt-auto align-self-end">
                <button class="bet-btn">我是賭狗</button> <br>
                <form action="{{ route('run') }}" method="POST">
                    @csrf
                    <input type="number" id='intelligence2' name="intelligence" placeholder="intelligence" required style="display: none"><br>
                    <input type="number" id='wealth2' name="wealth" placeholder="wealth" required style="display: none"><br>
                    <input type="number" id='appearance2' name="appearance" placeholder="appearance" required style="display: none"><br>
                    <input type="number" id='luck2' name="luck" placeholder="luck" required style="display: none"><br>
                    <input type="number" id='morality2' name="morality" placeholder="morality" required style="display: none"><br>
                    <input type="hidden" id='talent2' name="talent" placeholder="name" required style="display: none"></textarea> <br>
                    <button  class="start-btn" type="submit">開始大學</button>
                </form>
            </div>
        </div>

    </div>
</div>
<script>
    // Maximum sum allowed
    let MAX_SUM = 20;

    // Function to update the remaining points display
    function updateRemainingPoints() {
        // Get all quantity elements
        const quantities = document.querySelectorAll('.quantity');

        // Calculate the current sum of points
        let sum = 0;
        quantities.forEach(quantity => {
            sum += parseInt(quantity.innerText);
        });

        // Display the maximum sum and disable/enable buttons accordingly
        document.querySelector('.remaining-points h2').innerText = `剩餘屬性點數: ${MAX_SUM - sum}`;

        // Enable/disable buttons based on the current sum
        document.querySelectorAll('.increment-btn').forEach(button => {
            button.disabled = sum >= MAX_SUM;
        });

        document.querySelectorAll('.decrement-btn').forEach(button => {
            button.disabled = sum <= 0;
        });

        // Update button colors based on quantity values
        document.querySelectorAll('.quantity').forEach(span => {
            const button = span.previousElementSibling; // Get the button before the span
            if (parseInt(span.innerText) === 0) {
                button.classList.add('btn-lighter');
            } else {
                button.classList.remove('btn-lighter');
            }
        });
    }

    // Add event listeners to the buttons
    document.querySelectorAll('.decrement-btn').forEach(button => {
        button.addEventListener('click', () => {
            var span = button.nextElementSibling;
            var currentValue = parseInt(span.innerText);
            if (currentValue > 0) {
                span.innerText = currentValue - 1;
                updateRemainingPoints();
            }
            const intelligence = document.querySelector('#intelligence .quantity').innerText;
            const wealth = document.querySelector('#wealth .quantity').innerText;
            const luck = document.querySelector('#luck .quantity').innerText;
            const morality = document.querySelector('#morality .quantity').innerText;
            const appearance = document.querySelector('#appearance .quantity').innerText;
            document.querySelector('#intelligence2').value = parseInt(intelligence);
            document.querySelector('#wealth2').value = parseInt(wealth);
            document.querySelector('#luck2').value = parseInt(luck);
            document.querySelector('#morality2').value = parseInt(morality);
            document.querySelector('#appearance2').value = parseInt(appearance);
        });
    });

    document.querySelectorAll('.increment-btn').forEach(button => {
        button.addEventListener('click', () => {
            var span = button.previousElementSibling;
            var currentValue = parseInt(span.innerText);
            if (currentValue < MAX_SUM) {
                span.innerText = currentValue + 1;
                updateRemainingPoints();
            }
            const intelligence = document.querySelector('#intelligence .quantity').innerText;
            const wealth = document.querySelector('#wealth .quantity').innerText;
            const luck = document.querySelector('#luck .quantity').innerText;
            const morality = document.querySelector('#morality .quantity').innerText;
            const appearance = document.querySelector('#appearance .quantity').innerText;
            document.querySelector('#intelligence2').value = parseInt(intelligence);
            document.querySelector('#wealth2').value = parseInt(wealth);
            document.querySelector('#luck2').value = parseInt(luck);
            document.querySelector('#morality2').value = parseInt(morality);
            document.querySelector('#appearance2').value = parseInt(appearance);
        });
    });

    function getRandomInt(max) {
        return Math.floor(Math.random() * max);
    }

    document.getElementById('reset-btn').addEventListener('click', () => {
        // Set all span elements to 0
        document.querySelectorAll('.quantity').forEach(span => {
            span.innerText = '0';
        });

        // Update the number 20 at the top
        document.querySelector('.remaining-points h2').innerText = `剩餘屬性點數: ${MAX_SUM}`;

        // Enable the + buttons
        document.querySelectorAll('.increment-btn').forEach(button => {
            button.disabled = false;
        });

        updateRemainingPoints(); // Update the button colors
    });

    // Initial update
    updateRemainingPoints();

    document.addEventListener('DOMContentLoaded', function () {
        const betBtn = document.querySelector('.bet-btn');
        const talentForm = document.getElementById('talent-form');
        const talentRadios = talentForm.querySelectorAll('input[type="radio"]');
        talentRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                // 獲取所選天賦的值
                const selectedTalent = this.value;
                console.log(selectedTalent);
                document.querySelector('#talent2').value = selectedTalent;
            });
        });

        betBtn.addEventListener('click', function () {
             // 抓$talents的資料
            const talents = @json($talents);

            // 建造隨機4個
            let rand_nums = [];
            while (rand_nums.length < 4) {
                let rand_num = Math.floor(Math.random() * talents.length);
                if (!rand_nums.includes(rand_num)) {
                    rand_nums.push(rand_num);
                }
            }

            // 直接抓對應塊html並清空
            const talentOptions = document.getElementById('talent-options');
            talentOptions.innerHTML = '';

            // 幫那塊html替換為新的內容
            rand_nums.forEach(index => {
                const talent = talents[index];
                const talentDiv = document.createElement('div');
                talentDiv.className = 'talent-form-check';
                talentDiv.innerHTML = `
                    <label class="talent-form-check-label">
                    <input class="talent-form-check-input" type="radio" name="talent" value="${talent.id}">${talent.name}
                    </label>
                `;
                talentOptions.appendChild(talentDiv);
            });
            // 由於事件監測器沒了 所以這邊幫她新增回去
            const radioButtons = document.querySelectorAll('input[name="talent"]');
            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    const selectedTalentId = this.value;
                    console.log(selectedTalentId);
                    document.querySelector('#talent2').value = selectedTalentId;
                });
            });
        });
    });
</script>
@endsection