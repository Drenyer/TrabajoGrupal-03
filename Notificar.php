<?php
include("ConexionBD.php");
include("ConexionHTTP.php");
$base = "localhost";
$usuario = "root";
$contraseña = "";
$base_de_datos = "data_compra";

if (isset($_POST["Notificar"])) {
    $conexion = mysqli_connect($base, $usuario, $contraseña, $base_de_datos);

    if (!$conexion) {
        die("Error en la conexión a la base de datos: " . mysqli_connect_error());
    }

    $consulta = "SELECT Usuario, Email, ModeloDispositivo, IMEI, FechaRegistro FROM usuarios limit 1";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $mensaje = "Usted usuario de nombre " . $row['Usuario'] . " con el correo " . $row['Email'] . " el día " . $row['FechaRegistro'] . " registró su dispositivo " . $row['ModeloDispositivo'] . " con número de registro " . $row['IMEI'] . " le informamos que su solicitud procedió con éxito.";
            $insercion = "INSERT INTO notificacion (mensaje) VALUES ('$mensaje')";
            if (mysqli_query($conexion, $insercion)) {
                echo "Mensaje insertado correctamente.";
            } else {
                echo "Error al insertar el mensaje: " . mysqli_error($conexion);
            }
            
            $apiToken = "6625046765:AAE2BU5dp0GjCtq1Hwp0A3kcqiLCb3rX2Q4";

            $data = [
                'chat_id' => '@Mensajephp',
                'text' => $mensaje
            ];

            $response = getSslpage("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );
            
            
            

    mysqli_close($conexion);}

        }}
