<?php
$roles = ['administrator', 'accountant', 'human resource'];
if (!in_array($user['role'], $roles)) die;

$admins = get_data('users');
rsort($admins);

$settings = get_data('settings')[0];
?>
<?php if ($user['role'] === 'administrator'): ?>
<button type="button" class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addAdminModal">
  Add Admin
</button>
<div class="modal fade" id="addAdminModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Register A New Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="_/register.php" method="post">
          <input type="hidden" name="tbl" value="users">
          <input type="hidden" name="dis" value="phone">
          <input type="hidden" name="logged_in" value=1>
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
              <label for="address" class="form-label">Address</label>
              <textarea name="address" id="address" rows="2" class="form-control"></textarea>
            </div>
            <div class="col-12">
              <label for="role" class="form-label">Role</label>
              <select name="role" id="role" class="form-select" required>
                <option value="">-</option>
                <option value="administrator">Administrator</option>
                <option value="accountant">Accountant</option>
                <option value="human resource">Human Resource</option>
              </select>
            </div>
            <div class="col-12">
              <label for="password" class="form-label">Create Password</label>
              <div class="input-group">
                <input type="password" name="password" class="form-control" id="password" value="12345678" required>
              </div>
              <span class="small fst-italic">Default password is: 12345678</span>
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
                <th scope="col">Address</th>
                <th scope="col">Role</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $sn = 1; foreach($admins as $admin): ?>
                <tr>
                  <td><?= $sn++ ?></td>
                  <td>
                    <?= ucwords($admin['name']) ?> <br>
                    <small>
                      <a href="tel:<?= $admin['phone'] ?>"><?= $admin['phone'] ?></a>
                    </small>
                  </td>
                  <td><?= $admin['address'] ?></td>
                  <td><?= ucwords($admin['role']) ?></td>
                  <td>
                    <?php if ($user['role'] === 'administrator'): ?>
                    <a href="?page=edit-admin&id=<?= $admin['id'] ?>" class="btn btn-outline-primary"><i class="bi bi-pencil"></i></a>
                    <form action="_/delete.php" method="post" class="d-inline-block" onsubmit="return confirm('Click OK to confirm delete')">
                      <input type="hidden" name="tbl" value="users">
                      <input type="hidden" name="id" value="<?= $admin['id'] ?>">
                      <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                    <?php endif; ?>
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