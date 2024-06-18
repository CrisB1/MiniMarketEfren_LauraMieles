<?php
session_start();

// Inicializar el array de productos si no está ya en la sesión
if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['productName'];
    $productPrice = floatval($_POST['productPrice']);
    $productQuantity = intval($_POST['productQuantity']);

    if (!empty($productName) && $productPrice > 0 && $productQuantity >= 0) {
        $_SESSION['productos'][] = [
            'nombre' => $productName,
            'precio' => $productPrice,
            'cantidad' => $productQuantity
        ];
    }
}

function mostrarProductos() {
    if (!isset($_SESSION['productos']) || empty($_SESSION['productos'])) {
        echo '<p class="text-center text-gray-500">No hay productos en el inventario.</p>';
        return;
    }

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

    foreach ($_SESSION['productos'] as $producto) {
        $total = $producto['precio'] * $producto['cantidad'];
        $estado = $producto['cantidad'] === 0 ? 'Agotado' : 'En Stock';

        echo '<tr>
                <td class="border border-gray-300 px-4 py-2">' . htmlspecialchars($producto['nombre']) . '</td>
                <td class="border border-gray-300 px-4 py-2">' . number_format($producto['precio'], 2) . '</td>
                <td class="border border-gray-300 px-4 py-2">' . $producto['cantidad'] . '</td>
                <td class="border border-gray-300 px-4 py-2">' . number_format($total, 2) . '</td>
                <td class="border border-gray-300 px-4 py-2">' . $estado . '</td>
            </tr>';
    }

    echo '</tbody>
        </table>
    </div>';
}

mostrarProductos();
?>
