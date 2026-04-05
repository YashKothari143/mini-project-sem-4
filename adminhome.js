function filterProducts(category, btn) {
    let products = document.querySelectorAll('.product');
    let buttons = document.querySelectorAll('.slider button');

    // Active button
    buttons.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    let searchValue = document.getElementById("searchInput").value.toLowerCase();

    products.forEach(product => {
        let productName = product.querySelector("h3").innerText.toLowerCase();

        let matchesSearch = productName.includes(searchValue);
        let matchesCategory = product.classList.contains(category);

        if (matchesSearch && matchesCategory) {
            product.style.display = "block";
        } else {
            product.style.display = "none";
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

