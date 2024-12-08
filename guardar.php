<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conexión a la base de datos
    $serverName = "LAPTOP-TSSMHTAK"; // Cambia a tu servidor
    $connectionOptions = array(
        "Database" => "Residencias",
        "Uid" => "sa",
        "PWD" => "12345678"
    );
    $conn = sqlsrv_connect( $serverName, $connectionOptions);

    if( !$conn ) {
        die( print_r(sqlsrv_errors(), true));
    }

    // Obtener los datos del formulario
    $empresa = $_POST['empresa'];
    $contacto = $_POST['contacto'];
    $proyecto = $_POST['proyecto'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $archivo = $_FILES['archivo'];

    // Subir el archivo al servidor
    $ruta_archivo = 'uploads/' . basename($archivo["name"]);
    move_uploaded_file($archivo["tmp_name"], $ruta_archivo);

    // Insertar los datos en la tabla de proyectos
    $query = "INSERT INTO Proyectos (nombre_empresa, contacto_empresa, nombre_proyecto, descripcion, fecha_inicio, fecha_fin, archivo) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $params = array($empresa, $contacto, $proyecto, $descripcion, $fecha_inicio, $fecha_fin, $ruta_archivo);
    
    $stmt = sqlsrv_query($conn, $query, $params);
    if ($stmt === false) {
        die( print_r(sqlsrv_errors(), true));
    }

    // Opcional: registrar la acción en el log
    $id_proyecto = sqlsrv_insert_id($conn);
    $query_log = "INSERT INTO Logs (id_proyecto, accion) VALUES (?, 'Proyecto Subido')";
    $stmt_log = sqlsrv_query($conn, $query_log, array($id_proyecto));
    
    if ($stmt_log === false) {
        die( print_r(sqlsrv_errors(), true));
    }

    echo "Proyecto subido correctamente!";
    sqlsrv_close($conn);
}
?>
