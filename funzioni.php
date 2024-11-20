<?php
namespace Classi;

/**
 * Questa pagina contieni tutti i metodi
 * @author Francesco brugali
 * @copyright 2024
 * @license LGPL
 * @version 1.0.0
 */

 class Funzioni
 {
    /**
     * Funzione per leggere del testo in un file
     * 
     * @param string $file Nome del file
     * @return boolean|string
     * 
     */
    public static function leggiTesto($file)
    {
        $rit = false;
        if (!$fp = fopen($file, 'r')) {
            echo "Non posso aprire il file $file<br>";
        } else {
            if (is_readable($file) === false) {
                echo "Il file $file non è leggibile<br>";
            } else {
                $rit = fread($fp, filesize($file));
            }
        }
        fclose($fp);
        return $rit;
    }


    /**
     * 
     * Funzione per estrarre dal $_POST o dal $_GET la proprietà richiesta
     * 
     * @param string Proprietà da ricercare
     * @return string|null
     * 
     */
    public static function richiestaHTTP($str)
    {
        $rit = null;
        if ($str !== null) {
            if (isset($_POST[$str])) {
                $rit = $_POST[$str];
            } elseif (isset($_GET[$str])) {
                $rit = $_GET[$str];
            }
        }
        return $rit;
    }


     /**
     * Funzione per scrivere del testo in un file
     * 
     * @param string $file Nome del file
     * @param string $stringa Testo da inserire
     * @param boolean $commenta Scrive a video se l'operazione è andata a buon fine
     * @return boolean
     * 
     */
    public static function scriviTesto($file, $stringa, $commenta = false)
    {
        $rit = false;
        if (!$fp = fopen($file, 'a')) {
            echo "Non posso aprire il file $file<br>";
        } else {
            if (is_writable($file) === false) {
                echo "Il file $file non è scrivibile<br>";
            } else {
                if (!fwrite($fp, $stringa)) {
                    echo "Non posso scrivere il file $file<br>";
                } else {
                    if ($commenta) echo "Operazione completata!<br> Ho scritto:<br>" . str_repeat("-", 20) . "<br>" . str_replace(chr(10), "<br>", $stringa) . "<br>" . str_repeat("-", 20) . "<br>Nel file $file<br>";
                    $rit = true;
                }
            }
        }
        fclose($fp);
        return $rit;
    }
 }
?>