<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-dark layout-fixed">
  <div class="container">
    <a href="{{ route('home') }}"class="navbar-brand">
      <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text text-white font-weight-light">ARKA - GS</span>
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="#" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Upload</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <li><a href="{{ route('powitheta.index') }}" class="dropdown-item">PO With ETA </a></li>
            <li><a href="{{ route('grpo.index') }}" class="dropdown-item">GRPO History</a></li>
            <li><a href="#" class="dropdown-item">MIGI</a></li>
            <li><a href="#" class="dropdown-item">Incoming Inventory</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Admin</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <li><a href="#" class="dropdown-item">Activate User </a></li>
            <li><a href="#" class="dropdown-item">User List</a></li>
            <li><a href="#" class="dropdown-item">Roles</a></li>
            <li><a href="#" class="dropdown-item">Permission</a></li>
          </ul>
        </li>
      </ul>
    </div>

    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <li class="nav-item">
        <a href="#" class="nav-link">{{ auth()->user()->name }}</a>
      </li>
      <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="nav-link text-dark">
            <i class="fas fa-sign-out-alt"></i> Logout
          </button>
        </form>
      </li>
    </ul>
  </div>
</nav>
<!-- /.navbar -->