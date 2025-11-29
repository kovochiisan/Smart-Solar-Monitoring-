let timeLeft = 10;
const countdown = document.getElementById("countdown");

const timer = setInterval(() => {
    timeLeft--;
    countdown.textContent = timeLeft;
    if (timeLeft <= 0) {
        clearInterval(timer);
        window.location.href = countdown.dataset.redirect;
    }
}, 1000);
