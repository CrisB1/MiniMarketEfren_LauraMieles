<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimarket</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-custom-red { background-color: #ff4c4c; }
        .bg-custom-black { background-color: #333333; color: white; }
        .text-custom-red { color: #ff4c4c; }
        .text-custom-black { color: #333333; }
    </style>
</head>
<body class="bg-gray-100 p-4">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4 text-custom-black">Gestión de Productos</h1>
        
        <!-- Formulario para ingresar productos -->
        <form id="productForm" method="POST" action="index.php" class="mb-4 flex flex-col">
            <label for="productName" class="mb-2 text-custom-black">Nombre del Producto:</label>
            <input type="text" id="productName" name="productName" class="border p-2 mb-2" required>
            <div id="productNameError" class="text-custom-red text-sm mb-2"></div>

            <label for="productPrice" class="mb-2 text-custom-black">Precio por Unidad:</label>
            <input type="text" id="productPrice" name="productPrice" class="border p-2 mb-2" required>
            <div id="productPriceError" class="text-custom-red text-sm mb-2"></div>

            <label for="productQuantity" class="mb-2 text-custom-black">Cantidad en Inventario:</label>
            <input type="number" id="productQuantity" name="productQuantity" class="border p-2 mb-2" required>
            <div id="productQuantityError" class="text-custom-red text-sm mb-2"></div>

            <button type="submit" class="bg-custom-red hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                Agregar Producto
            </button>
        </form>

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
                            <tr class="bg-custom-black">
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
                $estadoClass = $producto['cantidad'] === 0 ? 'text-custom-red' : 'text-custom-black';

                echo '<tr>
                        <td class="border border-gray-300 px-4 py-2">' . htmlspecialchars($producto['nombre']) . '</td>
                        <td class="border border-gray-300 px-4 py-2">' . number_format($producto['precio'], 2) . '</td>
                        <td class="border border-gray-300 px-4 py-2">' . $producto['cantidad'] . '</td>
                        <td class="border border-gray-300 px-4 py-2">' . number_format($total, 2) . '</td>
                        <td class="border border-gray-300 px-4 py-2 ' . $estadoClass . '">' . $estado . '</td>
                    </tr>';
            }

            echo '</tbody>
                </table>
            </div>';
        }

        mostrarProductos();
        ?>
    </div>

    <script src="app.js"></script>
</body>
</html>
