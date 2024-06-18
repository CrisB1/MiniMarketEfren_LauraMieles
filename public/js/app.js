document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('productForm');

    form.addEventListener('submit', (e) => {
        const productName = document.getElementById('productName').value.trim();
        const productPrice = parseFloat(document.getElementById('productPrice').value.replace(',', '.'));
        const productQuantity = parseInt(document.getElementById('productQuantity').value);

        let valid = true;

        if (!productName) {
            document.getElementById('productNameError').textContent = 'Ingrese un nombre de producto válido.';
            valid = false;
        } else {
            document.getElementById('productNameError').textContent = '';
        }

        if (isNaN(productPrice) || productPrice <= 0) {
            document.getElementById('productPriceError').textContent = 'Ingrese un precio válido.';
            valid = false;
        } else {
            document.getElementById('productPriceError').textContent = '';
        }

        if (isNaN(productQuantity) || productQuantity < 0) {
            document.getElementById('productQuantityError').textContent = 'Ingrese una cantidad válida.';
            valid = false;
        } else {
            document.getElementById('productQuantityError').textContent = '';
        }

        if (!valid) {
            e.preventDefault();
        }
    });
});
