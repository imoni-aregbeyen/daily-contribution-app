<?php
require 'conn.php';
$names = $values = $names_values = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  foreach ($_POST as $name => $value) {
    if (!in_array($name, $keywords)) {
      $value = $conn->real_escape_string($value);
      $names_values[] = "$name='$value'";
    }
  }
  if (count($dis) > 0) {
    foreach ($dis as $ds) {
      $dis_str[] = "$ds='".test_input($_POST[$ds])."'";
    }
    $dis_str = implode(' AND ', $dis_str);
    $sql = "SELECT * FROM $tbl WHERE $dis_str AND id <> $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $_SESSION['alerts'][] = "$ds already exists";
      header("Location: {$_SERVER['HTTP_REFERER']}");
      exit;
    }
  }
}

$sql = "UPDATE $tbl SET " . implode(', ', $names_values) . " WHERE id=$id";
if ($conn->query($sql) === TRUE) {
  if ($msg !== '')
    $_SESSION['alerts'][] = $msg;
  if ($ssn) {
    $sql = "SELECT * FROM $tbl WHERE id=$id";
    $rs = $conn->query($sql);
    if ($rs && $rs->num_rows > 0) {
      while ($row = $rs->fetch_assoc()) {
        $_SESSION[$ssn] = $row;
      }
    }
  }
  if ($msg !== '')
    $_SESSION['alerts'][] = $msg;
} else {
  $_SESSION['alerts'][] = "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
if ($pg === '') {
  header('location: ' . $_SERVER['HTTP_REFERER']);
} else {
  header("Location: ../?page=$pg");
}
exit;