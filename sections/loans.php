<?php
$loans = [];
if (in_array($user['role'], ['administrator', 'accountant', 'human resource'])) {
  $loans = get_data('loans');
} elseif ($user['role'] === 'customer') {
  $loans = get_data('loans', 'customer_id=' . $user['id']);
}
?>

<?php if($user['role'] === 'customer'): ?>
<button type="button" class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#loan">
  Apply Loan
</button>
<div class="modal fade" id="loan" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Apply for a Loan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="_/add_loan.php" method="post">
          <input type="hidden" name="tbl" value="loans">
          <input type="hidden" name="customer_id" value="<?= $user['id'] ?>">
          <div class="row g-3">
            <div class="col-12">
              <label for="amount" class="form-label">Amount (&#8358;)</label>
              <input type="number" id="amount" name="amount" class="form-control" max="100000" min="1000" step="1000" oninput=
              "repayMent()" required>
              <!-- <span class="small fst-italic text-info">Min: &#8358;20,000 Max: &#8358;100,000 Interest Rate: 32%</span> -->
            </div>
            <div class="col-12">
              <label for="duration" class="form-label">Duration</label>
              <select name="duration" id="duration" class="form-select" oninput="repayMent()" required>
                <option value="">Select Duration</option>
                <option value="3 months">3 months (30% interest)</option>
                <option value="6 months">6 months (35% interest)</option>
              </select>
            </div>
            <div class="col-12">
              <label for="" class="form-label fw-bold">Total Repayment: <span id="ttlRpm"></span></label> <br>
              <label for="" class="form-label fw-bold">Weekly Payments: <span id="wklRpm"></span></label>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary w-100">Apply Now</button>
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
            <?php if ($user['role'] === 'administrator'): ?>
            <th>Customer</th>
            <?php endif; ?>
            <th>Amount</th>
            <th>Duration</th>
            <th>Repayment</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php $sn=1; foreach($loans as $loan): $customer = get_data('customers', $loan['customer_id'])[0]; ?>
            <tr>
              <td><?= $sn++; ?></td>
              <td><?= date('d M, Y', strtotime($loan['created_at'])); ?></td>
              <?php if ($user['role'] === 'administrator'): ?>
              <td><?= $customer['name'] ?></td>
              <?php endif; ?>
              <td><?= number_format($loan['amount']) ?></td>
              <td><?= $loan['duration'] ?></td>
              <td><?= number_format($loan['repayment']) ?></td>
              <td><?= $loan['status'] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  function repayMent() {
    let rpm, wkrpm = '';
    let amt = document.getElementById('amount').value;
    let drt = document.getElementById('duration').value;
    if (amt == '' || drt == '') return;
    if (drt == '3 months') {
      rpm = (amt * 0.3) + parseInt(amt);
      wkrpm = Math.ceil(rpm / 12);
    } else if (drt == '6 months') {
      rpm = (amt * 0.35) + parseInt(amt);
      wkrpm = Math.ceil(rpm / 24);
    }
    document.getElementById('ttlRpm').innerHTML = rpm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    document.getElementById('wklRpm').innerHTML = wkrpm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }
</script>