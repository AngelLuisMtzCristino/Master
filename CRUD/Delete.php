<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Búsqueda</title>

</head>
<body>
    <div class="container">
        <h2>Buscar</h2>
        <form method="post">
            <input type="text" name="curp" placeholder="Ingrese la curp" required>
            <button type="submit">borrar</button><br><br>
        </form>
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
            $sql = "DELETE FROM empleado WHERE curp = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $curp);

            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo '<p>Registro con Curp ' . htmlspecialchars($curp) . ' fue borrado exitosamente.</p>';
                } else {
                    echo '<p>Curp no encontrada.</p>';
                }
            } else {
                echo '<p>Error al intentar borrar el registro: ' . $stmt->error . '</p>';
            }

            $stmt->close(); //se cierra la consulta

        }
        ?>


    </div>
</body>
</html>
