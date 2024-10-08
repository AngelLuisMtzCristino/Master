<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('img/hexagonos-colores-pastel_3840x2400.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #registrar {
            background: url('img/hexagonos-colores-pastel_3840x2400.jpg') no-repeat center center fixed;
            background-size: cover;
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            color: #555;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        button {
            background-color: #00ff4cb3;
            color: rgb(0, 0, 0);
            width: 100%;
            padding: 10px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.5s ;
        }

        button:hover {
            background-color: #00b389;
        }

    </style>
</head>
<body>
    <div id="registrar">
        <h1>Registrar</h1>
        <form  method="post">
            <label >Curp:</label>
            <input name="curp" type="text"><br>

            <label >Nombre:</label>
            <input name="nombre" type="text"><br>

            <label >Apellido Paterno</label>
            <input name="ap_pat" type="text"><br>

            <label >Apellido Materno</label>
            <input name="ap_mat" type="text"><br>

            <label >Fecha de nacimiento</label>
            <input name="fecha_nac" type="date"><br>

            <label >Escolaridad</label>
            <select name="escolaridad" >
                <option value="sin_escolaridad">Sin Escolaridad</option>
                <option value="basica">Basica</option>
                <option value="media_superior">Media Superior</option>
                <option value="superior">Superior</option>
            </select><br>

            <label >Domicilio</label>
            <input name="domicilio" type="text"><br><br><br>

            <button type="submit">Registrarse</button>
        </form>
        <br><br>

        <button onclick="location.href='index.html'">Volver al inicio</button>

    </div>
    
    <?php
    
    $servidor="localhost";
    $user="root";
    $pass="";
    $DB="crud";
    
    $conexion=mysqli_connect($servidor, $user, $pass, $DB);
    //echo ("se logro la conexion");
    
    if ($conexion->connect_error) {
        // code...
        die ("no se logro la conexion".mysqli_connect_error());
    
    }

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $curp=isset($_POST['curp'])?$_POST['curp']:'';
        $nombre=isset($_POST['nombre'])?$_POST['nombre']:'';
        $ap_pat=isset($_POST['ap_pat'])?$_POST['ap_pat']:'';
        $ap_mat=isset($_POST['ap_mat'])?$_POST['ap_mat']:'';
        $fecha_nac=isset($_POST['fecha_nac'])?$_POST['fecha_nac']:'';
        $escolaridad=isset($_POST['escolaridad'])?$_POST['escolaridad'] : '';
        $domicilio=isset($_POST['domicilio'])?$_POST['domicilio']:'';

        $insert=$conexion->prepare("INSERT INTO empleado (curp,nombre,ap_pat,ap_mat,fecha_nac,escolaridad,domicilio)
        VALUES('$curp','$nombre','$ap_pat','$ap_mat','$fecha_nac','$escolaridad','$domicilio')");
        //$insert->bind_param('sssssss', $curp, $nombre, $ap_pat, $ap_mat, $fecha_nac, $escolaridad, $domicilio);

        if ($insert->execute()) {
            // code...

            echo "Datos fueron insertados";
        }   
        else {
            echo "Error de insercion".$insert->error;
        }

    }

?>
</body>
</html>