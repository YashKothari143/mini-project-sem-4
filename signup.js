function signupUser() {
    let name = document.getElementById("username").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();

    if (!name || !email || !password) {
        alert("Please fill all fields!");
        return;
    }

    let users = JSON.parse(localStorage.getItem("users")) || [];

    let exists = users.find(u => u.email === email);

    if (exists) {
        alert("User already exists! Please login.");
        return;
    }

    users.push({
        name: name,
        email: email,
        password: password
    });

    localStorage.setItem("users", JSON.stringify(users));

    alert("Signup successful! Now login.");
    window.location.href = "index.html";
}
