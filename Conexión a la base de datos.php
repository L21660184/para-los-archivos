    // Conexión a la base de datos
    $serverName = "LAPTOP-TSSMHTAK"; // Cambia a tu servidor
    $connectionOptions = array(
        "Database" => "Residencias",
        "Uid" => "sa",
        "PWD" => "12345678"
$conn = sqlsrv_connect( $serverName, $connectionOptions);

if( !$conn ) {
    die( print_r(sqlsrv_errors(), true)); // Mostrar errores si la conexión falla
} else {
    echo "Conexión exitosa!";
}