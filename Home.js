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
function toggleMenu(){
    let menu = document.getElementById("menu");
    menu.style.display = (menu.style.display === "none") ? "block" : "none";
}
// update-msg

setTimeout(() => {
    let msg = document.querySelector(".success-msg");
    if(msg) msg.style.display = "none";
}, 3000);


