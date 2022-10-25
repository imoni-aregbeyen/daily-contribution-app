<?php
require 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = 0; $tbl = 'savings';  $dates = [];
  $agent_id = (int)test_input($_SESSION['user']['id']);
  $customer_id = (int)test_input($_POST['customer_id']);
  $amount = (int)test_input($_POST['amount']);
  $post_date = test_input($_POST['post_date']);
  $post_month = date('Y-m', strtotime($post_date));
  $month_int = date('m', strtotime($post_date));
  $post_year = date('Y', strtotime($post_date));
  $sql = "SELECT * FROM $tbl WHERE customer_id=$customer_id AND post_month='$post_month'";
  $rs = $conn->query($sql);
  if ($rs && $rs->num_rows > 0) {
    while ($row = $rs->fetch_assoc()) {
      $id = $row['id'];
      $dates = json_decode($row['dates'], true);
      $up_date = (strtotime($post_date) > strtotime($row['post_date'])) ? $post_date : $row['post_date'];
      $up_amount = $amount + $row['amount'];
    } 
    $dates[$date][$post_date] = $amount;
    $dates = json_encode($dates);
    $sql = "UPDATE $tbl SET amount=$up_amount, post_date='$up_date', dates='$dates' WHERE id=$id";
  } else {
    $dates[$date][$post_date] = $amount;
    $dates = json_encode($dates); 
    $sql = "INSERT INTO $tbl (agent_id, customer_id, amount, post_date, dates, post_month, month_int, post_year) VALUES
    ($agent_id, $customer_id, $amount, '$post_date', '$dates', '$post_month', $month_int, $post_year)";
  }

  if ($conn->query($sql) === TRUE) {
    // $_SESSION['alerts'][] = 'Saving Added Successfully!';
  } else {
    $_SESSION['alerts'][] = "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
if ($pg === '') {
  header('location: ' . $_SERVER['HTTP_REFERER']);
} else {
  header("Location: ../?page=$pg");
}
exit;