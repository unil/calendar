<?php

class ErrorHandler {

    function __construct() {
        
    }

    /* public static function Error($e) {
      $stderr = fopen($_SESSION['APPLICATION_PATH']. "log/error/" . date('ymd') . ".log", 'a');
      fwrite($stderr,"---- " . date('d/m/Y H:i:s') . "\n" . $e->getMessage() . "\n");
      fclose($stderr);

      echo "<br>///////////DEBUT DU MESSAGE D'ERREUR///////////<br><br>" .
      "<br><b>Une erreur est survenue sur cette page.</b><br>" .
      "Si ce problème persiste, veuillez s.v.p. en informer l'administrateur de ce site (stefan.r.meier@unil.ch | 021 692 54 19) en fournissant les détails de l'incident suivants:<br><br>" .
      "- date et heure exacte de l'incident (" . date('d/m/Y H:i:s') . ")<br>".
      "- description exacte de ce que vous avez fait<br><br>" .
      "Afin d'assurer une amélioration constante de ce site, merci d'avance de votre collaboration.<br><br><br>" .
      "///////////FIN DU MESSAGE D'ERREUR///////////<br><br>";
      } */

    public static function Error($e) {
        echo "<br /><font color=red>" . $e->getMessage() . "</font><br />";
    }

}

?>