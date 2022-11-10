<?php
$withdrawals = [];
$cash_in = $cash_out = 0;
if (in_array($user['role'], ['administrator', 'accountant', 'human resource'])) {
  $withdrawals = get_data('withdrawals', 'id > 0 ORDER BY status');
} elseif ($user['role'] === 'customer') {
  $withdrawals = get_data('withdrawals', 'customer_id=' . $user['id'] . ' ORDER BY status');
  foreach ($withdrawals as $withdrawal) {
    $cash_out += $withdrawal['amount'];
  }
  rsort($withdrawals);
  $savings = get_data('savings', 'customer_id=' . $user['id']);
  foreach ($savings as $saving) {
    $dts = json_decode($saving['dates'], true);
    foreach ($dts as $dt => $da) {
      foreach ($da as $date => $amount) {
        $cash_in += $amount;
      }
    }
  }
} elseif ($user['role'] === 'agent') {
  $withdrawals = get_data('withdrawals', 'customer_id=' . $user['id'] . ' ORDER BY status');
} else {
  die;
}
$balance = $cash_in - $cash_out;
$withdrawable = $balance - 500;
if ($withdrawable < 0) $withdrawable = 0;
?>

<?php if($user['role'] === 'customer'): ?>
<button type="button" class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#request">
  Request Withdrawal
</button>
<div class="modal fade" id="request" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Request A Withdrawal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="_/add.php" method="post">
          <input type="hidden" name="tbl" value="withdrawals">
          <input type="hidden" name="customer_id" value="<?= $user['id'] ?>">
          <input type="hidden" name="agent_id" value="<?= $user['agent_id'] ?>">
          <div class="row g-3">
            <div class="col-12">
              <label for="amount" class="form-label">Amount (&#8358;)</label>
              <input type="number" id="amount" name="amount" class="form-control" max="<?= $withdrawable ?>" min="500" step="5" required>
              <span class="small fst-italic">Withdrawable: &#8358;<?= number_format($withdrawable) ?></span>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary w-100">Send Request</button>
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
    <div class="table-responsive">
      <table class="table table-sm">
        <thead>
          <tr>
            <th>#</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Status</th>
            <?php if ($user['role'] === 'administrator' || $user['role'] === 'customer'): ?>
              <th></th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php $sn = 1; foreach($withdrawals as $withdrawal): ?>
            <tr>
              <td><?= $sn++ ?></td>
              <td><?= date('d M Y', strtotime($withdrawal['created_at'])) ?></td>
              <td><?= number_format($withdrawal['amount']) ?></td>
              <td>
                <?php
                if ($withdrawal['status'] == 0) {
                  echo '<span class="badge bg-warning">pending</span>';
                } elseif ($withdrawal['status'] == 1) {
                  if ($user['role'] === 'administrator') {
                    echo '<span class="badge bg-primary">dispatched</span>';
                  } elseif ($user['role'] === 'customer') {
                    echo '<span class="badge bg-primary">approved</span>';
                  }
                } elseif ($withdrawal['status'] == 2) {
                  echo '<span class="badge bg-success">completed</span>';
                }
                ?>
              </td>
              <?php if ($user['role'] === 'administrator' || $user['role'] === 'customer'): ?>
              <td>
                <?php if ($withdrawal['status'] == 0): ?>
                  <?php if ($user['role'] === 'administrator'): ?>
                    <form action="_/update.php" method="post" class="d-inline-block" onsubmit="return confirm('Click OK to confirm')">
                      <input type="hidden" name="tbl" value="withdrawals">
                      <input type="hidden" name="id" value="<?= $withdrawal['id'] ?>">
                      <input type="hidden" name="status" value="1">
                      <button type="submit" class="btn btn-sm btn-outline-primary">dispatch</button>
                    </form>
                  <?php endif; ?>
                <?php elseif ($withdrawal['status'] == 1): ?>
                  <?php if ($user['role'] === 'customer'): ?>
                    <form action="_/update.php" method="post" class="d-inline-block" onsubmit="return confirm('Click OK to confirm')">
                      <input type="hidden" name="tbl" value="withdrawals">
                      <input type="hidden" name="id" value="<?= $withdrawal['id'] ?>">
                      <input type="hidden" name="status" value="2">
                      <button type="submit" class="btn btn-sm btn-outline-primary">confirm received</button>
                    </form>
                  <?php endif; ?>
                <?php endif; ?>
              </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>