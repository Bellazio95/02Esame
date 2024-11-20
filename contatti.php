<?php
ini_set("auto_detect_line_endings", true); // Per il fine linea su MAC 
require_once('funzioni.php');

use Classi\Funzioni as FU;

//Richiamo le funzioni di richiesta GET/POST
$inviato = FU::richiestaHTTP("inviato");
$inviato = ($inviato == null || $inviato !=1) ? false : true;

$selezionato = FU::richiestaHTTP("selezionato");
$selezionato = ($selezionato == null) ? 1 : $selezionato;

//Richiamo il file json che mi serve
$datijson = FU::leggiTesto("dati.json");
$dati = json_decode($datijson,true);

//Prendo i dati da un array specifico
if(isset($dati["contatto"][0])){
    $contatti = $dati["contatto"][0];
}else{
    echo "Errore: dati contatto non trovati";
}

//inposto le variabili vuote
$nome = "";
$cognome = "";
$telefono = "";
$email = "";
$messaggio = "";

$clsErroreNome = "";
$clsErroreCognome = "";
$clsErroreTelefono = "";
$clsErroreEmail = "";
$clsErroreMessaggio = "";

//validazione dati inseriti
if($inviato){
    $valido = 0;

    $nome = FU::richiestaHTTP('nome');
    $cognome = FU::richiestaHTTP('cognome');
    $telefono = FU::richiestaHTTP('telefono');
    $email = FU::richiestaHTTP('email');
    $messaggio = FU::richiestaHTTP('messaggio');

    $clsErrore = 'class="errore';

    if ($nome !="") {
        $clsErrore = "";
    }else{
        $valido++;
        $clsErroreNome = $clsErrore;
        $nome = "";
    }

    if ($cognome !=""){
        $clsErrore = "";
    } else{
        $valido++;
        $clsErroreCognome = $clsErrore;
        $cognome = "";
    }

    if ($telefono !=""){
        $clsErrore = "";
    }else{
        $valido++;
        $clsErroreTelefono = $clsErrore;
        $telefono = "";
    }

    if (($email !="") && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $clsErrore = "";
    }else{
        $valido++;
        $clsErroreEmail = $clsErrore;
        $email = "";
    }

    if ($messaggio !=""){
        $clsErrore = "";
    }else{
        $valido++;
        $clsErroreMessaggio = $clsErrore;
        $messaggio = "";
    }
}


?>

<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="esame" content="il mio sito web">
        <link rel="stylesheet" href="../EsameSecondaSessione/css/styleWeb.min.css">

        <title><?php echo $contatti["title"] ?></title>
    </head>
    <!--importo file header.php che contiene l'header-->
    <?php
        require_once 'parti-comuni/header.php'
    ?>
    <body>
        <div id="contatti">
            <div class="titoloSezione">
                <h1>
                <?php echo $contatti["title"] ?> 
                </h1>
            </div>


            <div id="scrivimi">
                <div id="scrivimi-testo">
                    <h2><?php echo $contatti["titoloForm"] ?></h2>
                </div>
                    
                <div id="compila">
                    <?php
                    //verifico che il file non sia stao inviato
                    if (!$inviato){
                    ?>
                    <form action="contatti.php?inviato=1" method="POST">
                        <fieldset>
                            <label for="nome" <?php echo $clsErroreNome;?>><?php echo $contatti["nome"] ?></label>
                            <input type="text"
                            placeholder="Nome" id="nome" name="nome" required>
                            <label for="cognome" <?php echo $clsErroreCognome;?> ><?php echo $contatti["cognome"] ?></label>
                            <input type="text" id="cognome" name="cognome" placeholder="Cognome" required>
                            <label  for="telefono" <?php echo $clsErroreTelefono ;?>><?php echo $contatti["telefono"] ?></label>
                            <input type="text" id="telefono" name="telefono" placeholder="Telefono" required>
                            <label for="email" <?php echo $clsErroreEmail;?> ><?php echo $contatti["email"] ?></label>
                            <input type="text" id="email" name="email" placeholder="E_Mail" required>
                            <label for="messaggio" <?php echo  $clsErroreMessaggio;?>></label>
                            <textarea  placeholder="Scrivi le tue domande" id="messaggio" name="messaggio" ></textarea>
                            <button type="submit"><?php echo $contatti["button"] ?></button>
                        </fieldset>
                    </form>
                    <?php
                    } else{
                        //funzione per scrivere i dati in un file .txt
                        $str ="Nome: %s<br>" . 
                        "Cognome: %s<br>" .
                        "Telefono: %s<br>" .
                        "E-Mail: %s<br>" .
                        "Messaggio: %s<br>";
                    $str = sprintf($str, $nome, $cognome, $telefono, $email, $messaggio);
                    echo "<h1>Grazie per averci contattato</h1>";
            
                    $str = str_replace('<br>', chr(10), $str);
            
                    $file = 'dati.txt';
            
                    $str = str_repeat("-", 30) . chr(10) . $str . chr(10) . str_repeat("-", 30) . chr(10);
                    $rit = FU::scriviTesto($file, $str);
            
                    }
                    ?>
                </div>
            </div>

        

            <div id="info">
                <div id="tel" class="dati">
                    <h2><?php echo $contatti["telefono"] ?></h2>
                    <div class="link">
                        <a href="<?php echo $contatti["numeroTel"] ?>" title="clicca per chiamare"><?php echo $contatti["numeroTel"] ?></a>
                    </div>
                </div>
                <div id="e-mail" class="dati">
                    <h2><?php echo $contatti["email"] ?></h2>
                    <div class="link">
                        <a href="<?php echo $contatti["linkEmail"] ?>" title="clicca per mandare una e-mail"><?php echo $contatti["linkEmail"] ?></a>
                    </div>
                </div>
                <div id="address" class="dati">
                    <h2><?php echo $contatti["titoloInd"] ?></h2>
                    <p><?php echo $contatti["testoInd"] ?></p>
                </div>
            </div>

            <div id="maps">   
                <p>
                    <iframe src="<?php echo $contatti["iframe"] ?>" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </p>
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