<style>
  .today {
    background-color: #FFFFCC !important;
  }
  .td-btn {
    cursor: pointer;
  }
  .td-btn:hover {
    background-color: #FFFFCC !important;
  }
</style>
<?php
$customer_id = isset($_GET['customer_id']) ? (int)test_input($_GET['customer_id']) : 0;
$customer = get_data('customers', $customer_id)[0];
$agent = get_data('agents', $customer['agent_id'])[0];
$post_date = $date; $dates = [];
if ($user['role'] !== 'customer') die;
$savings = get_data('savings', 'customer_id=' . $user['id']);

$total = 0;
$savings_count = count($savings);
if ($savings_count > 0) {
  $post_date = date('Y-m-d', strtotime($savings[0]['post_date'] . '+1 day'));
  // $dates = json_decode($savings[0]['dates'], true);
}

foreach ($savings as $saving) {
  $dts = json_decode($saving['dates'], true);
  foreach ($dts as $dt => $da) {
    foreach ($da as $date => $amount) {
      $total += $amount;
      $dates[$date] = $amount;
    }
  }
}

// CALENDAR
date_default_timezone_set('Africa/Lagos');

if (isset($_GET['ym'])) {
  $ym = $_GET['ym'];
} else {
  $ym = date('Y-m');
}

$timestamp = strtotime($ym, '-01');
if ($timestamp === false) {
  $timestamp = time();
}

$today = date('Y-m-d', time());

$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));

$day_count = date('t', $timestamp);

$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));

$weeks = [];
$week = '';

$week .= str_repeat('<td></td>', $str);

for ($day = 1; $day <= $day_count; $day++, $str++) { 
  $date = $ym . '-' . $day;
  if (strlen($day) === 1) $date = $ym . '-0' . $day;

  if ($today === $date) {
    if (isset($dates[$date])) {
      $week .= '<td class="bg-success text-light">' . $day . '<br><small class="fst-italic">&#8358;' . $dates[$date] . '</small>';
    } else {
      $week .= '<td class="td-btn pb-3 today" data-bs-toggle="modal" data-bs-target="#addSavingModal" onclick="setDate(this.innerHTML)">' .
      $day;
    }
  } else {
    if (isset($dates[$date])) {
      $week .= '<td class="bg-success text-light">' . $day . '<br><small class="fst-italic">&#8358;' . $dates[$date] . '</small>';
    } else {
      $week .= '<td class="td-btn pb-3" data-bs-toggle="modal" data-bs-target="#addSavingModal" onclick="setDate(this.innerHTML)">' .
      $day;
    }
  }
  $week .= '</td>';

  if ($str % 7 == 6 || $day == $day_count) {
    if ($day == $day_count) {
      $week .= str_repeat('<td></td>', 6 - ($str % 7));
    }

    $weeks[] = '<tr>' . $week . '</tr>';

    $week = '';
  }

}
// CALENDAR
?>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">
          <a href="?page=my-savings&customer_id=<?= $customer_id ?>&ym=<?= $prev ?>" class="btn btn-light fw-bold">&lt;</a>
          <?= date('F Y', strtotime($ym)) ?>
          <a href="?page=my-savings&customer_id=<?= $customer_id ?>&ym=<?= $next ?>" class="btn btn-light fw-bold">&gt;</a>
        </h5>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>S</th>
                <th>M</th>
                <th>T</th>
                <th>W</th>
                <th>T</th>
                <th>F</th>
                <th>S</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach($weeks as $week) {
                  echo $week;
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function setDate(day) {
    let month = document.getElementById('month').value;
    if (day.length === 1) day = '0' + day;
    document.getElementById('date').value = month + '-' + day;
  }
</script>