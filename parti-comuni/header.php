<?php
ini_set("auto_detect_line_endings", true); // Per il fine linea su MAC 

require_once __DIR__ . '/../funzioni.php';

//uso dal file utility la classe Funzioni
use Classi\Funzioni as FU;

//Richiamo il file json da leggere
$file = __DIR__."/nav.json";
$arr = json_decode(FU::leggiTesto($file));

//Richiamo la funzione di richiesta GET/POST
$selezionato = FU::richiestaHTTP("selezionato");
$selezionato = ($selezionato == null) ? 1 : $selezionato; 

?>


<header>

    <nav>
        <div id="logo">
            <a href="index.php" title="home"><img src="IMG/BF5.svg" alt=""></a>
        </div>
            
        <div id="menù">
            <input type="checkbox" id="controllo">
            <label for="controllo" class="label-controllo">
                <span></span>
            </label>
            <ul>
                <?php
                foreach ($arr as $link) {
                    $n = $link->id;
                    $classeSelezionato = ($n == $selezionato) ? ' class="selezionato"' : '';
                    
                    printf('<a href="%s?selezionato=%u" title="%s" ><li %s>%s</li></a>',   $link->url, $link->id, $link->title, $classeSelezionato, $link->nome);
                }
                ?>
            </ul>
        </div>
    </nav>

    </header>
