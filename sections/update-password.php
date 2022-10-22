<?php
$name = explode(' ', $user['name']);
?>
<div class="">
  <h5 class="card-title text-center pb-0 fs-4">Welcome <?= ucfirst($name[0]) ?>!</h5>
  <p class="text-center small">Please change your password to get started</p>
</div>

<form action="_/update_password.php" method="post" onsubmit="return reNewPassword()">
  <input type="hidden" name="tbl" value="<?= $usr_tbl ?>">
  <input type="hidden" name="id" value="<?= $user['id'] ?>">
  <input type="hidden" name="ssn" value="user">
  <div class="mb-3">
    <label for="currentPassword" class="form-label">Current Password</label>
    <div class="">
      <input name="current_password" type="password" class="form-control" id="currentPassword">
    </div>
  </div>

  <div class="mb-3">
    <label for="newPassword" class="form-label">New Password</label>
    <div class="">
      <input name="new_password" type="password" class="form-control" id="newPassword">
    </div>
  </div>

  <div class="mb-3">
    <label for="renewPassword" class="form-label">Re-enter New Password</label>
    <div class="">
      <input name="renewpassword" type="password" class="form-control" id="renewPassword">
    </div>
  </div>

  <div class="text-center">
    <button type="submit" class="btn btn-primary">Change Password</button>
  </div>
</form>

<script>
  function reNewPassword() {
    const pw = document.getElementById('newPassword').value;
    const rpw = document.getElementById('renewPassword').value;
    if (pw !== rpw) {
      alert('new password does not match the re-entered new password');
      return false;
    }
  }
</script>