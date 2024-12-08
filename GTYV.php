<?php
// Conexión a la base de datos
    $serverName = "LAPTOP-TSSMHTAK"; // Cambia a tu servidor
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

// Consulta para obtener todos los proyectos
$query = "SELECT * FROM Proyectos";
$stmt = sqlsrv_query($conn, $query);

$projects = [];
while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $projects[] = $row;
}

// Cerrar la conexión
sqlsrv_close($conn);
?>
