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


$jsonLavori = file_get_contents('lavori.json');
$lavoriData = json_decode($jsonLavori, true);

//Prendo i dati da un array specifico
if(isset($dati["lavori"][0])){
    $lavori = $dati["lavori"][0];
}else{
    echo "Errore: dati lavori non trovati";
}

?>

<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="esame" content="il mio sito web">
        <link rel="stylesheet" href="../EsameSecondaSessione/css/styleWeb.min.css">
    
        <title><?php echo $lavori["title"]?></title>
    </head>
    <body>
        <!--importo file header.php che contiene l'header-->
        <?php
            require_once 'parti-comuni/header.php'
        ?>

        <div id="lavori">
            <div class="titoloSezione">
                <h1><?php echo $lavori["titolo"]?></h1>
                
                <?php
                
                if ($lavoriData){
                    //creo dei gruppi di div prendendo i dati dal file lavori.json
                    foreach ($lavoriData as $categoria => $lavori){
                        
                        echo "<div class='container'>";
                            echo "<h2>" . $categoria . "</h2>";
                            foreach ($lavori as $lavoro){
                                
                                echo "<div class='card'>";
                                    echo "<h3>" . $lavoro['titolo'] . "</h3>";
                                    echo "<p><a href='" . $lavoro['link'] . "'>";
                                    echo "<img src='" . $lavoro['img'] . "' alt='" . $lavoro['alt'] . "'>";
                                    echo "</a></p>";
                                echo "</div>";
                            }

                        echo "</div>";
                    }
                } else {
                    echo "Errore nel caricamento dei dati.";
                }
                ?>

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