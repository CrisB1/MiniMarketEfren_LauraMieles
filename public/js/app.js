document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('productForm');
    const table = document.getElementById('productTable');
    let productos = [];

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const productName = document.getElementById('productName').value.trim();
        const productPrice = parseFloat(document.getElementById('productPrice').value.replace(',', '.'));
        const productQuantity = parseInt(document.getElementById('productQuantity').value);

        if (!productName) {
            document.getElementById('productNameError').textContent = 'Ingrese un nombre de producto válido.';
            return;
        }

        if (isNaN(productPrice) || productPrice <= 0) {
            document.getElementById('productPriceError').textContent = 'Ingrese un precio válido.';
            return;
        }

        if (isNaN(productQuantity) || productQuantity < 0) {
            document.getElementById('productQuantityError').textContent = 'Ingrese una cantidad válida.';
            return;
        }

        const producto = { name: productName, price: productPrice, quantity: productQuantity };
        productos.push(producto);
        updateTable(producto);
        form.reset();
    });

    function updateTable(producto) {
        const tableRow = document.createElement('tr');
        tableRow.innerHTML = `
            <td class="border border-gray-300 px-4 py-2">${producto.name}</td>
            <td class="border border-gray-300 px-4 py-2">${producto.price.toFixed(2)}</td>
            <td class="border border-gray-300 px-4 py-2">${producto.quantity}</td>
        `;

        table.appendChild(tableRow);
    }
});
