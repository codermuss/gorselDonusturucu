<?php

include 'php/gorsel_donusturucu.php';

if ($_FILES) {
    $obj = new Gorsel_Donusturucu();
    $hedef=$obj->gorsel_yukle($_FILES, 'files[]');
    header('Location: php/yukle.php?klasor='.$hedef.'');
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Görsel Dönüştürücü</title>
    <link rel="stylesheet" href="css/main.css">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>
    <div class="container text-center text-white rounded bg-dark p-3 mt-5">
        <div class="row">
            <h1>Görsel Dönüştürücü</h1>

        </div>

        <div class="row p-4 justify-content-center ">
            <div class="col-3"></div>
            <div class="col-6">
                <form class="bg-secondary rounded pt-4 pb-4" action="" method="post" enctype="multipart/form-data">
                    <input class="btn btn-dark" type="file" name="files[]" multiple="multiple" />
                    <button class="btn btn-primary" type="submit" value="UPLOAD" name="submit">Yükle</button>
                </form>
            </div>
            <div class="col-3"></div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</body>

</html>