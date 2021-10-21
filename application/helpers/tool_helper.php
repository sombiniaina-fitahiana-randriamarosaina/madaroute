<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  function asset_url($path) {
    return site_url("assets/$path");
  }

  function admin_url($path = "") {
    return site_url("bo-admin/$path");
  }

  function format_decimal($number) {
    return number_format($number, 2, ",", " ");
  }

  function format_int($number) {
    return number_format($number, 0, ",", " ");
  }

  function get_date($timestamp) {
    return explode(" ", $timestamp)[0];
  }

  function get_time($timestamp) {
    return explode(" ", $timestamp)[1];
  }

?>
