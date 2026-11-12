<?php
require_once 'acciones.php';

// Contar número total de artículos en el carrito para mostrar en el header
$total_articulos = 0;
foreach ($_SESSION['carrito'] as $item) {
    $total_articulos += $item['cantidad'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos - Abarrotes</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <header class="navbar">
        <div class="contenedor header-content">
            <h1>🛍️ Tienda de Abarrotes</h1>
            <a href="carrito.php" class="btn-carrito">
                🛒 Ver Carrito <span id="contador-carrito" class="badge"><?php echo $total_articulos; ?></span>
            </a>
        </div>
    </header>

    <main class="contenedor">
        <h2>Catálogo de Productos</h2>

        <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'agregado'): ?>
            <div class="alerta exito" id="alerta-mensaje">
                ¡Producto agregado al carrito con éxito!
            </div>
        <?php endif; ?>

        <div class="grid-productos">
            <?php foreach ($productos_db as $producto): ?>
                <div class="tarjeta-producto">
                    <div class="producto-body">
                        <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                        <p class="descripcion"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                        <p class="precio">$<?php echo number_format($producto['precio'], 2); ?></p>
                    </div>
                    <div class="producto-footer">
                        <a href="acciones.php?accion=agregar&id=<?php echo $producto['id']; ?>" class="btn btn-agregar">
                            ➕ Agregar al Carrito
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <script>
        // JavaScript para ocultar el mensaje de confirmación después de 3 segundos
        const alerta = document.getElementById('alerta-mensaje');
        if (alerta) {
            setTimeout(() => {
                alerta.style.opacity = '0';
                setTimeout(() => alerta.remove(), 500);
            }, 3000);
        }
    </script>
</body>
</html>