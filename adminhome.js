// -----------------------------
// CATEGORY FILTER (Vegetable / Fruit / Dairy)
// -----------------------------
function filterProducts(category, btn) {
    let products = document.querySelectorAll('.product');
    let buttons = document.querySelectorAll('.slider button');

    // Remove active class from all buttons
    buttons.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    // Show/hide products based on category
    products.forEach(product => {
        if (category === 'all' || product.classList.contains(category)) {
            product.style.display = "block"; // for grid layout
        } else {
            product.style.display = "none";
        }
    });
}


// -----------------------------
// SEARCH FILTER
// -----------------------------
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


// -----------------------------
// LOCAL STORAGE FUNCTIONS (NO ID USED)
// We use product name (h3) as the unique key
// -----------------------------

// Get product key from product name
function getProductKey(product) {
    let name = product.querySelector("h3").innerText.trim().toLowerCase();
    return "product_" + name;
}

// Save current product price + stock into localStorage
function saveProductData(product) {
    const key = getProductKey(product);

    const price = parseInt(product.querySelector(".price-value").innerText) || 1;
    const stock = parseInt(product.querySelector(".stock-value").innerText) || 0;

    localStorage.setItem(key, JSON.stringify({ price, stock }));
}

// Load saved price + stock for all products when page opens
function loadAllProducts() {
    document.querySelectorAll(".product").forEach(product => {
        const key = getProductKey(product);

        const saved = localStorage.getItem(key);
        if (!saved) return; // if nothing saved, skip

        const data = JSON.parse(saved);

        product.querySelector(".price-value").innerText = data.price;
        product.querySelector(".stock-value").innerText = data.stock;
    });
}

// Load saved values immediately
loadAllProducts();


// -----------------------------
// INCREMENT / DECREMENT BUTTONS (PRICE + STOCK)
// -----------------------------
document.addEventListener("click", function (e) {

    // If clicked element is not a + / − button, ignore
    if (!e.target.classList.contains("stock-btn")) return;

    const product = e.target.closest(".product");
    const text = e.target.textContent.trim();

    const isPlus = text === "+";
    const isMinus = text === "-" || text === "−";


    // -----------------------------
    // PRICE (+ / −, min = 1)
    // -----------------------------
    if (e.target.closest(".price")) {
        const priceSpan = product.querySelector(".price-value");
        let price = parseInt(priceSpan.innerText) || 1;

        if (isPlus) price++;
        if (isMinus && price > 1) price--;

        priceSpan.innerText = price;
    }


    // -----------------------------
    // STOCK (+ / −, min = 0)
    // -----------------------------
    if (e.target.closest(".stock")) {
        const stockSpan = product.querySelector(".stock-value");
        let stock = parseInt(stockSpan.innerText) || 0;

        if (isPlus) stock++;
        if (isMinus && stock > 0) stock--;

        stockSpan.innerText = stock;
    }


    // -----------------------------
    // SAVE AFTER EVERY CHANGE
    // -----------------------------
    saveProductData(product);

});
