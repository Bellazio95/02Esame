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
if (isset($dati['servizi'][0])) {
    $servizi = $dati['servizi'][0];
} else {
    echo "Errore: dati servizi non trovati";
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
   
    <title><?php echo $servizi['title']?></title>
</head>
<body>
    <!--importo file header.php che contiene l'header-->
    <?php
    require_once 'parti-comuni/header.php'
    ?>

    <div id="servizi">
        <div class="titoloSezione">
            <h1>
              <?php echo $servizi['titoloP']?>
            </h1>
        </div>

        <div id="mieiLavori">
        <a href="<?php echo $servizi['linkLav']?>"><button type="submit"> <?php echo $servizi['buttonLink']?></button></a>
        </div>
        <?php
            //controllo se il file json esiste
            if (isset($servizi['container'])) {

                //creo una lista con un ciclo foreach prendendo i dati dal file json
                foreach ($servizi['container'] as $servizio) {
                    echo '<div class="container">';
                        echo '<div class="img">';
                            echo '<div class="logo">';
                                echo '<img src="' . $servizio['img'] . '" alt="">';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="p">';
                            echo '<h2>' . $servizio['titolo'] . '</h2>';
                            echo '<p>' . $servizio['testo'] . '</p>';
                        echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "Nessun servizio disponibile.";
                }
        ?>
        <div id="mieiLavori">
        <a href="<?php echo $servizi['linkLav']?>"><button type="submit"> <?php echo $servizi['buttonLink']?></button></a>
        </div>
    </div> 

    <footer>
        <!--importo file footer.php che contiene il footer-->
   <?php
   require_once 'parti-comuni/footer.php'
   ?>
   </footer>


</body>
</html>