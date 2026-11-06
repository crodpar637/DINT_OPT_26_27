<?php
session_start();
require_once("funcionesUtiles.php");
comprobarSesionAdmin();

require_once("funcionesBD.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <title>Tienda: Alta producto</title>
</head>

<body>
    <div class="container">

        <h4>Procesar el alta del producto</h4>

        <?php

        $nombre = $_POST["txtNombre"];
        $descripcion = $_POST["txtDescripcion"];
        $stock = $_POST["txtStock"];
        $precio = $_POST["txtPrecio"];
        $categorias = $_POST["lstCategoria"];

        $conexion = obtenerConexion();

        $sql = "INSERT INTO productos (Nombre, Descripcion, Stock, precio, CodCat) VALUES ('$nombre', '$descripcion', '$stock', '$precio', '$categorias');";
        mysqli_query($conexion, $sql);

        if (mysqli_errno($conexion) != 0) {
            $numerror = mysqli_errno($conexion);
            $descrerror = mysqli_error($conexion);

            if ($numerror == 1062) {
                echo "<p>Ya existe el producto $nombre en la Base de Datos.</p>";
                echo "<p><a href='altaProducto.php' class='btn btn-primary'>Añadir otro producto</a></p>";
            } else {
                echo "<p>Se ha producido un error numero $numerror que corresponde a: $descrerror</p>";
            }
        } else {  // Inserción correcta del producto, ahora procesar la imagen

            // Revisamos errores en la subida del fichero de la imagen
            if ($_FILES['imagen']['error'] != UPLOAD_ERR_OK) {
                switch ($_FILES['imagen']['error']) {
                    case UPLOAD_ERR_INI_SIZE:
                        die('El tamaño del archivo excede el permitido por la directiva  upload_max_filesize establecida en php.ini. ');
                        break;
                    case UPLOAD_ERR_FORM_SIZE:
                        die('El tamaño  del archivo cargado excede el permitido por la directiva  MAX_FILE_SIZE establecida en  el formulario HTML.');
                        break;
                    case UPLOAD_ERR_PARTIAL:
                        die('El archivo se ha cargado parcialmente ');
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        die('No ha cargado ningún archivo');
                        break;
                    case UPLOAD_ERR_NO_TMP_DIR:
                        die('No se encuentra el directorio temporal del servidor ');
                        break;
                    case UPLOAD_ERR_CANT_WRITE:
                        die('El servidor ha fallado al intentar escribir el archivo en el disco');
                        break;
                    case UPLOAD_ERR_EXTENSION:
                        die('Subida detenida por la extensión');
                        break;
                }
            }

            // Recuperamos los atributos de la imagen
            list($width, $height, $type, $attr) = getimagesize($_FILES['imagen']['tmp_name']);

            // Asegurarse de que el archivo cargado es un tipo de imagen admitido
            $error = 'El archivo que vd. ha subido no es de un tipo soportado';
            switch ($type) {
                case IMAGETYPE_GIF:
                    $image = imagecreatefromgif($_FILES['imagen']['tmp_name']) or
                        die($error);
                    $ext = '.gif';
                    break;
                case IMAGETYPE_JPEG:
                    $image = imagecreatefromjpeg($_FILES['imagen']['tmp_name']) or
                        die($error);
                    $ext = '.jpg';
                    break;
                case IMAGETYPE_PNG:
                    $image = imagecreatefrompng($_FILES['imagen']['tmp_name']) or
                        die($error);
                    $ext = '.png';
                    break;
                default:
                    die($error);
            }

            //Recuperar el  image_id generado automáticamente por MySQL al insertar
            //el nuevo registro de productos
            $last_id = mysqli_insert_id($conexion);
            $image_id = $last_id;
            // Directorio de imagenes
            $dir = "imagenes";
            // Guardar  la imagen en la ruta indicada
            switch ($type) {
                case IMAGETYPE_GIF:
                    imagegif($image, $dir . '/' . $image_id );
                    break;
                case IMAGETYPE_JPEG:
                    imagejpeg($image, $dir . '/' . $image_id, 100);
                    break;
                case IMAGETYPE_PNG:
                    imagepng($image, $dir . '/' . $image_id);
                    break;
            }
            imagedestroy($image);
           

            // Salida si todo ha ido bien
            echo "<p>Ha añadido un nuevo producto.</p>";
            echo "<p><a href='altaProducto.php' class='btn btn-primary'>Añadir otro producto</a></p>";
        }

        echo "<a href='admin.php' class='btn btn-primary'>Vuelta al menú de administrador</a>";
        ?>

    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>