<?php
$customers = $agents = [];
if ($user['role'] === 'administrator') {
  $customers = get_data('customers');
  $agents = get_data('agents');
  $places = get_data('places');
} elseif ($user['role'] === 'agent') {
  $customers = get_data('customers', 'agent_id=' . $user['id']);
}
?>
<?php if (in_array($user['role'], ['administrator', 'agent', 'human resource'])): ?>
<button type="button" class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
  Add Customer
</button>
<div class="modal fade" id="addCustomerModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Register A New Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="_/register.php" method="post">
          <input type="hidden" name="tbl" value="customers">
          <input type="hidden" name="dis" value="phone">
          <div class="row g-3">
            <div class="col-12">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="col-12">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="tel" name="phone" id="phone" class="form-control" required>
            </div>
            <div class="col-12">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="col-12">
              <label for="amount" class="form-label">Amount (Daily)</label>
              <div class="input-group">
                <span class="input-group-text">&#8358;</span>
                <input type="number" name="amount" id="amount" class="form-control" required>
              </div>
            </div>
            <div class="col-12">
              <label for="address" class="form-label">Address</label>
              <textarea name="address" id="address" rows="2" class="form-control"></textarea>
            </div>
            <?php if($user['role'] === 'administrator'): ?>
            <div class="col-12">
              <label for="place" class="form-label">Place of Coverage</label>
              <select name="place" id="place" class="form-select" oninput="selectAgentByPlace(this.value)" required>
                <option value=""></option>
                <?php foreach($places as $place): ?>
                  <option value="<?= $place['place'] ?>">
                    <?= ucwords($place['place']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-12">
              <label for="agent" class="form-label">Agent Assigned</label>
              <select name="agent_id" id="agent" class="form-select" required>
                <option value=""></option>
                <?php foreach($agents as $agent): ?>
                  <option value="<?= $agent['id'] ?>">
                    <?= ucwords($agent['name']) ?> / <small><?= ucwords($agent['place']) ?></small>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <?php elseif($user['role'] === 'agent'): ?>
              <input type="hidden" name="agent_id" value="<?= $user['id'] ?>">
              <input type="hidden" name="place" value="<?= $user['place'] ?>">
            <?php endif; ?>

            <div class="col-12">
              <label for="password" class="form-label">Create Password</label>
              <div class="input-group">
                <input type="password" name="password" class="form-control" id="password" value="12345678" required>
              </div>
              <span class="small fst-italic">Default password is: 12345678</span>
            </div>

            <details>
              <summary>Account Details</summary>
              <div class="col-12 input-group">
                <label for="accountNumber" class="input-group-text col-4">Account Number</label>
                <input type="text" name="account_number" id="accountNumber" class="form-control">
              </div>
              <div class="col-12 input-group">
                <label for="bankName" class="input-group-text col-4">Bank Name</label>
                <input type="text" name="bank_name" id="bankName" class="form-control">
              </div>
              <div class="col-12 input-group">
                <label for="accountName" class="input-group-text col-4">Account Name</label>
                <input type="text" name="account_name" id="accountName" class="form-control">
              </div>
            </details>

            <div class="col-12">
              <button type="submit" class="btn btn-primary w-100">Create Account</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <?php if ($user['role'] === 'administrator'): ?>
                  <th>Agent</th>
                <?php endif; ?>
                <th scope="col">Account Details</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $sn = 1; foreach($customers as $customer): $agent = get_data('agents', $customer['agent_id'])[0]; ?>
                <tr>
                  <td><?= $sn++ ?></td>
                  <td>
                    <?= ucwords($customer['name']) ?> 
                  </td>
                  <td>
                    <a href="tel:<?= $customer['phone'] ?>"><?= $customer['phone'] ?></a>
                  </td>
                  <td>
                    <span class="small"><?= $customer['address'] ?></span>
                  </td>
                  <?php if ($user['role'] === 'administrator'): ?>
                  <td>
                    <span class="small"><?= ucwords($agent['name']) ?></span>
                  </td>
                  <?php endif; ?>
                  <td>
                    <span class="small"><?= $customer['account_number'] ?></span> <br>
                    <span class="small"><?= $customer['bank_name'] ?></span> <br>
                    <span class="small"><?= $customer['account_name'] ?></span>
                  </td>
                  <td>
                    <a href="?page=savings&customer_id=<?php echo $customer['id'] ?>" class="btn btn-sm btn-primary mb-1 mb-lg-0">Savings</a>
                    <a href="?page=update-customer&id=<?= $customer['id'] ?>" class="btn btn-sm btn-outline-primary">Update</a>
                    <form action="_/delete_customer.php" method="post" class="ms-3 d-inline-block" onsubmit="return confirm('Click OK to confirm delete')">
                      <input type="hidden" name="tbl" value="customers">
                      <input type="hidden" name="id" value="<?= $customer['id'] ?>">
                      <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function selectAgentByPlace(plc) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("agent").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","_/select_agent_by_place.php?plc=" + plc,true);
    xmlhttp.send();
  }
</script>