<div class="">
  <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
  <p class="text-center small">Enter your phone number & password to login</p>
</div>

<form action="_/login.php" method="post" class="row g-3 needs-validation" novalidate>
  <input type="hidden" name="ssn" value="user">
  <div class="input-group input-group-sm">
    <label for="tbl" class="input-group-text">Account Type</label>
    <select name="tbl" id="tbl" class="form-select">
      <option value="customers" selected>Customer</option>
      <option value="agents">Agent</option>
      <option value="users">Admin</option>
    </select>
  </div>

  <div class="col-12">
    <label for="phone" class="form-label">Phone</label>
    <input type="tel" name="phone" id="phone" class="form-control" required autofocus>
  </div>

  <div class="col-12">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="password" required>
    <div class="invalid-feedback">Please enter your password!</div>
  </div>

  

  <div class="col-12">
    <button class="btn btn-primary w-100" type="submit">Login</button>
  </div>
  
</form>