<?php
require 'conn.php';

foreach($_POST as $x => $y) {
  if (!in_array($x, $keywords) && $x != 'password') {
    $col_val[] = "$x='$y'";
  } elseif ($x == 'password') {
    $password = $y;
  }
}

$sql = "SELECT * FROM $tbl WHERE " . implode(' && ', $col_val);

$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
      $_SESSION[$dbname]['in'] = true;
      if ($ssn) $_SESSION[$ssn] = $row;
      break;
    }
    unset($_SESSION[$db]['in']);
    $_SESSION['alerts'][] = "Incorrect login details";
  }
} else {
  unset($_SESSION[$db]['in']);
  $_SESSION['alerts'][] = "Incorrect login details";
}

$conn->close();

if ($pg === '') {
  header('location: ' . $_SERVER['HTTP_REFERER']);
} else {
  header("Location: ../?page=$pg");
}
exit;