let cart = JSON.parse(localStorage.getItem("cart")) || [];
let billingHistory = JSON.parse(localStorage.getItem("billingHistory")) || [];

function displayCart() {

    cart = JSON.parse(localStorage.getItem("cart")) || [];

    let cartBody = document.getElementById("cartBody");
    cartBody.innerHTML = "";

    let grandTotal = 0;

    cart.forEach((item, index) => {

        let itemTotal = item.price * item.quantity;
        grandTotal += itemTotal;

        cartBody.innerHTML += `
        <tr>
            <td>${item.name}</td>
            <td>₹${item.price}</td>
            <td>
                <button onclick="changeQty(${index}, -1)">-</button>
                ${item.quantity}
                <button onclick="changeQty(${index}, 1)">+</button>
            </td>
            <td>₹${itemTotal}</td>
        </tr>
        `;
    });

    document.getElementById("grandTotal").innerHTML =
        `<span style="font-size:24px; font-weight:bold;">
            Grand Total: ₹${grandTotal}
         </span>`;
}


function changeQty(index, change) {

    cart[index].quantity += change;

    if (cart[index].quantity <= 0) {
        cart.splice(index, 1);
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    displayCart();
}

function checkout() {

    if (cart.length === 0) {
        alert("Cart is empty!");
        return;
    }

    let billTotal = cart.reduce((sum, item) =>
        sum + item.price * item.quantity, 0);

    billingHistory.push({
        items: cart,
        total: billTotal
    });

    localStorage.setItem("billingHistory", JSON.stringify(billingHistory));
    localStorage.removeItem("cart");

    alert("Purchase Successful! Total ₹" + billTotal);

    cart = [];
    displayCart();
    displayBillingHistory();
}

function displayBillingHistory() {

    let container = document.getElementById("billingHistory");
    container.innerHTML = "";

    billingHistory.forEach((bill, index) => {

        container.innerHTML += `
        <div style="border:1px solid gray; margin:10px; padding:10px;">
            <h4>Bill ${index + 1}</h4>
            <p>Total: ₹${bill.total}</p>
        </div>
        `;
    });
}

displayCart();
displayBillingHistory();