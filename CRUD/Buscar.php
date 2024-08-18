<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Búsqueda</title>

</head>

<body>
    <div>
        <?php
        include_once 'interfaz.php';
        ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Buscar</h2>
                <form method="post">
                    <input type="text" name="curp" class="form-control" placeholder="Ingrese la curp" required>
                    <button type="submit">Buscar</button><br><br>
                </form>
            </div>
        </div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Configuración de la conexión a la base de datos
            $server = "localhost";
            $user = "root";
            $pass = "";
            $DB = "crud";

            // Crear conexión
            $conn = new mysqli($server, $user, $pass, $DB);

            // Verificar conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            $curp = $_POST['curp'];
            $sql = "SELECT nombre, ap_pat, ap_mat FROM empleado WHERE curp = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $curp);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                echo '<label>Nombre del empleado</label>';
                echo '<input type="text" value="' . $row["nombre"] . '" placeholder="nombre" readonly ><br>';
                echo '<label>Apellido Paterno</label>';
                echo '<input type="text" value="' . $row["ap_pat"] . '" placeholder="ap_pat" readonly ><br>';
                echo '<label>Apellido Materno</label>';
                echo '<input type="text" value="' . $row["ap_mat"] . '" placeholder="ap_mat" readonly ><br>';
            } else {
                echo '<p>Curp no encontrada</p>';
            }

            $stmt->close(); //se cierra la consulta

        }
        ?>


    </div>
</body>

</html>