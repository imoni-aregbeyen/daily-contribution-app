<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="?page=dashboard">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-heading">Pages</li>

    <?php if($user['role'] === 'administrator'): ?>
    <li class="nav-item">
      <a class="nav-link collapsed" href="?page=places">
        <i class="bi bi-building"></i>
        <span>Places of Coverage</span>
      </a>
    </li><!-- End Users Page Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="?page=agents">
        <i class="bi bi-person-badge"></i>
        <span>Agents</span>
      </a>
    </li><!-- End Users Page Nav -->
    <?php endif; ?>

    <?php if($user['role'] === 'administrator' || $user['role'] === 'agent'): ?>
    <li class="nav-item">
      <a class="nav-link collapsed" href="?page=customers">
        <i class="bi bi-person"></i>
        <span>Customer</span>
      </a>
    </li><!-- End Users Page Nav -->
    <?php endif; ?>

    <?php if($user['role'] === 'customer'): ?>
    <a class="nav-link collapsed" href="?page=my-savings">
        <i class="bi bi-bank"></i>
        <span>My Savings</span>
      </a>
    </li><!-- End Savings Page Nav -->
    <?php endif; ?>

    <li class="nav-item">
      <a class="nav-link collapsed" href="?page=profile">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li><!-- End Profile Page Nav -->

  </ul>

</aside>