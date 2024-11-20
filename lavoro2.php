<?php
ini_set("auto_detect_line_endings", true); // Per il fine linea su MAC 
//importo il file utility.php per usare le varie funzioni
require_once  'funzioni.php';

//uso dal file utility la classe Funzioni
use Classi\Funzioni as FU;

//imposto la variabile 'inviato' come lettura delle richieste HTTP
$inviato = FU::richiestaHTTP("inviato");
$inviato = ($inviato == null || $inviato !=1) ? false : true;

$jsonDati = file_get_contents('dati.json');
$dati = json_decode($jsonDati, true);

if (isset($dati['lavoroUx'][0])) {
    $lavoroUx = $dati['lavoroUx'][0];
} else {
    echo "Errore: dati lavoroUx non trovati";
    exit;
}


?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="esame" content="il mio sito web">
    <link rel="stylesheet" href="../EsameSecondaSessione/css/styleWeb.min.css">
    
    <title><?php echo $lavoroUx['title2']?></title>
</head>
<body>
    <?php
    include 'parti-comuni/header.php'
   ?>


    <div id="lavoro">
        <div class="titoloSezione">
            <h1>
            <?php echo $lavoroUx['title2']?> 
            </h1>
        </div>
        <div id="foto">
            <div id="img">
                <img src="<?php echo $lavoroUx['img2']?> " alt="">
            </div>
            <div id="richieste">
                <h2><?php echo $lavoroUx['titoloInfo']?> </h2>
                <ul>
                <?php 
                if (isset($lavoroUx['lista'])){
                    foreach ($lavoroUx['lista'] as $lista){
                        echo '<li>' . $lista . '</li>';
                    }
                     }
                ?> 
                </ul>
            </div>
        </div>

        <div id="container">
           
            <div id="metodo">
                <h3><?php echo $lavoroUx['titoloDescrizione']?></h3>
                <p><?php echo $lavoroUx['testoDescrizione']?></p>

                <h3><?php echo $lavoroUx['titoloStrategia']?></h3>
                <p> <?php echo $lavoroUx['testoStrategia']?></p>

                <h3><?php echo $lavoroUx['titoloSfida']?></h3>
                <p> <?php echo $lavoroUx['testoSfida']?> 
                </p>

                <ul>
                <?php 
                    if(isset($lavoroUx['listaSfida'])){
                        foreach ($lavoroUx['listaSfida'] as $listaSfida){
                            echo "<li>" . $listaSfida . "</li>";
                        }
                    }
                ?>
                </ul>

                <h3><?php echo $lavoroUx['titoloSoluzione']?></h3>
                <p> <?php echo $lavoroUx['testoSoluzione']?></p>

                <h3><?php echo $lavoroUx['titoloRisultato']?></h3>
                <p><?php echo $lavoroUx['testoRisultato']?></p>
            </div>
            <div id="sito">
                <h2><?php echo $lavoroUx['titoloSito']?></h2>
                <p><?php echo $lavoroUx['testoSito']?> <a href="" title="Sito Rossi"><?php echo $lavoroUx['nomeSito']?></a></p>
            </div>
        </div>
</div>

    <footer>
   <?php
   include ('parti-comuni/footer.php');
   ?>
   </footer>

</body>
</html>