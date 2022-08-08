<?php
include('gorsel_donusturucu.php');
if($_POST){	
	$donusturulecek_tip = $_POST['donusturulecek_tip'];
	$hedefDosya=$_POST['klasor'];
	$gorselAdi=$_POST['gorselAdi'];
	$obj = new Gorsel_Donusturucu();	
	$obj->convert_image($donusturulecek_tip, '../'.$hedefDosya, $gorselAdi);		
}	

$turler = array(
	'png' => 'PNG',
	'jpg' => 'JPG',
	'webp' => 'WEBP',
);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Görsel Dönüştürücü</title>
    <link rel="stylesheet" href="../css/main.css">
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
            <?php 
                    include ("baglanti.php");
                    $klasor = urldecode($_GET['klasor']);                   
                    $sorgu=$conn->query("SELECT * FROM gorsel_bilgileri where gorsel_bilgileri.klasor="."'".$klasor."'");        
                    echo("<script>console.log('PHP:xxxxxxxxxxx "."SELECT * FROM gorsel_bilgileri where klasor="."'".$klasor."'"." ');</script>");            
                    if(mysqli_num_rows($sorgu)) {?>

            <div class="row p-2">
                <?php while($kayit=mysqli_fetch_array($sorgu)){?>
                <div class="col-4 p-3 ">

                    <div class="row p-3 bg-white rounded">

                        <div class="col-12 p-3  ">
                            <img src="../<?=$kayit["gorselKonumu"];?>" width="200" height="200" />
                        </div>

                        <form method="post" action="">
                            <select class="col-12 p-1 m-1" name="gorselAdi">
                                <option value="<?=$kayit["gorselAdi"];?>"><?=$kayit["gorselAdi"];?></option>
                            </select>

                            <select class="col-12 p-1 m-1" name="klasor">
                                <option value="<?=$kayit["klasor"];?>"><?=$kayit["klasor"];?></option>
                            </select>

                            <select class="col-12 p-1 m-1" name="donusturulecek_tip">
                                <?php foreach($turler as $key=>$type) {?>
                                <?php $mevcutTip=explode(".",$kayit["gorselAdi"])  ?>
                                <?php if($key != $mevcutTip[1]){?>
                                <option value="<?=$key;?>"><?=$type;?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>

                            <input class="btn btn-primary p-1 m-1 col-12" type="submit" value="Dönüştür" />
                        </form>


                    </div>




                </div>

                <?php } ?>

            </div>


            <?php } ?>











        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</body>

</html>