<?php


if(isset($_GET['note']) && isset($_GET['dir'])){

    $dir = $_GET['dir'];
    $note = $_GET['note'];

    try{
        $file = "..\\file\\" . $dir . '\\' . $note;

        if(unlink($file)){
            header('Location: ../directorio.php?dir=' . $dir);

        } else{
            header('Location: ../index.php');

        }

    }catch (Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n\n";
    }



} else{
    header('Location: ../directorio.php?dir=' . $dir);

}

?>