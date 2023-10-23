<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuarios</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Pixelify+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Ventana.css">
    <style>
        body {
            background-color: seashell;
            font-family: 'Bebas Neue', sans-serif;
            font-family: 'Pixelify Sans', sans-serif;
        }

        .Formulario {
            position: relative;
            width: 300px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 2;

        }

        h2 {
            text-align: center;
            color: mediumpurple;

        }

        label {
            display: block;
            margin-bottom: 5px;
            color: maroon;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="radio"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            outline: none;
            border-color: #007bff;
        }

        input[type="radio"] {

            margin-top: 5px;
            width: 10%;

        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: violet;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            font-family: 'Bebas Neue', sans-serif;
            font-family: 'Pixelify Sans', sans-serif;
        }

        input[type="submit"]:hover {
            background-color: skyblue;
        }

        .cuadro {
            color: red;
            border: 5px solid skyblue;

        }

        legend {
            color: #0056b3;
        }

    </style>
</head>

<body>
    <div class="Ventana-container">
        <div class="transicion posicion"></div>
    </div>
    <form method="post" class="Formulario">
        <h2>SafeLonck</h2>
        <label for="name">Ingrese su nombre:</label>
        <input type="text" name="name" placeholder="Nick">
        <label for="email">Ingrese su correo:</label>
        <input type="email" name="email" placeholder="nick@direccion.com">
        <fieldset class="cuadro">
            <legend>Selecciona una opción:</legend>
            <label>
                <input type="radio" name="opcion" value="Xiaomi"> Xiaomi
            </label>
            <br>
            <label>
                <input type="radio" name="opcion" value="Iphone"> iPhone
            </label>
            <br>
            <label>
                <input type="radio" name="opcion" value="Motorola"> Motorola
            </label>
        </fieldset>
        <label for="IMEI"><br>Ingrese el IMEI:</label>
        <input type="text" name="IMEI" placeholder="123456789987456">
        <input type="submit" name="Insertar" class="boton-diferente" value="Insertar" >
        <input type="submit" name="Eliminar" value="Eliminar">
        <input type="submit" name="Actualizar" value="Actualizar">
        <input type="submit" name="Mostrar" value="Mostrar">
        <input type="submit" name="Notificar" value="Notificar">
    </form>
    <?php
    include "Registro.php";
    include "Notificar.php";
    ?>
    
</body>

</html>