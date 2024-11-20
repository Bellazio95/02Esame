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

if (isset($dati['lavoroFrontEnd'][0])) {
    $lavoroFrontEnd = $dati['lavoroFrontEnd'][0];
} else {
    echo "Errore: dati lavoroFrontEnd non trovati";
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
    
    <title><?php echo $lavoroFrontEnd['title3']?></title>
</head>
<body>
    <?php
    include 'parti-comuni/header.php'
   ?>


    <div id="lavoro">
        <div class="titoloSezione">
            <h1>
            <?php echo $lavoroFrontEnd['title3']?> 
            </h1>
        </div>
        <div id="foto">
            <div id="img">
                <img src="<?php echo $lavoroFrontEnd['img3']?> " alt="">
            </div>
            <div id="richieste">
                <h2><?php echo $lavoroFrontEnd['titoloInfo']?> </h2>
                <ul>
                <?php 
                if (isset($lavoroFrontEnd['lista'])){
                    foreach ($lavoroFrontEnd['lista'] as $lista){
                        echo '<li>' . $lista . '</li>';
                    }
                     }
                ?> 
                </ul>
            </div>
        </div>

        <div id="container">
           
            <div id="metodo">
                <h3><?php echo $lavoroFrontEnd['titoloDescrizione']?></h3>
                <p><?php echo $lavoroFrontEnd['testoDescrizione']?></p>

                <h3><?php echo $lavoroFrontEnd['titoloStrategia']?></h3>
                <p> <?php echo $lavoroFrontEnd['testoStrategia']?></p>

                <h3><?php echo $lavoroFrontEnd['titoloSfida']?></h3>
                <p> <?php echo $lavoroFrontEnd['testoSfida']?> 
                </p>

                <ul>
                <?php 
                    if(isset($lavoroFrontEnd['listaSfida'])){
                        foreach ($lavoroFrontEnd['listaSfida'] as $listaSfida){
                            echo "<li>" . $listaSfida . "</li>";
                        }
                    }
                ?>
                </ul>

                <h3><?php echo $lavoroFrontEnd['titoloSoluzione']?></h3>
                <p> <?php echo $lavoroFrontEnd['testoSoluzione']?></p>

                <h3><?php echo $lavoroFrontEnd['titoloRisultato']?></h3>
                <p><?php echo $lavoroFrontEnd['testoRisultato']?></p>
            </div>
            <div id="sito">
                <h2><?php echo $lavoroFrontEnd['titoloSito']?></h2>
                <p><?php echo $lavoroFrontEnd['testoSito']?> <a href="" title="Sito Rossi"><?php echo $lavoroFrontEnd['nomeSito']?></a></p>
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