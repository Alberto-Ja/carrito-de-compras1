<?php
session_start();

// Si el carrito no existe en la sesión, lo inicializamos como un arreglo vacío
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

// Catálogo maestro de productos
$productos_db = array(
    1 => array('id' => 1, 'nombre' => 'LATA DE FRIJOLES REFRITOS', 'precio' => 25.00, 'descripcion' => 'ES UNA LATA DE ALUMINIO QUE CONTIENE FRIJOLES REFRITOS'),
    2 => array('id' => 2, 'nombre' => 'LATA DE ATUN', 'precio' => 20.00, 'descripcion' => 'ES UNA LATA DE ALUMINIO QUE CONTIENE ATUN CON POCA SOYA'),
    3 => array('id' => 3, 'nombre' => 'LATA DE PIÑA EN ALMIBAR', 'precio' => 35.00, 'descripcion' => 'ES UNA LATA DE ALUMINIO QUE CONTIENE PIÑA CORTADA EN RODAJAS Y ESTA EN ALMIBAR PARA CONSERVAR'),
    4 => array('id' => 4, 'nombre' => 'SALSA DE TOMATE', 'precio' => 30.00, 'descripcion' => 'ES UN FRASCO DE VIDRIO QUE CONTIENE SALSA DE TOMATE Y DIFERENTES ESPECIAS'),
    5 => array('id' => 5, 'nombre' => 'LECHE', 'precio' => 20.00, 'descripcion' => 'ES UNA BOTELLA DE 1LITRO QUE CONTIENE LECHE ENTERA DE VACA Y PASTEURISADA'),
    6 => array('id' => 6, 'nombre' => 'CHOCOLATE', 'precio' => 25.00, 'descripcion' => 'ES UNA BOLSA DE POLIPAPEL QUE CONTIENE CHOCOLATE EN POLVO'),
    7 => array('id' => 7, 'nombre' => 'CAFE', 'precio' => 55.00, 'descripcion' => 'ES UN FRASCO DE VIDRIO DONDE CONTIENE CAFE TOSTADO Y GRANULADO'),
    8 => array('id' => 8, 'nombre' => 'PASTA DENTAL', 'precio' => 25.00, 'descripcion' => 'ES UN PEQUEÑO TUBO DENTRIFICO QUE CONTIENE LA PASTA DENTAL PARA EL USO DEL ASEO BUCAL'),
    9 => array('id' => 9, 'nombre' => 'PAPEL HIGIENICO', 'precio' => 20.00, 'descripcion' => 'ES UN PAQUETE QUE CONTIENE 4 ROLLOS DE PAPEL HIGIENICO PARA EL ASEO PERSONAL'),
    10 => array('id' => 10, 'nombre' => 'JAVON DE TOCADOR', 'precio' => 15.00, 'descripcion' => 'ES UNA BARRA DE JABON PARA EL USO PERSONAL Y LIMPIESA')
);

// Procesar acciones enviadas mediante GET
if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    switch ($accion) {
        case 'agregar':
            if (isset($productos_db[$id])) {
                if (isset($_SESSION['carrito'][$id])) {
                    $_SESSION['carrito'][$id]['cantidad']++;
                } else {
                    $_SESSION['carrito'][$id] = array(
                        'id' => $productos_db[$id]['id'],
                        'nombre' => $productos_db[$id]['nombre'],
                        'precio' => $productos_db[$id]['precio'],
                        'cantidad' => 1
                    );
                }
            }
            header('Location: index.php?mensaje=agregado');
            exit();

        case 'aumentar':
            if (isset($_SESSION['carrito'][$id])) {
                $_SESSION['carrito'][$id]['cantidad']++;
            }
            header('Location: carrito.php');
            exit();

        case 'disminuir':
            if (isset($_SESSION['carrito'][$id])) {
                $_SESSION['carrito'][$id]['cantidad']--;
                if ($_SESSION['carrito'][$id]['cantidad'] <= 0) {
                    unset($_SESSION['carrito'][$id]);
                }
            }
            header('Location: carrito.php');
            exit();

        case 'eliminar':
            if (isset($_SESSION['carrito'][$id])) {
                unset($_SESSION['carrito'][$id]);
            }
            header('Location: carrito.php');
            exit();

        case 'vaciar':
            $_SESSION['carrito'] = array();
            header('Location: carrito.php');
            exit();
    }
}
?>