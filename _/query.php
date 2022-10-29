<?php
require 'conn.php';

foreach ($_POST as $x => $y) {
  if (!in_array($x, $key_var)) {
    $col_val[] = "$x=$y";
  }
}

if ($pg === '') {
  header('location: ' . $_SERVER['HTTP_REFERER'] . '&' . implode('&', $col_val));
} else {
  header("Location: ../?page=$pg" . '&' . implode('&', $col_val));
}
exit;