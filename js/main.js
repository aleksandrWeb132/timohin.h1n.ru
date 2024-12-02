var timeout;

function updateQuantity(id, quantity) {
    clearTimeout(timeout);

    timeout = setTimeout(() => {
        const url = 'http://timohin.h1n.ru/update_product.php';
        const data = {
            productId: id,
            productQuantity: quantity
        };

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => {
                if(!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })

    }, 1000);
}

function addQuantity(id) {
    const lineElement = document.getElementById(id);
    const quantityElement = lineElement.querySelector('.quantity__number');

    let quantity = Number(quantityElement.textContent) + 1;

    quantityElement.textContent = String(quantity);

    updateQuantity(id, quantity);
}

function removeQuantity(id) {
    const lineElement = document.getElementById(id);
    const quantityElement = lineElement.querySelector('.quantity__number');

    let quantity = Number(quantityElement.textContent) - 1;

    quantityElement.textContent = String(quantity);

    updateQuantity(id, quantity);
}

function hideLine(id) {
    const lineElement = document.getElementById(id);
    lineElement.remove();

    const url = 'http://timohin.h1n.ru/hide_product.php';
    const data = {
        productId: id
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => {
            if(!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
}