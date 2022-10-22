<?php
$agents = get_data('agents');
rsort($agents);

$places = [];
$ppas = get_data('places');
foreach($ppas as $ppa){
  $places[] = $ppa['place'];
}
?>
<button type="button" class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addAgentModal">
  Add Agent
</button>
<div class="modal fade" id="addAgentModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Register A New Agent</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="_/register.php" method="post">
          <input type="hidden" name="tbl" value="agents">
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
              <label for="place" class="form-label">Place of Assignment</label>
              <select name="place" id="place" class="form-select" required>
                <option value="">Select a Place</option>
                <?php foreach($places as $place): ?>
                  <option value="<?= $place ?>"><?= ucwords($place) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-12">
              <label for="password" class="form-label">Create Password</label>
              <div class="input-group">
                <input type="password" name="password" class="form-control" id="password" required>
              </div>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary w-100">Create Account</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

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
                <th scope="col">
                  <small>Place of Assignment</small>
                </th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $sn = 1; foreach($agents as $agent): ?>
                <tr>
                  <td><?= $sn++ ?></td>
                  <td>
                    <?= ucwords($agent['name']) ?> <br>
                    <small>
                      <a href="tel:<?= $agent['phone'] ?>"><?= $agent['phone'] ?></a>
                    </small>
                  </td>
                  <td><?= ucwords($agent['place']) ?></td>
                  <td><a href="?page=edit-agent&id=<?= $agent['id'] ?>" class="btn btn-primary"><i class="bi bi-pencil"></i></a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>