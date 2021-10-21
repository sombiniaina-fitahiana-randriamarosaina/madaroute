<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  function export_csv($data, $name) {

    // $data[] = array('x'=> $x, 'y'=> $y, 'z'=> $z, 'a'=> $a);

    $filename = 'Export csv ' . $name . '.csv';

     header("Content-type: application/csv");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Pragma: no-cache");
    header("Expires: 0");

    $handle = fopen('php://output', 'w');

    foreach ($data as $d) {
        $data_array = (array) $d;
        fputcsv($handle, $data_array);
    }
        fclose($handle);
    exit;
  }

?>
