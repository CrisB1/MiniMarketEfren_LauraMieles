<?php
$productos = [];

function agregarProducto($nombre, $precio, $cantidad) {
    global $productos;
    $productos[] = ['nombre' => $nombre, 'precio' => $precio, 'cantidad' => $cantidad];
}

function mostrarProductos() {
    global $productos;
    echo '<div class="w-full max-w-xl">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Nombre del Producto</th>
                        <th class="border border-gray-300 px-4 py-2">Precio por Unidad</th>
                        <th class="border border-gray-300 px-4 py-2">Cantidad en Inventario</th>
                        <th class="border border-gray-300 px-4 py-2">Valor Total</th>
                        <th class="border border-gray-300 px-4 py-2">Estado</th>
                    </tr>
                </thead>
                <tbody>';

    foreach ($productos as $producto) {
        $total = $producto['precio'] * $producto['cantidad'];
        $estado = $producto['cantidad'] === 0 ? 'Agotado' : 'En Stock';

        echo '<tr>
                <td class="border border-gray-300 px-4 py-2">' . $producto['nombre'] . '</td>
                <td class="border border-gray-300 px-4 py-2">' . $producto['precio'] . '</td>
                <td class="border border-gray-300 px-4 py-2">' . $producto['cantidad'] . '</td>
                <td class="border border-gray-300 px-4 py-2">' . $total . '</td>
                <td class="border border-gray-300 px-4 py-2">' . $estado . '</td>
            </tr>';
    }

    echo '</tbody>
        </table>
    </div>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['productName']) && isset($_POST['productPrice']) && isset($_POST['productQuantity'])) {
        $productName = $_POST['productName'];
        $productPrice = floatval($_POST['productPrice']);
        $productQuantity = intval($_POST['productQuantity']);

        if (!empty($productName) && $productPrice > 0 && $productQuantity >= 0) {
            agregarProducto($productName, $productPrice, $productQuantity);
        }
    }
}

mostrarProductos();
?>

