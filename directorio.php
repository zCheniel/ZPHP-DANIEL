<?php

if (isset($_GET['dir'])) {
    $dir = $_GET['dir'];
    $error = "";

    if (isset($_POST['crear-nota'])) {
   
            if (isset($_POST['nombre-nota']) && isset($_POST['valor-nota']) && isset($_POST['dir'])) {
                $name = $_POST['nombre-nota'];
                $dir = $_POST['dir'];
                $content = $_POST['valor-nota'];
                $direct = "file/$dir/$name.html";
                $error = '';
                try {

                    if (file_exists($direct)) {
                        $error = "Ya existe un archivo con el nombre nombre <b>$name</b>";
                    } else {
                        $archivo = fopen($direct, 'a');
                        fputs($archivo, $content);
                        fclose($archivo);

                        header('Location: directorio.php?dir=' . $dir);
                    }
                } catch (Exception $e) {
                    echo 'Excepción capturada: ',  $e->getMessage(), "\n\n";
                }
            }
        
    }

    unset($_POST['crear-nota']);
    unset($_POST['nombre']);
} else {
    header("Location: index.php");
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title><?php echo $dir ?></title>
</head>

<body>
<nav class="navbar ">
<div class="container mt-3">
    <a class="navbar-brand" href="index.php">< Inicio</a>
  </div>
</nav>


    <div class="container">
        <hr>
        <p class="m-3"><b><a class="text-muted" href="index.php">Directorio/</a>  <?php echo $dir ?></a></b></p>
        <hr>
        <p>
            <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Crear archivo nuevo
            </button>
        </p>
        <div class="collapse" id="collapseExample">
            <form action="directorio.php?dir=<?php echo $dir ?>" method="post">
                <p><input type="text" name="nombre-nota" placeholder="Nombre..." styles="padding: 2px 4px 2px 4px"> .txt</p>
                <textarea name="valor-nota" class="valor-nota-1" id="" cols="30" placeholder="Contenido..." rows="10"></textarea>
                <br>

                <input type="hidden" name="dir" value="<?php echo $dir ?>">
                <button type="submit" name="crear-nota" value="create" class="btn-success px-5  rounded">Crear</button>
                
            </form>

        </div>

        <p><?php echo $error ?></p>

        <div class="row">



            <?php

            $directorio = "file/" . $dir;
            $direc  = scandir($directorio);

            if (count($direc) > 2) {
                foreach ($direc as $valor) {
                    if ('.' !== $valor && '..' !== $valor) {

                        $file = "file\\" . $dir . '\\' . $valor;

                        if (filesize($file) > 0) {
                            $contents = file_get_contents($file, FILE_USE_INCLUDE_PATH);
                        }else {
                            $contents = 'No hay contenido aun';
                        }

            ?>

                            <div class="col">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo rtrim($valor, '(.html)') ?></h5>
                                        <hr>
                                        <p>Ultima Modificacion:</p>
                                        <p class="text-muted"><?php date_default_timezone_set('America/Caracas'); echo date("d-m-Y H:i:s", filemtime($file)); ?></p>
                                        <p>Tamaño:</p>
                                        <h6 class="card-subtitle mb-2 text-muted"><?php echo filesize($file) ?> Caracteres</h6>
                                        <p>Contenido:</p>
                                        <p class="text-muted"><i><?php echo substr($contents, 0, 20); ?>...</i></p>
                                    
                                        
                                        <hr>
                                        <div >
                                        <a  href="archivo.php?note=<?php echo $valor ?>&dir=<?php echo $dir ?>" class="btn-success p-2 px-5 rounded m-2">Ver </a>
                                        <a  href="procesos/deletefile.php?note=<?php echo $valor ?>&dir=<?php echo $dir ?>" class="btn-danger p-2 rounded m-2 ">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
            <?php

                        
                    }
                }
            }

            ?>

        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>