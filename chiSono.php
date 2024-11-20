<?php
ini_set("auto_detect_line_endings", true); // Per il fine linea su MAC 
//importo il file utility.php per usare le varie funzioni
require_once('funzioni.php');

//uso dal file utility la classe Funzioni
use Classi\Funzioni as FU;

//imposto la variabile 'inviato' come lettura delle richieste HTTP
$inviato = FU::richiestaHTTP("inviato");
$inviato = ($inviato == null || $inviato !=1) ? false : true;


//Richiamo il file json che mi serve
$jsonDati = file_get_contents('dati.json');
$dati = json_decode($jsonDati, true);

//Prendo i dati da un array specifico
if(isset($dati['chiSono'][0])){
    $chiSono = $dati['chiSono'][0];
}else {
    echo "Errore: dati chiSono non trovati";
    exit;
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../EsameSecondaSessione/css/styleWeb.min.css">
    <title> <?php echo $chiSono["title"] ?></title>
</head>
<!--importo file header.php che contiene l'header-->
<?php
    require_once 'parti-comuni/header.php'
   ?>
<body>
    <main>
        <div id="blocco" >
            
            <div class="titoloSezione">
                <h1>
                    <?php echo $chiSono["titoloP"] ?>
                </h1>
            </div>

            <?php
                //controllo se il file json esiste
                if(isset($chiSono['capitoli'])){
                    //creo una lista con un ciclo foreach prendendo i dati dal file json
                    foreach($chiSono['capitoli'] as $capitolo){
                        echo '<div  class="box">';
                            echo '<h2>' .$capitolo['titolo'] . '</h2>';
                           echo '<p>' . $capitolo['testo'] . '</p>';
                        echo '</div>';
                    }
                }
            ?>
            
        </div>
    </main>

    <footer>
        <!--importo file footer.php che contiene il footer-->
   <?php
   require_once 'parti-comuni/footer.php'
   ?>
   </footer>
</html>