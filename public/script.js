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
