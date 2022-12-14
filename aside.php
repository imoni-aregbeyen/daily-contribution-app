<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="?page=dashboard">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-heading">Pages</li>

    <?php if(in_array($user['role'], ['administrator', 'accountant', 'human resource'])): ?>
    <li class="nav-item">
      <a class="nav-link collapsed" href="?page=collections">
        <i class="bi bi-collection"></i>
        <span>Collections</span>
      </a>
    </li><!-- End Places Page Nav -->
    <?php if ($user['role'] !== 'accountant'): ?>
    <li class="nav-item">
      <a class="nav-link collapsed" href="?page=places">
        <i class="bi bi-building"></i>
        <span>Places of Coverage</span>
      </a>
    </li><!-- End Places Page Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="?page=agents">
        <i class="bi bi-person-badge"></i>
        <span>Agents</span>
      </a>
    </li><!-- End Agents Page Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="?page=admins">
        <i class="bi bi-person-badge"></i>
        <span>Admins</span>
      </a>
    </li><!-- End Agents Page Nav -->
    <?php endif; ?>
    <?php endif; ?>

    <?php if(in_array($user['role'], ['administrator', 'agent', 'human resource', 'accountant'])): ?>
    <li class="nav-item">
      <a class="nav-link collapsed" href="?page=customers">
        <i class="bi bi-person"></i>
        <span>Customers</span>
      </a>
    </li><!-- End Customers Page Nav -->
    <?php endif; ?>

    <?php if($user['role'] === 'customer'): ?>
    <li>
      <a class="nav-link collapsed" href="?page=my-savings">
        <i class="bi bi-piggy-bank"></i>
        <span>My Savings</span>
      </a>
    </li><!-- End Savings Page Nav -->
    <?php endif; ?>
    <li>
      <a class="nav-link collapsed" href="?page=withdrawals">
        <i class="bi bi-bank"></i>
        <span>Withdrawals</span>
      </a>
    </li><!-- End Withdrawals Page Nav -->
    <li>
      <a class="nav-link collapsed" href="?page=loans">
        <i class="bi bi-cash-stack"></i>
        <span>Loans</span>
      </a>
    </li><!-- End Loans Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="?page=profile">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li><!-- End Profile Page Nav -->

    <li class="nav-item d-lg-none">
      <a href="_/logout.php" class="nav-link text-danger">
        <i class="bi bi-arrow-left"></i>
        <span>logout</span>
      </a>
    </li>

  </ul>

</aside>