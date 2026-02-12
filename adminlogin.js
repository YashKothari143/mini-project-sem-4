document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("formlogin");
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("password");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const username = usernameInput.value.trim();
        const password = passwordInput.value.trim();

        if (username === "admin" && password === "admin123") {
            window.location.href = "adminhome.html";
        } else {
            alert("Invalid admin credentials");
        }
    });

});
