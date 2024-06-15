<header class="app-header sticky-top">
  <nav class="navbar navbar-expand-lg navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item d-block d-xl-none">
        <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="#">
          <i class="ti ti-menu-2"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link nav-icon-hover" href="#" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="ti ti-bell-ringing"></i>
          <div class="notification bg-primary rounded-circle">
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-start dropdown-start-animate-up m-0 p-0" aria-labelledby="drop2">
          <li>
            <a href="#" class="dropdown-item notify-style">
              <p class="notify-bolds fs-6 m-0 ">
                Notification!
              </p>
            </a>
          </li>
          <li>
            <a href="#" class="d-flex flex-column dropdown-item notify-style">
              <p class="notify-bold">Roman Joined the
                Team!</p>
              <p>Congratulate him
              </p>
            </a>
          </li>
          <li>
            <a href="#" class="d-flex flex-column dropdown-item notify-style">
              <p class="notify-bold">New message
                received!</p>
              <p>Salma sent you new
                message</p>
            </a>
          </li>
          <li>
            <a href="#" class="d-flex flex-column dropdown-item notify-style">
              <p class="notify-bold">New Payment
                received!</p>
              <p>Check your earnings
              </p>
            </a>
          </li>
        </ul>
      </li>
    </ul>
    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
      <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end m-0 p-0">
        <h5 class="text-center mt-2" style="font-weight: bolder;"><?= $_SESSION['username'] ?></h5>
        <p class="text-center mt-3 px-2">(<?= $_SESSION['role'] ?>)</p>
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon-hover" href="#" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
            <!-- Dimension 500 x 500 of img to show the logo profile at navbar -->
            <img src="photo/bro.jpg" alt="..." class="rounded-circle" style="width: 50px">
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
            <div class="message-body">
              <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-user fs-6"></i>
                <p class="mb-0 fs-3 profile-bold">My Profile</p>
              </a>
              <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-mail fs-6"></i>
                <p class="mb-0 fs-3 profile-bold">My Account</p>
              </a>
              <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-list-check fs-6"></i>
                <p class="mb-0 fs-3 profile-bold">My Task</p>
              </a>
              <a href="auth/signin.php?action=logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</header>