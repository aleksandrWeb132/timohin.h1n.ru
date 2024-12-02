











function addQuantity(id) {
    const lineElement = document.getElementById(id);
    const quantityElement = lineElement.querySelector('.quantity__number');

    quantityElement.textContent = String(Number(quantityElement.textContent) + 1);
}

function removeQuantity(id) {
    const lineElement = document.getElementById(id);
    const quantityElement = lineElement.querySelector('.quantity__number');

    quantityElement.textContent = String(Number(quantityElement.textContent) - 1);
}