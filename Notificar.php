<?php
include("ConexionBD.php");
$base = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "data_compra";

if (isset($_POST["Notificar"])) {
    $conexion = mysqli_connect($base, $usuario, $contrasena, $base_de_datos);

    if (!$conexion) {
        die("Error en la conexión a la base de datos: " . mysqli_connect_error());
    }

    $consulta = "SELECT Usuario, Email, ModeloDispositivo, IMEI, FechaRegistro FROM usuarios";
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

            // Configurar la solicitud a la API de Green
            $idInstance = "7103866914";
            $apiTokenInstance = "8dfda89d2c674d38ad90fdbcc5920c4ef71230910cf6445fbe";
            $url = "https://api.greenapi.com/waInstance{$idInstance}/sendMessage/{$apiTokenInstance}";
            $data = array(
                'chatId' => '51980702055', // Reemplaza con tu número de destino en el formato adecuado
                'message' => $mensaje
            );

            $options = array(
                'http' => array(
                    'header' => "Content-Type: application/json\r\n",
                    'method' => 'POST',
                    'content' => json_encode($data)
                )
            );

            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            $response = json_decode($result);

            if ($result) {
                echo "Mensaje enviado correctamente a través de Green.";
            } else {
                echo "Error al enviar el mensaje a través de Green.";
            }
        }
    } else {
        echo "Error en la consulta: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>


