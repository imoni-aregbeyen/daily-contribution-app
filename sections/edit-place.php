<?php
$place_id = isset($_GET['id']) ? (int)test_input($_GET['id']) : 0;
$place = get_data('places', $place_id)[0];
if ($user['role'] !== 'administrator') die;
?>
<div class="row">
  <div class="col-lg-6">
    <form action="_/update.php" method="post">
      <input type="hidden" name="tbl" value="places">
      <input type="hidden" name="id" value="<?= $place['id'] ?>">
      <input type="hidden" name="dis" value="place">
      <input type="hidden" name="msg" value="Updated!">

      <div class="row g-3">
        <div class="col-12">
          <label for="place" class="form-label">Place of Coverage</label>
          <input name="place" type="text" class="form-control" id="name" value="<?= ucfirst($place['place']) ?>" required>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary w-100">Update Place</button>
        </div>
      </div>

    </form>
  </div>
</div>