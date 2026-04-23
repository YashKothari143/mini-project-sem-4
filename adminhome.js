function filterProducts(category = null, btn = null) {
    let products = document.querySelectorAll('.product');
    let buttons = document.querySelectorAll('.slider button');

    // Handle active button click
    if (btn) {
        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    }

    // Always detect active category
    let activeBtn = document.querySelector('.slider .active');
    if (activeBtn) {
        category = activeBtn.innerText.toLowerCase().slice(0, -1);
    }

    let searchValue = document.getElementById("searchInput").value.toLowerCase();

    products.forEach(product => {
        let productName = product.querySelector("h3").innerText.toLowerCase();

        let matchesSearch = productName.includes(searchValue);
        let matchesCategory = product.classList.contains(category);

        if (searchValue === "") {
            // Only category filter
            product.style.display = matchesCategory ? "block" : "none";
        } else {
            // Search across ALL categories (best UX)
            product.style.display = matchesSearch ? "block" : "none";
        }
    });
}
// for lof out
function toggleMenu(){
    let menu = document.getElementById("menu");
    menu.style.display = (menu.style.display === "none") ? "block" : "none";
}
// update-msg

setTimeout(() => {
    let msg = document.querySelector(".success-msg");
    if(msg) msg.style.display = "none";
}, 3000);

