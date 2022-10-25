<?php
$agent_id = isset($_GET['id']) ? (int)test_input($_GET['id']) : 0;
$agent = get_data('agents', $agent_id)[0];
$places = get_data('places');
?>

<div class="row">
  <div class="col-lg-6">
    <form action="_/update.php" method="post">
      <input type="hidden" name="tbl" value="agents">
      <input type="hidden" name="id" value="<?= $agent['id'] ?>">
      <input type="hidden" name="dis" value="phone">
      <input type="hidden" name="msg" value="Updated Successfully!">
      <div class="row g-3">
        <div class="col-12">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" id="name" name="name" class="form-control" value="<?= $agent['name'] ?>" required>
        </div>
        <div class="col-12">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="tel" name="phone" id="phone" class="form-control" value="<?= $agent['phone'] ?>" required>
        </div>
        <div class="col-12">
          <label for="place" class="form-label">Place of Assignment</label>
          <select name="place" id="place" class="form-select" required>
            <option value="">Select a Place</option>
            <?php foreach($places as $place): ?>
              <option value="<?= $place['place'] ?>" <?= $place['place'] === $agent['place'] ? 'selected' : '' ?>><?= ucwords($place['place']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary w-100">Update Agent Details</button>
        </div>
      </div>
    </form>
  </div>
</div>