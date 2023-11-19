<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="icon" type="image/x-icon" href="Images/Logo.png">
    <title>Login</title>

    <style>
        body{
            text-align: center;
            background-color: #fcffdb98;
        }
        .form{
            width: 60%;
            margin: 0 auto;
            border-radius: 10px;
            padding: 10px;
            background-color: rgba(128, 128, 128, 0.26);
        }
    </style>
</head>


<body>
    <header>
        <nav class="navbar bg-body-tertiary border-body" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><h3>Login</h3></a>
            </div>
        </nav>
    </header>

    <section>
        <br>
        <h3>Carlos Adrián Márquez Carrillo</h3>
        <br>

        <div class="form">
            <form class="needs-validation" novalidate method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="validationTooltip01" required name="username">
                            <label for="floatingInputGrid">Usuario: </label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="validationTooltip02" required name="password">
                            <label for="floatingInputGrid">Contraseña: </label>
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-success" name="submit">Enviar</button>
            </form>

            <?php
                if($_SERVER["REQUEST_METHOD"] == 'POST'){
                    $username = $_POST["username"];
                    $password = $_POST["password"]; 

                    // -----------------------------------------------
                    $archivo = 'usuarios.txt';
                    $lectura = fopen($archivo, 'r');
                    if ($lectura === false) {
                        die('No se pudo abrir el archivo.');
                    }
                    $usuarios = array_fill(0, 100, null);
                    while(!feof($lectura)){
                        $palabra = fscanf($lectura, "%s%s");
                        $usuarios[$palabra[0]] = $palabra[1];
                    }
                    fclose($lectura);
                    // -----------------------------------------------

                    $bandera=false;
                    
                    foreach($usuarios as $usuario => $contra){
                        if($username == $usuario && $password == $contra && !$bandera){
                            echo '<br><div style="width:20%;margin-left:50px;margin:0 auto;" class="alert alert-success" role="alert"> <h4 class="alert-heading">Bienvenido!</h4></div>';
                            $bandera=true;
                            break;
                        }else{
                            if($username == $usuario && $password != $contra){
                                echo '<br><div style="width:40%;margin-left:50px;margin:0 auto;" class="alert alert-warning" role="alert"> <h4 class="alert-heading">Usuario correcto, contraseña incorrecta!</h4></div>';
                                $bandera=true;
                            }else if($username != $usuario && $password == $contra){
                                echo '<br><div style="width:40%;margin-left:50px;margin:0 auto;" class="alert alert-warning" role="alert"> <h4 class="alert-heading">Usuario incorrecto, contraseña correcta!</h4></div>';
                                $bandera=true;
                            }
                        }
                    }

                    if(!$bandera){
                        echo '<br><div style="width:40%;margin-left:50px;margin:0 auto;" class="alert alert-danger" role="alert"><h4 class="alert-heading">Ambos datos incorrectos!</h4></div>';
                    }

                    echo "<br>";
                    date_default_timezone_set("America/Mexico_City");
                    $fecha_actualizacion = filemtime($archivo);
                    $fecha_actualizacion = date("d-m-Y H:i:s", $fecha_actualizacion);
                    echo "Ultima actualizacion del archivo '$archivo': $fecha_actualizacion";
                }
            
            ?>
        </div>
    </section>
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
