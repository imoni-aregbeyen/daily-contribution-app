<?php
if ($user['role'] !== 'administrator') die;
$places = get_data('places');
?>
<button type="button" class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPlaceModal">
  Add New Place
</button>
<div class="modal fade" id="addPlaceModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Register A New Place</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="_/register.php" method="post">
          <input type="hidden" name="tbl" value="places">
          <div class="row g-3">
            <div class="col-12">
              <label for="place" class="form-label">Place</label>
              <input type="text" id="place" name="place" class="form-control" required>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary w-100">Add Place</button>
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
                <th scope="col">Place of Coverage</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $sn = 1; foreach($places as $place): ?>
                <tr>
                  <td>
                    <?= $sn++ ?>
                  </td>
                  <td>
                    <?= ucwords($place['place']) ?> <br>
                  </td>
                  <td>
                    <a href="?page=edit-place&id=<?= $place['id'] ?>" class="btn btn-sm btn-outline-primary">
                      <i class="bi bi-pencil"></i>
                    </a>
                    <form action="_/delete.php" method="post" class="d-inline-block" onsubmit="return confirm('Click OK to confirm delete')">
                      <input type="hidden" name="tbl" value="places">
                      <input type="hidden" name="id" value="<?= $place['id'] ?>">
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