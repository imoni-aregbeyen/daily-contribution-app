<div class="row">

  <div class="col-xl-8">

    <div class="card">
      <div class="card-body pt-3">
        <!-- Bordered Tabs -->
        <ul class="nav nav-tabs nav-tabs-bordered">

          <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
          </li>

          <?php if ($user['role'] === 'administrator'): ?>
          <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
          </li>
          <?php endif; ?>

          <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
          </li>

        </ul>
        <div class="tab-content pt-2">

          <div class="tab-pane fade show active profile-overview" id="profile-overview">
            <h5 class="card-title">Profile Details</h5>

            <div class="row">
              <div class="col-lg-3 col-md-4 label ">Full Name</div>
              <div class="col-lg-9 col-md-8"><?= ucwords($user['name']) ?></div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-4 label">Role</div>
              <div class="col-lg-9 col-md-8"><?= ucwords($user['role']) ?></div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-4 label">Address</div>
              <div class="col-lg-9 col-md-8"><?= $user['address'] ?></div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-4 label">Phone</div>
              <div class="col-lg-9 col-md-8">
                <a href="tel:<?= $user['phone'] ?>"><?= $user['phone'] ?></a>
              </div>
            </div>

          </div>

          <?php if ($user['role'] === 'administrator'): ?>
          <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
            <!-- Profile Edit Form -->
            <form action="_/update.php" method="post">

              <input type="hidden" name="tbl" value="users">
              <input type="hidden" name="id" value="<?= $user['id'] ?>">
              <input type="hidden" name="ssn" value="user">

              <div class="row mb-3">
                <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                <div class="col-md-8 col-lg-9">
                  <input name="name" type="text" class="form-control" id="name" value="<?= ucwords($user['name']) ?>" required>
                </div>
              </div>

              <div class="row mb-3">
                <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                <div class="col-md-8 col-lg-9">
                  <input name="address" type="text" class="form-control" id="address" value="<?= $user['address'] ?>">
                </div>
              </div>

              <div class="row mb-3">
                <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                <div class="col-md-8 col-lg-9">
                  <input name="phone" type="tel" class="form-control" id="phone" value="<?= $user['phone'] ?>">
                </div>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </form><!-- End Profile Edit Form -->
          </div>
          <?php endif; ?>

          <div class="tab-pane fade pt-3" id="profile-change-password">
            <!-- Change Password Form -->
            <form action="_/update_password.php" method="post" onsubmit="return reNewPassword()">
              <input type="hidden" name="tbl" value="<?= $usr_tbl ?>">
              <input type="hidden" name="id" value="<?= $user['id'] ?>">
              <input type="hidden" name="ssn" value="user">
              <div class="row mb-3">
                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                <div class="col-md-8 col-lg-9">
                  <input name="current_password" type="password" class="form-control" id="currentPassword">
                </div>
              </div>

              <div class="row mb-3">
                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                <div class="col-md-8 col-lg-9">
                  <input name="new_password" type="password" class="form-control" id="newPassword">
                </div>
              </div>

              <div class="row mb-3">
                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                <div class="col-md-8 col-lg-9">
                  <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                </div>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary">Change Password</button>
              </div>
            </form><!-- End Change Password Form -->

          </div>

        </div><!-- End Bordered Tabs -->

      </div>
    </div>

  </div>
</div>
<script>
  function reNewPassword() {
    const pw = document.getElementById('newPassword').value;
    const rpw = document.getElementById('renewPassword').value;
    if (pw !== rpw) {
      alert('password mis-match');
      return false;
    }
  }
</script>