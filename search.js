
const input = document.querySelector("input");

input.addEventListener("keyup", () => {
    let pattern = /^[^ ]+@[^ ]+\.[c,o,m]{3}$/;
    if (input.value === "pendulum") {

        document.onclick = function () {
            window.location.href = 'pendulum.html';
        }
    }
    if (input.value === "biology") {

        document.onclick = function () {
            window.location.href = 'biology.html';
        }
    }
    if (input.value === "cradle") {

        document.onclick = function () {
            window.location.href = 'cradle.html';
        }
    }
    if (input.value === "refraction") {

        document.onclick = function () {
            window.location.href = 'refraction.html';
        }
    }
})



