<?php

if (isset($_GET['dir']) && isset($_GET['note'])) {
    $dir = $_GET['dir'];
    $note = $_GET['note'];
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Rubik+Glitch&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Puddles&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false">
        </script>
    <title><?php echo $note ?></title>
</head>

<body>
<nav class="navbar navbar-dark bg-dark">
<div class="container">
    <a class="navbar-brand" href="directorio.php?dir=<?php echo $dir ?>">Volver a /<?php echo $dir ?></a>
  </div>
</nav>

    <?php

    try {

        $file = "file\\" . $dir . '\\' . $note;
        $size = filesize($file);
        if ($size > 0) {
            $contents = file_get_contents($file, FILE_USE_INCLUDE_PATH);
        } else {
            $contents = '';
        }
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n\n";
        $contents = "";
    }
    ?>
    <textarea disabled name="valor-nota" style="height: 500px;" class="valor-nota w-75 d-block mx-auto" id="" cols="30" rows="10"><?php echo $contents; ?></textarea>
</body>

</html>