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



//CHECKOUT
function checkout() {

    cart = JSON.parse(localStorage.getItem("cart")) || [];
    billingHistory = JSON.parse(localStorage.getItem("billingHistory")) || [];

    if (cart.length === 0) {
        alert("Cart is empty!");
        return;
    }

    let billTotal = cart.reduce((sum, item) =>
        sum + item.price * item.quantity, 0);

    let now = new Date();

    billingHistory.push({
        items: JSON.parse(JSON.stringify(cart)), // deep copy
        total: billTotal,
        date: now.toLocaleDateString(),
        time: now.toLocaleTimeString()
    });

    localStorage.setItem("billingHistory", JSON.stringify(billingHistory));
    localStorage.removeItem("cart");

    alert("Purchase Successful! Total ₹" + billTotal);

    cart = [];
    displayCart();
    displayBillingHistory();
}



//BILL DISPLAY
function displayBillingHistory() {

    billingHistory = JSON.parse(localStorage.getItem("billingHistory")) || [];

    let container = document.getElementById("billingHistory");
    container.innerHTML = "";

    let latestBills = billingHistory.slice(-3).reverse();

    latestBills.forEach((bill, index) => {

        let itemsHTML = "";

        bill.items.forEach(item => {
            itemsHTML += `
                <p>${item.name} (x${item.quantity}) - ₹${item.price * item.quantity}</p>
            `;
        });

        container.innerHTML += `
        <div style="border:1px solid gray; margin:10px; padding:15px;">
            <h3>GreenCart: Online Organic Grocery Store</h3>
            <p>Date: ${bill.date}</p>
            <p>Time: ${bill.time}</p>
            <hr>
            ${itemsHTML}
            <hr>
            <strong>Total: ₹${bill.total}</strong>
            <br><br>
            <button class="invoice-btn" onclick="downloadInvoice(${billingHistory.length - 1 - index})">
                Download Invoice
            </button>
        </div>
        `;
    });
}



// DOWNLOAD INVOICE
function downloadInvoice(index) {

    billingHistory = JSON.parse(localStorage.getItem("billingHistory")) || [];
    let bill = billingHistory[index];

    let invoiceContent = `
GreenCart: Online Organic Grocery Store
----------------------------------------
Date: ${bill.date}
Time: ${bill.time}

Items Ordered:
`;

    bill.items.forEach(item => {
        invoiceContent += `
${item.name} (x${item.quantity}) - ₹${item.price * item.quantity}
`;
    });

    invoiceContent += `
----------------------------------------
Total: ₹${bill.total}
`;

    let blob = new Blob([invoiceContent], { type: "text/plain" });
    let link = document.createElement("a");

    link.href = URL.createObjectURL(blob);
    link.download = "GreenCart_Invoice.txt";
    link.click();
}



displayCart();
displayBillingHistory();