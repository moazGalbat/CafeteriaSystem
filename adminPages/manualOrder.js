let items = [...document.getElementsByClassName("item")]

for (const item of items) {

    item.addEventListener("click", function (e) {
        let orderList = document.getElementById("list")
        let { name, price, id } = e.target.dataset;
        price = parseInt(price);


        let elementExist = document.getElementById(`${name}_element`);
        let total = document.getElementById("total");

        if (elementExist) {
            return;
        }

        let div = document.createElement("div");
        div.setAttribute("class", "list_element");
        div.setAttribute("id", `${name}_element`);

        let span = document.createElement("span");
        span.innerText = `${name}`;
        div.appendChild(span);
        let counterDiv = document.createElement("div");
        let minusBtn = document.createElement("button");
        minusBtn.setAttribute("class", "minus");
        minusBtn.type = "button";
        minusBtn.innerText = "-";
        counterDiv.appendChild(minusBtn);
        let quantity = document.createElement("input");
        quantity.setAttribute("name", `quantity[${id}]`);
        quantity.setAttribute("type", "text");
        quantity.setAttribute("value", "1");
        quantity.setAttribute("data-price", `${price}`);
        counterDiv.appendChild(quantity);
        let plusBtn = document.createElement("button");
        plusBtn.type = "button";
        plusBtn.innerText = "+";
        plusBtn.setAttribute("class", "plus");
        counterDiv.appendChild(plusBtn)
        div.appendChild(counterDiv);

        let elementPrice = document.createElement("span");

        elementPrice.innerText = `${price}`
        elementPrice.setAttribute("class", "elementPrice");
        div.appendChild(elementPrice);

        let deleteBtn = document.createElement("button");
        deleteBtn.innerText = "X";
        deleteBtn.type = "button"
        deleteBtn.setAttribute("class", "deleteBtn");
        deleteBtn.addEventListener("click", function () {
            orderList.removeChild(div);
            total.innerText = totalOrderPrice();
        })
        div.appendChild(deleteBtn);
        orderList.appendChild(div);

        minusBtn.addEventListener("click", () => {
            let count = parseInt(quantity.value) - 1;
            count = count < 1 ? 1 : count;
            quantity.value = count;
            let itemPrice = price * parseInt(quantity.value);
            elementPrice.innerText = itemPrice;

            total.innerText = "Total: " + totalOrderPrice();
        })

        plusBtn.addEventListener("click", () => {
            let count = parseInt(quantity.value) + 1;
            quantity.value = count;
            let itemPrice = price * parseInt(quantity.value);
            elementPrice.innerText = itemPrice;

            total.innerText = "Total: " + totalOrderPrice();

        })

        total.innerText = "Total: " + totalOrderPrice();
    })
}


const totalOrderPrice = function () {
    let eachElementPrice = [...document.getElementsByClassName("elementPrice")];
    let sum = 0;
    for (const item of eachElementPrice) {
        sum += parseInt(item.innerText);
    }

    return sum;
}

const form = document.getElementById("form");
let userId= document.getElementById("user");

form.addEventListener("submit", (event) => {
    event.preventDefault();
    let reqData = "";
    const formData = new FormData(form);
    for (const [name, value] of formData.entries()) {
        reqData += `${name}=${value}&`
    }

        reqData+=`user=${user.value}`;

    fetch('/CafeteriaSystem/adminPages/adminInsertOrder.php', {
        method: 'POST', 
        headers: {
            "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
        },
        body: reqData,
    })
        .then((data) => {
            alert("Order Added Successfuly")
        })
        .catch((error) => {
            console.error('Error:', error);
        });
})
