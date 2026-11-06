<?php
session_cache_limiter();
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <title>Tienda</title>
</head>

<body>
    <div class="container">
        <h1>Tienda de electrodomésticos</h1>
        <form action="login.php" method="post">
            <legend>Login</legend>
            <div class="col-md-6 col-lg-3 mb-3">
                <input name="email" type="text" class="form-control" placeholder="Email usuario" />
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <input name="password" type="password" class="form-control" placeholder="Contraseña" />
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <input type="submit" value="Acceder" class="btn btn-primary">
            </div>

        </form>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>