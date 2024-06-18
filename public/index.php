<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="js/script.js" defer></script>
</head>
<body class="bg-gray-300 p-6">
    <div class="max-w-2xl mx-auto bg-white p-5 rounded shadow-md">
        <h1 class="text-2xl font-bold mb-4">Gestión de Productos</h1>
        <form id="productForm" class="mb-4" method="POST" action="">
            <div class="mb-4">
                <label for="productName" class="block text-sm font-medium text-gray-700">Nombre del Producto</label>
                <input type="text" id="productName" name="nombre" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                <span id="productNameError" class="text-red-500 text-sm"></span>
            </div>
            <div class="mb-4">
                <label for="productPrice" class="block text-sm font-medium text-gray-700">Precio por Unidad</label>
                <input type="text" id="productPrice" name="precio" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                <span id="productPriceError" class="text-red-500 text-sm"></span>
            </div>
            <div class="mb-4">
                <label for="productQuantity" class="block text-sm font-medium text-gray-700">Cantidad en Inventario</label>
                <input type="text" id="productQuantity" name="cantidad" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                <span id="productQuantityError" class="text-red-500 text-sm"></span>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Agregar Producto</button>
        </form>
        <table class="min-w-full bg-white shadow-md rounded">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border-b border-gray-300">Nombre del Producto</th>
                    <th class="py-2 px-4 border-b border-gray-300">Precio por Unidad</th>
                    <th class="py-2 px-4 border-b border-gray-300">Cantidad de Inventario</th>
                    <th class="py-2 px-4 border-b border-gray-300">Valor Total</th>
                    <th class="py-2 px-4 border-b border-gray-300">Estado</th>
                </tr>
            </thead>
            <tbody id="productTableBody">
                <?php
                session_start();
                if (!isset($_SESSION['productos'])) {
                    $_SESSION['productos'] = [];
                }

                function agregarProducto(&$productos, $nombre, $precio, $cantidad) {
                    $productos[] = [
                        'nombre' => $nombre,
                        'precio' => (float) $precio,
                        'cantidad' => (int) $cantidad
                    ];
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $nombre = $_POST['nombre'];
                    $precio = $_POST['precio'];
                    $cantidad = $_POST['cantidad'];
                    agregarProducto($_SESSION['productos'], $nombre, $precio, $cantidad);
                }

                function mostrarProductos($productos) {
                    foreach ($productos as $producto) {
                        $valorTotal = $producto['precio'] * $producto['cantidad'];
                        $estado = $producto['cantidad'] > 0 ? 'En stock' : 'Agotado';
                        echo "<tr>";
                        echo "<td class='py-2 px-4 border-b border-gray-300'>{$producto['nombre']}</td>";
                        echo "<td class='py-2 px-4 border-b border-gray-300'>{$producto['precio']}</td>";
                        echo "<td class='py-2 px-4 border-b border-gray-300'>{$producto['cantidad']}</td>";
                        echo "<td class='py-2 px-4 border-b border-gray-300'>" . number_format($valorTotal, 2) . "</td>";
                        echo "<td class='py-2 px-4 border-b border-gray-300'>{$estado}</td>";
                        echo "</tr>";
                    }
                }

                mostrarProductos($_SESSION['productos']);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
