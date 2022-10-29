<?php
require 'conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && $id > 0) {
  $sql = "DELETE FROM $tbl WHERE id=$id";

  if ($conn->query($sql) === TRUE) {
    if ($msg !== '')
      $_SESSION['alerts'][] = $msg;
    $sql = "DELETE FROM savings WHERE customer_id=$id";
    $conn->query($sql);
    $sql = "DELETE FROM withdrawals WHERE customer_id=$id";
    $conn->query($sql);
  } else {
    $_SESSION['alerts'][] = "Error deleting record: " . $conn->error;
  }

  $conn->close();
}

if ($pg === '') {
  header('location: ' . $_SERVER['HTTP_REFERER']);
} else {
  header("Location: ../?page=$pg");
}
exit;