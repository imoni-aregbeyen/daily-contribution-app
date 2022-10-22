<?php
require 'conn.php';

$sql = "SELECT password FROM $tbl WHERE id=$id";
$rs = $conn->query($sql);
while ($row = $rs->fetch_assoc()) {
  $password = $row['password'];
}
$curr_pass = test_input($_POST['current_password']);
if (password_verify($curr_pass, $password)) {
  $new_pass = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
  // $sql = "UPDATE $tbl SET password='$new_pass' WHERE id=$id";
  $sql = "UPDATE $tbl SET password='$new_pass', logged_in=1 WHERE id=$id";
  if ($conn->query($sql) === TRUE) {
    $_SESSION['alerts'][] = ($msg !== '') ? $msg : "Password updated successfully";
    if ($ssn) $_SESSION[$ssn]['logged_in'] = 1;
  } else {
    $_SESSION['alerts'][] = "Error updating record: " . $conn->error;
  }
} else {
  $_SESSION['alerts'][] = "password mis-match, try again";
}

$conn->close();
if ($pg === '') {
  header('location: ' . $_SERVER['HTTP_REFERER']);
} else {
  header("Location: ../?page=$pg");
}
exit;