@extends('layouts.app')

<style>
    p {
    font-family: Arial, sans-serif;
    font-size: 1.2rem;
    font-weight: bold;
}

    .navbar {
        border-bottom: 1px solid #ddd;
    }

    ul {
        list-style-type: none; /* Remove the default bullet */
        padding-left: 0; /* Remove any default padding */
    }

    .nav-pills .nav-link {
        border-radius: 2px;
    }

    .nav-item {
        border: 2px solid black;
        border-radius: 2px;
    }

    .justify-content-end .nav-link {
        color: black !important;
    }

    .navbar-light .navbar-nav .nav-link {
        color: rgba(0, 0, 0);
    }

    .nav-link {
        background-color: rgba(168, 81, 6, 0.675) !important;
    }

    .centered-container, .mt-5 {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .mt-5 h2, .text-center{
        text-align: center;
    }

    a {
        color: blue;
        text-decoration: none;
    }

    .separator {
        border-left: 1px solid #ccc;
        height: 100%;
        /* margin: auto 0; */
    }

    .container li {
        font-size: 24px;
    }

    /* .talent-choice li, .remaining-points li {
        font-size: 24px;
    }  */

    .talent-choice {
        position: relative;
        min-height: 100px; /* Adjust the height as needed */
    }

    .action-buttons {
        position: absolute;
        bottom: 0;
        right: 0;
    }

    .action-buttons .bet-btn, .action-buttons .start-btn{
        border: 5px dashed;
        background-color: transparent;
        margin-left: 5px;
        margin-bottom: 5px;
    }

    .bet-btn {
        color: rgba(208, 22, 9, 0.774); /* Set text color */
    }

    .start-btn {
        color: rgba(5, 110, 50, 0.863); /* Set text color */
    }


    .reset-btn {
        border: 5px dashed;
        background-color: transparent;
        margin-left: 5px;
        margin-bottom: 5px;
    }

    .btn-lighter {
        background-color: rgba(255, 0, 0, 0.5);
        color: #fff;
    }

    .quantity {
        display: inline-block;
        width: 2em; /* Fixed width for alignment */
        text-align: center; /* Center the text horizontally */
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

@section('content')
<div class="container">
    <div class="row">
        <div class="col remaining-points">
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
        <div class="col-auto">
            <div class="separator"></div>
        </div>
        <div class="col talent-choice">
            <div class="col">
                <!-- Right Content -->
                <div class="p-3">
                    <h2>選擇天賦: </h2>
                    <form id="talent-form">
                        @foreach ($talents as $talent)
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheck{{ $loop->index }}" value="{{ $talent }}">
                            <label class="form-check-label" for="flexSwitchCheck{{ $loop->index }}">{{ $talent }}</label>
                        </div>
                        @endforeach
                    </form>

                </div>
            </div>
            <div class="action-buttons">
                <button class="bet-btn">我是賭狗</button> <br>
                <button class="start-btn">開啟大學</button>
            </div>
        </div>

    </div>
</div>
@endsection

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

        betBtn.addEventListener('click', function () {
            // Uncheck all checkboxes
            talentForm.querySelectorAll('input[type="checkbox"]').forEach(function (checkbox) {
                checkbox.checked = false;
            });

            // Select a random index based on the number of checkboxes
            const randomIndex = Math.floor(Math.random() * talentForm.elements.length);
            // Select the random checkbox
            talentForm.elements[randomIndex].checked = true;
        });
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
