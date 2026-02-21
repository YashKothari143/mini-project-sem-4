let currentCategory = "vegetable"; // default visible category


function filterProducts(category, btn) {

    currentCategory = category;

    let buttons = document.querySelectorAll('.slider button');
    buttons.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    applyFilters();
}


// 🔥 SEARCH + CATEGORY COMBINED
document.getElementById("searchInput").addEventListener("input", function () {
    applyFilters();
});


function applyFilters() {

    let searchValue = document.getElementById("searchInput").value.toLowerCase().trim();
    let products = document.querySelectorAll(".product");

    products.forEach(product => {

        let productName = product.querySelector("h3").innerText.toLowerCase();

        let matchesCategory = product.classList.contains(currentCategory);
        let matchesSearch = productName.includes(searchValue);

        if (matchesCategory && matchesSearch) {
            product.style.display = "";
        } else {
            product.style.display = "none";
        }

    });
}


// adding products to cart

function gocart() {
    window.location.href = "cart.html";
}


function addToCart(button) {

    let product = button.closest(".product");

    let name = product.querySelector("h3").innerText;
    let priceText = product.querySelector(".price-value").innerText;

    let price = parseInt(priceText) || 0;

    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    let existing = cart.find(item => item.name === name);

    if (existing) {
        existing.quantity += 1;
    } else {
        cart.push({
            name: name,
            price: price,
            quantity: 1
        });
    }

    localStorage.setItem("cart", JSON.stringify(cart));

    alert(name + " added to cart!");
}


function toggleAccountMenu() {
    let menu = document.getElementById("accountMenu");
    menu.classList.toggle("show");
}


function logoutUser() {
    localStorage.removeItem("loggedInUser");
    alert("Logged out!");
    window.location.href = "index.html";
}


window.onload = function () {

    let user = JSON.parse(localStorage.getItem("loggedInUser"));

    if (user) {
        document.getElementById("accountName").innerText = "Hello, " + user.name;
    } else {
        document.getElementById("accountName").innerText = "Not logged in";
    }

    applyFilters(); // make sure default category loads properly
};