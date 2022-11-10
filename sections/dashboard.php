<?php
$revenue = $customers = $with_count = $balance = 0; $rvn_str = $ctm_str = '';
$rvn = isset($_GET['rvn']) ? $_GET['rvn'] : $this_month;
$ctm = isset($_GET['ctm']) ? $_GET['ctm'] : $this_year;
$rvn_len = strlen($rvn);
$ctm_len = strlen($ctm);
if ($rvn === $today) {
  $rvn_str = 'Today';
} elseif ($rvn === $this_month) {
  $rvn_str = 'This Month';
} elseif ($rvn === $this_year) {
  $rvn_str = 'This Year';
}
if ($ctm === $today) {
  $ctm_str = 'Today';
} elseif ($ctm === $this_month) {
  $ctm_str = 'This Month';
} elseif ($ctm === $this_year) {
  $ctm_str = 'This Year';
}

$savings = get_data('savings');
foreach ($savings as $saving) {
  $dts = json_decode($saving['dates'], true);
  foreach ($dts as $dt => $da) {
    foreach ($da as $date => $amount) {
      if (substr($dt, 0, $rvn_len) === $rvn)
        $revenue += $amount;
    }
  }
}
$ctms = get_data('customers');
foreach ($ctms as $customer) {
  if (substr($customer['created_at'], 0, $ctm_len) === $ctm) {
    $customers++;
  }
}
$withdrawals = get_data('withdrawals', 'status=0');
$with_count = count($withdrawals);
?>
<div class="row">

  <!-- Left side columns -->
  <div class="col-lg-12">
    <div class="row">
      <?php if(in_array($user['role'], ['administrator', 'accountant', 'human resource'])): ?>
      <!-- Revenue Card -->
      <div class="col-xxl-4 col-md-4">
        <div class="card info-card revenue-card">

          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Filter</h6>
              </li>

              <li><a class="dropdown-item" href="?page=dashboard&rvn=<?= $today ?>">Today</a></li>
              <li><a class="dropdown-item" href="?page=dashboard&rvn=<?= $this_month ?>">This Month</a></li>
              <li><a class="dropdown-item" href="?page=dashboard&rvn=<?= $this_year ?>">This Year</a></li>
            </ul>
          </div>

          <div class="card-body">
            <h5 class="card-title">Contributions <span>| <?= $rvn_str ?></span></h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-currency-naira">&#8358;</i>
              </div>
              <div class="ps-3">
                <h6>&#8358;<?= number_format($revenue) ?></h6>
              </div>
            </div>
          </div>

        </div>
      </div><!-- End Revenue Card -->
      <!-- Customers Card -->
      <div class="col-xxl-4 col-md-4">

        <div class="card info-card customers-card">

          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Filter</h6>
              </li>

              <li><a class="dropdown-item" href="?page=dashboard&ctm=<?= $today ?>">Today</a></li>
              <li><a class="dropdown-item" href="?page=dashboard&ctm=<?= $this_month ?>">This Month</a></li>
              <li><a class="dropdown-item" href="?page=dashboard&ctm=<?= $this_year ?>">This Year</a></li>
            </ul>
          </div>

          <a class="card-body" href="?page=customers">
            <h5 class="card-title">Customers <span>| <?= $ctm_str ?></span></h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-people"></i>
              </div>
              <div class="ps-3">
                <h6><?= number_format($customers) ?></h6>
              </div>
            </div>

          </a>
        </div>

      </div><!-- End Customers Card -->
      <!-- Withdrawals Card -->
      <div class="col-xxl-4 col-md-4">

        <div class="card info-card withdrawal-card">

          <a class="card-body" href="?page=withdrawals">
            <h5 class="card-title">Withdrawal Request</h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-send"></i>
              </div>
              <div class="ps-3">
                <h6><?= number_format($with_count) ?></h6>
              </div>
            </div>

          </div>
        </a>

      </div><!-- End Withdrawals Card -->
      <?php 
      elseif($user['role'] === 'customer'):
        $withdrawals = [];
        $cash_in = $cash_out = 0;
        $withdrawals = get_data('withdrawals', 'customer_id=' . $user['id']);
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
        $balance = $cash_in - $cash_out;
       ?>
      <div class="col-xxl-6 col-md-6">
        <div class="card info-card revenue-card">
          <div class="card-body">
            <h5 class="card-title">Account Balance</span></h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-currency-naira">&#8358;</i>
              </div>
              <div class="ps-3">
                <h6>&#8358;<?= number_format($balance) ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>

    </div>
  </div><!-- End Left side columns -->

  <!-- Right side columns -->
  <div class="col-lg-4">
    
  </div><!-- End Right side columns -->

</div>