<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  function export_excel($objets, $name) {

    $filename = 'Export excel ' . $name . '.xls';

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");

    $isPrintHeader = false;
    foreach($objets as $objet) {
      $objetArray = (array) $objet;
      if(!$isPrintHeader) {
        echo implode("\t", array_keys($objetArray)) . "\n";
        $isPrintHeader = true;
      }
      echo implode("\t", array_values($objetArray)) . "\n";
    }
    exit();
  }

?>
