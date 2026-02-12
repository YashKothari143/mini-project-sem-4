
function filterProducts(category, btn) {
    let products = document.querySelectorAll('.product');
    let buttons = document.querySelectorAll('.slider button');

    // Remove active class from all buttons
    buttons.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    // Show/hide products
    products.forEach(product => {
        if (category === 'all' || product.classList.contains(category)) {
            product.style.display = "block"; // for grid/flex layout, use "flex"
        } else {
            product.style.display = "none";
        }
    });
}

document.getElementById("searchInput").addEventListener("keyup", function () {
    let searchValue = this.value.toLowerCase();
    let products = document.querySelectorAll(".product");

    products.forEach(function (product) {
        let productName = product.querySelector("h3").innerText.toLowerCase();

        if (productName.includes(searchValue)) {
            product.style.display = "block";
        } else {
            product.style.display = "none";
        }
    });
});

//adding products to cart

function gocart() {
    window.location.href = "cart.html";
}


function addToCart(button) {

    let product = button.closest(".product");

    let name = product.querySelector("h3").innerText;
    let priceText = product.querySelector(".price").innerText;

   let price = parseInt(priceText.replace(/[^0-9]/g, "")) || 0;


    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    let existing = cart.find(item => item.name === name);

    if (existing) {
        existing.quantity += 1;   // if already exists
    } else {
        cart.push({
            name: name,
            price: price,
            quantity: 1          // default 1
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
};
