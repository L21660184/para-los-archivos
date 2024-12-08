<?php
// Configuración de la base de datos
$serverName = "LAPTOP-TSSMHTAK";
$connectionOptions = array(
        "Database" => "Residencias",
        "Uid" => "sa",
        "PWD" => "12345678"
);
$conn = sqlsrv_connect( $serverName, $connectionOptions);

// Verificar si la conexión fue exitosa
if( !$conn ) {
    die( print_r(sqlsrv_errors(), true));  // Mostrar errores si la conexión falla
}

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $empresa = $_POST['empresa'];
    $contacto = $_POST['contacto'];
    $proyecto = $_POST['proyecto'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    // Subir el archivo
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
        $archivo = $_FILES['archivo'];
        $ruta_archivo = 'uploads/' . basename($archivo["name"]);
        
        // Mover el archivo a la carpeta de destino
        move_uploaded_file($archivo["tmp_name"], $ruta_archivo);
    } else {
        die('Error al subir el archivo');
    }

    // Insertar los datos en la base de datos
    $query = "INSERT INTO Proyectos (nombre_empresa, contacto_empresa, nombre_proyecto, descripcion, fecha_inicio, fecha_fin, archivo) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $params = array($empresa, $contacto, $proyecto, $descripcion, $fecha_inicio, $fecha_fin, $ruta_archivo);

    $stmt = sqlsrv_query($conn, $query, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));  // Mostrar errores si la consulta falla
    } else {
        echo "<script>alert('Proyecto subido correctamente!'); window.location.href='GTYV.html';</script>";
    }

    // Cerrar la conexión a la base de datos
    sqlsrv_close($conn);
}
?>
