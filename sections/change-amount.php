<?php
$customer_id = isset($_GET['customer_id']) ? (int)test_input($_GET['customer_id']) : 0;
if ($user['role'] === 'administrator') {
  $customer = get_data('customers', $customer_id)[0];
} elseif ($user['role'] === 'agent') {
  $agent_id = $user['id'];
  $customer = get_data('customers', "id=$customer_id AND agent_id=$agent_id")[0];
} else {
  die;
}
?>
<form action="_/update.php" method="post">

  <input type="hidden" name="tbl" value="customers">
  <input type="hidden" name="id" value="<?= $customer['id'] ?>">

  <div class="row mb-3">
    <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
    <div class="col-md-8 col-lg-9">
      <input name="name" type="text" class="form-control" id="name" value="<?= ucwords($customer['name']) ?>" readonly>
    </div>
  </div>

  <div class="row mb-3">
    <label for="amount" class="col-md-4 col-lg-3 col-form-label">Set Amount (&#8358;)</label>
    <div class="col-md-8 col-lg-9">
      <input name="amount" type="number" class="form-control" id="amount" min=5 step=5 value="<?= $customer['amount'] ?>">
    </div>
  </div>

  <div class="text-center">
    <button type="submit" class="btn btn-primary">Update Amount</button>
  </div>
</form>