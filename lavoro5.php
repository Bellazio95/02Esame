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

if (isset($dati['lavoroBackEnd'][0])) {
    $lavoroBackEnd = $dati['lavoroBackEnd'][0];
} else {
    echo "Errore: dati lavoroBackEnd non trovati";
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
    
    <title><?php echo $lavoroBackEnd['title5']?></title>
</head>
<body>
    <?php
    include 'parti-comuni/header.php'
   ?>


    <div id="lavoro">
        <div class="titoloSezione">
            <h1>
            <?php echo $lavoroBackEnd['title5']?> 
            </h1>
        </div>
        <div id="foto">
            <div id="img">
                <img src="<?php echo $lavoroBackEnd['img5']?> " alt="">
            </div>
            <div id="richieste">
                <h2><?php echo $lavoroBackEnd['titoloInfo']?> </h2>
                <ul>
                <?php 
                if (isset($lavoroBackEnd['lista'])){
                    foreach ($lavoroBackEnd['lista'] as $lista){
                        echo '<li>' . $lista . '</li>';
                    }
                     }
                ?> 
                </ul>
            </div>
        </div>

        <div id="container">
           
            <div id="metodo">
                <h3><?php echo $lavoroBackEnd['titoloDescrizione']?></h3>
                <p><?php echo $lavoroBackEnd['testoDescrizione']?></p>

                <h3><?php echo $lavoroBackEnd['titoloStrategia']?></h3>
                <p> <?php echo $lavoroBackEnd['testoStrategia']?></p>

                <h3><?php echo $lavoroBackEnd['titoloSfida']?></h3>
                <p> <?php echo $lavoroBackEnd['testoSfida']?> 
                </p>

                <ul>
                <?php 
                    if(isset($lavoroBackEnd['listaSfida'])){
                        foreach ($lavoroBackEnd['listaSfida'] as $listaSfida){
                            echo "<li>" . $listaSfida . "</li>";
                        }
                    }
                ?>
                </ul>

                <h3><?php echo $lavoroBackEnd['titoloSoluzione']?></h3>
                <p> <?php echo $lavoroBackEnd['testoSoluzione']?></p>

                <h3><?php echo $lavoroBackEnd['titoloRisultato']?></h3>
                <p><?php echo $lavoroBackEnd['testoRisultato']?></p>
            </div>
            <div id="sito">
                <h2><?php echo $lavoroBackEnd['titoloSito']?></h2>
                <p><?php echo $lavoroBackEnd['testoSito']?> <a href="" title="Sito Rossi"><?php echo $lavoroBackEnd['nomeSito']?></a></p>
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