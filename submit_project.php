<?php
// Configuración de la conexión a SQL Server
$serverName = "localhost"; // Cambia esto por tu servidor
$connectionInfo = array("Database" => "tu_base_de_datos", "UID" => "sa", "PWD" => "tu_contraseña");
$conn = sqlsrv_connect($serverName, $connectionInfo);

// Verificar la conexión
if (!$conn) {
    die("Conexión fallida: " . sqlsrv_errors());
}

// Procesar los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    // Subir archivo
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $file_name = basename($_FILES["file"]["name"]);
    } else {
        $file_name = null;
    }

    // Insertar datos en la base de datos
    $query = "INSERT INTO proyectos (nombre, descripcion, fecha_inicio, fecha_fin, archivo) 
              VALUES (?, ?, ?, ?, ?)";
    $params = array($nombre, $descripcion, $fecha_inicio, $fecha_fin, $file_name);

    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "Proyecto guardado exitosamente";
    }

    sqlsrv_free_stmt($stmt);
}

// Cerrar la conexión
sqlsrv_close($conn);
?>
