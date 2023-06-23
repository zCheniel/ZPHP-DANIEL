<?php

$error = '';


if (isset($_POST['crear']) &&  isset($_POST['nombre'])) {


    $nombre = $_POST['nombre'];
    $dirname = "file/$nombre";

    try {

        if (!(is_dir($dirname))) {

            mkdir($dirname);
            $error = 'Directorio creado';
        } else {
            $error = '';
        }
    } catch (Exception $e) {
        echo 'Error: ',  $e->getMessage(), "\n\n";
    }
}



unset($_POST['crear']);
unset($_POST['nombre']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Rubik+Glitch&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Puddles&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Bloc de notas</title>
</head>

<body>


<div class="row">

    <h1 class="text-center mt-5">BLOC DE NOTAS</h1>
</div>
<hr>

    <div class="m-3">
        <form action="index.php" method="post">
            <input type="text" name="nombre" class="col-3 p-2" placeholder="Nombre del directorio nuevo...">
            <button type="submit" class="btn-success p-2 rounded" name="crear" value="crear">Crear directorio</button>
        </form>
        
    </div>

    <div class="row row-cols-4 mx-auto">




    <?php
    try {

        $dir = 'file';
        $dirs  = scandir($dir);



        foreach ($dirs as $direc) {
            if ('.' !== $direc && '..' !== $direc) {

    ?>



                <div class="col">
                    <div class="card m-4" id="tarjeta" >
                        <div class="card-body">
                            <h5 class=" fw-bold"> <b><?php echo  $direc ?>  </b> </h5>
                            
                            <span class="text-muted">Ultima Modificacion: <?php date_default_timezone_set('America/Caracas'); echo date("d-m-Y H:i:s", filemtime($dir)); ?></span>
                                <div class="my-4">
                                    <a href="directorio.php?dir=<?php echo $direc ?>" class="btn-success p-3 px-5 rounded">Ver</a>
                                    <a href="procesos/delete.php?dir=<?php echo $direc ?>" class="btn-danger p-3 rounded">Eliminar</a>
                                </div>
                        </div>
                    </div>
                </div>

    <?php
            }
        }
    } catch (Exception $e) {
        echo 'Se ha encontrado un error: ',  $e->getMessage(), "\n\n";
    }
    ?>
    </div>

</body>

</html>