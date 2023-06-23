<?php


# code...
if (isset($_GET['dir'])) {

    $dir = $_GET['dir'];

    try {
        $file = "..\\file\\" . $dir;
        $directorio = "file/" . $dir;;
        $js_code = '';
        $files = scandir($file); //obtenemos todos los nombres de los ficheros
        foreach ($files as $archivo) {
            if ('.' !== $archivo && '..' !== $archivo) {
                $fileB = "..\\file\\" . $dir . '\\' . $archivo;
                var_dump($archivo);

                if (is_file($fileB)){

                    unlink($fileB); //elimino el fichero
                }


            }
        }

        rmdir($file);
        header('Location: ../index.php');

    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n\n";
    }
} else {
    header('Location: ../index.php');
}
