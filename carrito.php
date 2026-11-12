<?php
require_once 'acciones.php';

$gran_total = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <header class="navbar">
        <div class="contenedor header-content">
            <h1>🛍️ Tienda de Abarrotes</h1>
            <a href="index.php" class="btn btn-secundario">← Volver al Catálogo</a>
        </div>
    </header>

    <main class="contenedor">
        <h2>Tu Carrito de Compras</h2>

        <?php if (empty($_SESSION['carrito'])): ?>
            <div class="carrito-vacio">
                <p>🛒 El carrito está vacío.</p>
                <a href="index.php" class="btn btn-agregar">Ir a comprar productos</a>
            </div>
        <?php else: ?>
            <div class="tabla-responsive">
                <table class="tabla-carrito">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Monto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['carrito'] as $id => $item): 
                            $monto = $item['precio'] * $item['cantidad'];
                            $gran_total += $monto;
                        ?>
                            <tr>
                                <td><strong><?php echo htmlspecialchars($item['nombre']); ?></strong></td>
                                <td>$<?php echo number_format($item['precio'], 2); ?></td>
                                <td>
                                    <div class="control-cantidad">
                                        <a href="acciones.php?accion=disminuir&id=<?php echo $id; ?>" class="btn-cantidad">-</a>
                                        <span class="cantidad-numero"><?php echo $item['cantidad']; ?></span>
                                        <a href="acciones.php?accion=aumentar&id=<?php echo $id; ?>" class="btn-cantidad">+</a>
                                    </div>
                                </td>
                                <td><strong>$<?php echo number_format($monto, 2); ?></strong></td>
                                <td>
                                    <a href="acciones.php?accion=eliminar&id=<?php echo $id; ?>" 
                                       class="btn btn-eliminar"
                                       onclick="return confirm('¿Deseas eliminar este producto del carrito?');">
                                       🗑️ Eliminar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right"><strong>TOTAL DEL CARRITO:</strong></td>
                            <td colspan="2" class="gran-total">$<?php echo number_format($gran_total, 2); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="acciones-carrito">
                <a href="acciones.php?accion=vaciar" 
                   class="btn btn-vaciar" 
                   onclick="return confirm('¿Seguro que deseas vaciar todo el carrito?');">
                    🗑️ Vaciar Carrito
                </a>
                <button class="btn btn-pagar" onclick="realizarCompra()">💳 Proceder al Pago</button>
            </div>
        <?php endif; ?>
    </main>

    <script>
        function realizarCompra() {
            alert("¡Gracias por tu compra! Tu pedido por un total de $<?php echo number_format($gran_total, 2); ?> ha sido procesado.");
            window.location.href = "acciones.php?accion=vaciar";
        }
    </script>
</body>
</html>