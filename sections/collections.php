<?php
if ($user['role'] !== 'administrator') die;
$agents = get_data('agents');
$dt = isset($_GET['dt']) ? $_GET['dt'] : $today;
?>

<form action="_/query.php" method="post">
  <div class="row">
    <div class="col-lg-4">
      <input type="date" name="dt" id="dt" class="form-control" value="<?= $dt ?>" oninput="this.form.submit()">
    </div>
  </div>
</form>

<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>Agent</th>
        <th>Amount Collected</th>
        <th>Breakdown</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      foreach($agents as $agent):
        $collected = 0;
        $svs = get_data('savings', 'agent_id=' . $agent['id']);
        foreach ($svs as $saving) {
          $dts = json_decode($saving['dates'], true);
          foreach ($dts as $td => $da) {
            foreach ($da as $date => $amount) {
              if ($td === $dt)
                $collected += $amount;
            }
          }
        }
       ?>
        <tr>
          <td><?= ucwords($agent['name']) ?></td>
          <td><?= number_format($collected) ?></td>
          <td>
            <?php
              $customers = get_data('customers', 'agent_id=' . $agent['id']);
              foreach($customers as $customer) {
                $customer_id = $customer['id']; $amt = 0;
                $svs = get_data('savings', "customer_id=$customer_id AND updated_at LIKE '%$dt%'");
                foreach ($svs as $saving) {
                  $dts = json_decode($saving['dates'], true);
                  foreach ($dts as $td => $da) {
                    if ($td === $dt) {
                      foreach ($da as $date => $amount) {
                        $amt += $amount;
                      }
                    }
                  }
                }
                echo ucwords($customer['name']) . ': &#8358;' . number_format($amt) . 
                ' <a href="tel:'.$customer['phone'].'" class="bi bi-telephone">'.$customer['phone'].'</a><br>';
              }
            ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>