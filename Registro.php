    <?php
    include("ConexionBD.php");
    $base = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_de_datos = "data_compra";

    if (isset($_POST["Insertar"])) {
        if (
            strlen($_POST["name"]) >= 1 && strlen($_POST["email"]) >= 1
            && strlen($_POST["IMEI"]) >= 1 && isset($_POST["opcion"])
        ) {

            $ValorOpcion = trim($_POST["opcion"]);
            $Name = trim($_POST["name"]);
            $Email = trim($_POST["email"]);
            $IMEI = trim($_POST["IMEI"]);
            $Fecha = date("y/m/d");
            $consulta = "INSERT INTO usuarios(Usuario, Email, ModeloDispositivo, IMEI, FechaRegistro) 
    VALUES ('$Name', '$Email', '$ValorOpcion', '$IMEI', '$Fecha')";
            $resultado = mysqli_query($Conexion, $consulta);
            if ($resultado) {
    ?>
                <h3>Se registro de manera exitosa</h3>
            <?php
            } else {
            
                echo "Hubo un error";
                
                
            }
        } else {
            ?>
            <h3>Los campos tienen que ser rellenados </h3>
    <?php
        }
    }
    if (isset($_POST["Eliminar"])) {
        $name = trim($_POST["name"]);

        if ($name != "") {
            $consultaE = "DELETE FROM usuarios WHERE Usuario='$name'";
            $resultadoE = mysqli_query($Conexion, $consultaE);
               
            if ($resultadoE) {
                echo "El usuario ha sido eliminado de manera correcta.";
            } else {
                echo "El usuario no se encuentra en la base de datos.";
            }
        } else {
            echo "Por favor, complete solo el campo de usuario.";
        }
    }
    

    session_start();

    if(isset($_POST["Actualizar"])){
        $conexion=mysqli_connect($base,$usuario,$contrasena,$base_de_datos);    
        if (!$conexion) {
         die("Error en la conexión a la base de datos: " . mysqli_connect_error());
        }
    
        if(isset($_SESSION["updating"]) && $_SESSION["updating"] == true){
            $Name = $_SESSION["name"];
            $nuevoName = trim($_POST["name"]); 
            $consultaA = "UPDATE usuarios SET Usuario='$nuevoName' WHERE Usuario='$Name'";
            $resultadoA=mysqli_query($conexion,$consultaA);
            if ($resultadoA) {
                echo "El usuario $Name ha sido actualizado correctamente a $nuevoName.";
                $_SESSION["updating"] = false; 
            } else {
                echo "Error en la actualización: " . mysqli_error($conexion);
            }
        } else {
            $Name = trim($_POST["name"]);
            $consulta = "SELECT * FROM usuarios WHERE Usuario='$Name'";
            $resultado = mysqli_query($conexion, $consulta);
            if (mysqli_num_rows($resultado) > 0) {
                echo "El nombre está en la base de datos, ingrese el nuevo nombre en el campo Usuario";
                $_SESSION["updating"] = true; 
                $_SESSION["name"] = $Name; 
            } else {
                echo "<br>Revise el campo de usuario / valor no encontrado $Name.";
        }
    }
}

    if (isset($_POST["Mostrar"])) {
        $conexion = mysqli_connect($base, $usuario, $contrasena, $base_de_datos);
    
        if (!$conexion) {
            die("Error en la conexión a la base de datos: " . mysqli_connect_error());
        }
    
        $consulta = "SELECT * FROM usuarios";
        $resultado = mysqli_query($conexion, $consulta);
    
        if (mysqli_num_rows($resultado) > 0) {
            echo "<table border=1 ><tr><th>ID</th><th>Nombre</th><th>Email</th></tr>";
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr><td>" . $fila["ID_Users"] . "</td><td>" . $fila["Usuario"] . "</td><td>" . $fila["Email"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron registros.";
        }
    }
    ?>
