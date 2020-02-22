let items = [...document.getElementsByClassName("item")]

// const creatListElement = (name, price) => `<div class="list_element">
//                     <span>${name}</span>
//                     <div class="number">
//                         <button class="minus">-</button>
//                         <input data-inputname=${name} name="quantity" data-price=${price} type="text" value="1" disabled />
//                         <button data-name=${name}  class="plus">+</button>
//                     </div>
//                     <button class="deletBtn">X</button>
//                 </div>`

for (const item of items) {

    item.addEventListener("click", function (e) {
        let orderList = document.getElementById("list")
        // let orderfooter=document.getElementById("orderFooter")
        let { name, price, id } = e.target.dataset;
        price = parseInt(price);

        // const element = creatListElement(name,price)
        // debugger
        // orderList.innerHTML+=element;

        // [...document.getElementsByClassName('plus')].forEach(el=>{
        //     el.addEventListener("click",(e)=>{
        //         const inputElement = document.querySelector(`[data-inputname='${name}']`)
        //         inputElement.value = Number(inputElement.value)+1
        //         // let count= parseInt(quantity.value)+1;
        //         // quantity.value=count;
        //         // let itemPrice=price*parseInt(quantity.value);
        //         // elementPrice.innerText=itemPrice;
        //     })
        // })

        let elementExist = document.getElementById(`${name}_element`);
        let total = document.getElementById("total");

        if (elementExist) {
            return;
        }

        let div = document.createElement("div");
        div.setAttribute("class", "list_element");
        div.setAttribute("id", `${name}_element`);

        let span = document.createElement("div");
        span.innerText = `${name}`;
        span.setAttribute("class", "item-name");
        div.appendChild(span);
        let counterDiv = document.createElement("div");
        counterDiv.setAttribute("class", "item-input");
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

// const form = document.getElementById("form");

// form.addEventListener("submit", (event) => {
//     event.preventDefault();
//     let reqData = "";
//     const formData = new FormData(form);
//     for (const [name, value] of formData.entries()) {
//         reqData += `${name}=${value}&`
//     }
//     fetch('/CafeteriaSystem/insertOrder.php', {
//         method: 'POST', 
//         headers: {
//             "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
//         },
//         body: reqData,
//     })
//         .then((data) => {
//             console.log('Success:', data);
            // location.reload();
//         })
//         .catch((error) => {
//             console.error('Error:', error);
//         });
// })
