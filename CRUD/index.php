<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>

</head>

<body>
    <div class="h2" >
        <h2>Escoge una de las opciones</h2>
    </div><br>
    <div>
        <?php
        include_once 'interfaz.php';
        ?>
    </div>
    <div class="row">
        <div class="col text-center">
            <button onclick="location.href='Registrar.php'">Registrar</button>
            <button onclick="location.href='Buscar.php'">Mostrar</button>
            <button onclick="location.href='Update.php'">Actualizar</button>
            <button onclick="location.href='Delete.php'">Borrar</button>
        </div>
    </div>

</body>

</html>