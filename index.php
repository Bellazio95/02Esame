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
if(isset($dati['home'][0])){
    $home = $dati['home'][0];
}else {
    echo "Errore: dati home non trovati";
    exit;
}


?>


<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="esame" content="Il mio sito web">
        <link rel="stylesheet" href="../EsameSecondaSessione/css/styleWeb.min.css">

        <title><?php echo $title = isset($home['title']) ? $home['title'] : 'Titolo non trovato'?></title>
    </head>
    <body>
        <header> 
            <!--importo file header.php che contiene l'header-->
            <?php
                require_once 'parti-comuni/header.php'
            ?>
        </header>

        <div id="home">
            <div id="copertina">
                <div id="foto-profilo">
                    <img src="<?php echo $home ['copertina']?>" alt=""> 
                </div>
                <div id="intro">
                    <div><h1><?php echo $home ['titoloCopertina']?></h1>
                    <p><?php echo $home ['testoCopertina']?> </p>
                    </div>
                    <div id="foto-profilo-smart">
                        <img src="<?php echo $home ['copertinaSmart']?>" alt="">
                    </div> 
                </div>
            </div>

            <div class="testo">
                <h2><?php echo $home ["titoloTesto"]?></h2>
                <p><?php echo $home ["contenutoTesto"]?></p>
                <ul>
                    <!--creo una lista con un ciclo foreach prendendo i dati dal file json-->
                    <?php
                        if (isset($home['competenza']) && is_array($home['competenza'])) {
                            foreach ($home['competenza'] as $competenza) {
                                echo "<li>" . htmlspecialchars($competenza, ENT_QUOTES, 'UTF-8') . "</li>";
                            }
                        } else {
                            echo "<li>Nessuna competenza disponibile</li>";
                        }
                    ?>
                </ul>
                </div> 
                    <div class="immagini"><img src="<?php echo $home ["immagine"]?>" alt="">
                </div> 

                <div id="info">
                    <a href="<?php echo $home ["linkInfo"]?>"><button type="submit"> <?php echo $home ["testoLink"]?></button></a>
                </div>
            </div>

            
        
        </div>
    </body>

   
   <footer>
    <!--importo file footer.php che contiene il footer-->
   <?php
   require_once 'parti-comuni/footer.php'
   ?>
   </footer>
   
    
    </body>
</html>