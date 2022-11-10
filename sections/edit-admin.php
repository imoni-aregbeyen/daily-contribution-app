<?php
$admin_id = isset($_GET['id']) ? (int)test_input($_GET['id']) : 0;
$admin = get_data('users', $admin_id)[0];
?>

<div class="row">
  <div class="col-lg-6">
    <form action="_/update.php" method="post">
      <input type="hidden" name="tbl" value="users">
      <input type="hidden" name="id" value="<?= $admin['id'] ?>">
      <input type="hidden" name="dis" value="phone">
      <input type="hidden" name="msg" value="Updated Successfully!">
      <div class="row g-3">
        <div class="col-12">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" id="name" name="name" class="form-control" value="<?= $admin['name'] ?>" required>
        </div>
        <div class="col-12">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="tel" name="phone" id="phone" class="form-control" value="<?= $admin['phone'] ?>" required>
        </div>
        <div class="col-12">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" id="email" class="form-control" value="<?= $admin['email'] ?>">
        </div>
        <div class="col-12">
          <label for="address" class="form-label">Address</label>
          <textarea name="address" id="address" rows="2" class="form-control"><?= $admin['address'] ?></textarea>
        </div>
        <div class="col-12">
          <label for="role" class="form-label">Role</label>
          <select name="role" id="role" class="form-select" required>
            <option value="">-</option>
            <option value="administrator" <?php if ($admin['role'] === 'administrator') echo 'selected'; ?>>Administrator</option>
            <option value="accountant" <?php if ($admin['role'] === 'accountant') echo 'selected'; ?>>Accountant</option>
            <option value="human resource" <?php if ($admin['role'] === 'human resource') echo 'selected'; ?>>Human Resource</option>
          </select>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary w-100">Update Admin Details</button>
        </div>
      </div>
    </form>
  </div>
</div>