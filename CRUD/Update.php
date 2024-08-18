<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar</title>
</head>

<body>
    <div>
        <?php
        include_once 'interfaz.php';
        ?>
    </div>
    <div class="actualizar">
        <div class="row">
            <div class="col">
                <h2>Actualizar </h2>
                <form method="post">
                    <input type="text" class="form-control" name="curp" placeholder="Ingrese el CURP" required>
                    <button type="submit" name="buscar">Buscar</button>
                    <br><br>
                </form>
            </div>
        </div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
            $server = "localhost";
            $user = "root";
            $pass = "";
            $DB = "crud";

            $conexion = mysqli_connect($server, $user, $pass, $DB);
            if ($conexion->connect_error) {
                die("no se logro la conexion" . $connect_error);
            }

            $curp = $_POST['curp'];
            $sql = "SELECT nombre, ap_pat, ap_mat, fecha_nac, escolaridad,domicilio FROM empleado WHERE curp = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("s", $curp);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
                <form method="post">
                    <input type="hidden" name="curp" value="<?php echo htmlspecialchars($curp); ?>">

                    <label>Nombre</label><br>
                    <input type="text" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>"><br>

                    <label>Apellido Paterno</label><br>
                    <input type="text" name="ap_pat" value="<?php echo htmlspecialchars($row['ap_pat']); ?>"><br>

                    <label>Apellido Materno</label><br>
                    <input type="text" name="ap_mat" value="<?php echo htmlspecialchars($row['ap_mat']); ?>"><br>

                    <label>Fecha de nacimiento</label><br>
                    <input type="text" name="fecha_nac" value="<?php echo htmlspecialchars($row['fecha_nac']); ?>"><br>

                    <label>Escolaridad</label><br>
                    <input type="text" name="escolaridad" value="<?php echo htmlspecialchars($row['escolaridad']); ?>"><br>

                    <label>Domicilio</label><br>
                    <input type="text" name="domicilio" value="<?php echo htmlspecialchars($row['domicilio']); ?>"><br><br>

                    <button type="submit" name="actualizar">Actualizar</button>
                </form>

        <?php
            } else {
                echo "No se encontraron";
            }
            $stmt->close();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
            $servidor = "localhost";
            $user = "root";
            $pass = "";
            $DB = "crud";

            $conexion = mysqli_connect($servidor, $user, $pass, $DB);
            if ($conexion->connect_error) {
                die("no se logro la conexion" . $connect_error);
            }

            $curp = $_POST['curp'];
            $nombre = $_POST['nombre'];
            $ap_pat = $_POST['ap_pat'];
            $ap_mat = $_POST['ap_mat'];
            $fecha_n = $_POST['fecha_nac'];
            $escolaridad = $_POST['escolaridad'];
            $domicilio = $_POST['domicilio'];
            $sql = "UPDATE empleado SET nombre=?, ap_pat=?, ap_mat=?, fecha_nac=?, escolaridad=?, domicilio=? WHERE curp=?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("sssssss", $nombre, $ap_pat, $ap_mat, $fecha_n, $escolaridad, $domicilio, $curp);

            if ($stmt->execute()) {
                echo "registro actualizado";
            } else {
                echo "error actualizar : " . $stmt->error . "";
            }

            $stmt->close();
        }
        ?>
    </div>
</body>

</html>