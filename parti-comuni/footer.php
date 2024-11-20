<?php
    ini_set("auto_detect_line_endings", true); // Per il fine linea su MAC 

    require_once __DIR__ . '/../funzioni.php';

    //uso dal file utility la classe Funzioni
   use Classi\Funzioni as FU;

   //Richiamo il file json da leggere
    $file = __DIR__."/footer.json";
    $dati = json_decode(FU::leggiTesto($file)); 
?>

<footer>
        
    <div id="recapiti">
        <address>
            <p><?php echo $dati->recapiti ?></p>
            <p>
                <?php echo $dati->titoloEmail ?><a href="<?php echo $dati-> email?>" title="clicca per mandare una e-mail" ><?php echo $dati->email ?></a>
            </p>
            <p><?php echo $dati->titoloTel ?>  <a href="<?php echo $dati->numeroTel ?>" title="clicca per chiamare"><?php echo $dati->numeroTel ?></a></p>
            <p><?php echo $dati->titoloInd ?></p>
            <p><?php echo $dati->indirizzo ?></p>
        </address> 
        <p><?php echo $dati->copyR ?></p>
        <p><?php echo $dati->pIva ?></p>
        <div>
            <p>
                <a href="#" title="Termini e condizioni" ><?php echo $dati->termini ?></a>
                <br>
                <a href="#" title="Privacy"><?php echo $dati->privacy ?></a>
            </p>
        </div>
    </div>
    
</footer>