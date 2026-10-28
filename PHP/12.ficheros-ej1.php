<?php
rmdir("/.ej1");

mkdir("./ej1");
mkdir("./ej1/php");
mkdir("./ej1/public");
mkdir("./ej1/public/css");
mkdir("./ej1/public/js");

touch("./ej1/php/directorios.php");

touch("./ej1/index.php");

file_put_contents("./ej1/index.php", "<form action='./php/servidor.php' method='GET'><input type='submit' name='aceptar' value='aceptar'></form>");

// touch("./ej1/php/servidor.php");

file_put_contents("./ej1/php/servidor.php", "<?php \n mkdir('../basedatos'); \n touch('../basedatos/bd.sqlite'); ");