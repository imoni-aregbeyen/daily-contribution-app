<?php
$customer_id = isset($_GET['id']) ? (int)test_input($_GET['id']) : 0;
if ($user['role'] === 'administrator') {
  $customer = get_data('customers', $customer_id)[0];
  $agents = get_data('agents');
} elseif ($user['role'] === 'agent') {
  $agent_id = $user['id'];
  $customer = get_data('customers', "id=$customer_id AND agent_id=$agent_id")[0];
} else {
  die;
}

$readonly = $user['role'] === 'administrator' ? '' : 'readonly';
?>
<form action="_/update.php" method="post">

  <input type="hidden" name="tbl" value="customers">
  <input type="hidden" name="id" value="<?= $customer['id'] ?>">
  <input type="hidden" name="dis" value="phone">
  <input type="hidden" name="msg" value="Updated!">

  <div class="row mb-3">
    <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
    <div class="col-md-8 col-lg-9">
      <input name="name" type="text" class="form-control" id="name" value="<?= ucwords($customer['name']) ?>" required <?= $readonly ?>>
    </div>
  </div>

  <div class="row mb-3">
    <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
    <div class="col-md-8 col-lg-9">
      <input name="phone" type="tel" class="form-control" id="phone" value="<?= $customer['phone'] ?>" required <?= $readonly ?>>
    </div>
  </div>

  <div class="row mb-3">
    <label for="amount" class="col-md-4 col-lg-3 col-form-label">Set Amount (&#8358;)</label>
    <div class="col-md-8 col-lg-9">
      <input name="amount" type="number" class="form-control" id="amount" min=5 step=5 value="<?= $customer['amount'] ?>">
    </div>
  </div>

  <?php if ($user['role'] === 'administrator'): ?>
    <div class="row mb-3">
      <label for="agent_id" class="col-md-4 col-lg-3 col-form-label">Assigned Agent</label>
      <div class="col-md-8 col-lg-9">
        <select name="agent_id" id="agent_id" class="form-select">
          <option value=""></option>
          <?php foreach($agents as $agent): ?>
            <option value="<?= $agent['id'] ?>" <?= $customer['agent_id'] === $agent['id'] ? 'selected' : '' ?>><?= ucwords($agent['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  <?php endif; ?>

  <div class="row mb-3">
    <label for="accountNumber" class="col-md-4 col-lg-3 col-form-label">Accont Number</label>
    <div class="col-md-8 col-lg-9">
      <input name="account_number" type="text" class="form-control" id="accountNumber" value="<?= $customer['account_number'] ?>" <?= $readonly ?>>
    </div>
  </div>

  <div class="row mb-3">
    <label for="bankName" class="col-md-4 col-lg-3 col-form-label">Bank Name</label>
    <div class="col-md-8 col-lg-9">
      <input name="bank_name" type="text" class="form-control" id="bankName" value="<?= $customer['bank_name'] ?>" <?= $readonly ?>>
    </div>
  </div>

  <div class="row mb-3">
    <label for="accountName" class="col-md-4 col-lg-3 col-form-label">Accont Name</label>
    <div class="col-md-8 col-lg-9">
      <input name="account_name" type="text" class="form-control" id="accountName" value="<?= $customer['account_name'] ?>" <?= $readonly ?>>
    </div>
  </div>

  <div class="text-center">
    <button type="submit" class="btn btn-primary">Update Customer</button>
  </div>
</form>