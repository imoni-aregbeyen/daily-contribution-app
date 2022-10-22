<?php
require 'conn.php';

$place = test_input($_GET['plc']);
$agents = get_data('agents', "place='$place'");

echo '<option></option>';
foreach($agents as $agent){
  $agent_id = $agent['id'];
  $agent_name = $agent['name'];
  $agent_place = $agent['place'];
  echo '<option value="'.$agent_id.'">' . $agent_name . '</option>';
}