<?php
session_start(); // must be first thing in your PHP
?>

<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Home | Smart Solar</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- [Favicon] icon -->
  <link rel="icon" type="image/png" sizes="32x32" href="../../images/LogoNoBG.png">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
    id="main-font-link">
  <!-- [Tabler Icons] https://tablericons.com -->
  <link rel="stylesheet" href="../assets/fonts/tabler-icons.min.css">
  <!-- [Feather Icons] https://feathericons.com -->
  <link rel="stylesheet" href="../assets/fonts/feather.css">
  <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
  <link rel="stylesheet" href="../assets/fonts/fontawesome.css">
  <!-- [Material Icons] https://fonts.google.com/icons -->
  <link rel="stylesheet" href="../assets/fonts/material.css">
  <!-- [Template CSS Files] -->
  <link rel="stylesheet" href="../assets/css/style.css" id="main-style-link">
  <link rel="stylesheet" href="../assets/css/style-preset.css">

  <style>
    /* Rounded edges, transition, hover lift */
    .card-hover {
      border-radius: 0.75rem;
      box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .1);
      transition: all 0.3s ease;
      padding: 1.5rem;
    }

    .card-hover:hover {
      transform: translateY(-6px);
      box-shadow: 0 1rem 1.5rem rgba(0, 0, 0, 0.15);
    }

    /* Bigger text styles */
    .card-hover h6 {
      font-size: 1.1rem;
      font-weight: 400;
      color: #6c757d;
      /* muted */
    }

    .card-hover h4 {
      font-size: 2rem;
      font-weight: 600;
    }

    .card-hover p {
      font-size: 1rem;
    }

    .card-hover .badge {
      font-size: 1rem;
    }

    /* Make card titles bold and black */
    .card-body h6 {
      font-weight: 700;
      /* bold */
      color: #000000 !important;
      /* black */
    }

    .pc-container {
      background-color: #E8EBF5
        /* light gray background */
    }

    .pc-header {
      height: 70px;
      /* match sidebar top area height */
    }

    /* Wrapper to center the card in sidebar */
    .sidebar-gif-wrapper {
      position: absolute;
      top: 85%;
      /* Y position in sidebar */
      left: 50%;
      /* X position in sidebar */
      transform: translate(-50%, -50%);
      /* center around that point */
    }

    /* Optional adjustments */
    .sidebar-gif-wrapper .card {
      background-color: #E8EBF5;
    }

    .sidebar-gif-wrapper h6 {
      margin-top: 0.5rem;
      font-size: 16px;
      font-weight: 600;
      color: #333333;
    }


    /* Sidebar menu items only */
    .pc-sidebar .pc-link {
      padding: 14px 18px;
      /* bigger clickable area */
      display: flex;
      align-items: center;
    }

    .pc-sidebar .pc-micon {
      font-size: 1.8rem;
      /* bigger icons */
      margin-right: 14px;
      /* more spacing */
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .pc-sidebar .pc-mtext {
      font-size: 1.25rem;
      /* bigger text */
      font-weight: 600;
    }





    /* Dark Mode Theme */
    body.dark-mode {
      background-color: #0E0E23;
    }

    /* PC container keeps its distinct color */
    body.dark-mode .pc-container {
      background-color: #24243E;
    }

    /* Sidebar + Navbar */
    body.dark-mode .pc-header,
    body.dark-mode .pc-sidebar {
      background-color: #0E0E23;
      color: #FFFFFF !important;
      border: none !important;
      box-shadow: none !important;
    }

    /* Project title near logo (Smart Solar) */
    body.dark-mode .m-header a span,
    body.dark-mode .pc-header .logo-text,
    body.dark-mode .pc-header .logo-text * {
      color: #FFFFFF !important;
    }

    /* User name in header */
    body.dark-mode .pc-header .user-info span,
    body.dark-mode .pc-header .dropdown-toggle,
    body.dark-mode .pc-header .user-name,
    body.dark-mode .pc-header .pc-head-link span {
      color: #FFFFFF !important;
    }

    /* Icons in header, sidebar, dropdowns */
    body.dark-mode .pc-header i:not([class*="text-"]),
    body.dark-mode .pc-sidebar i:not([class*="text-"]),
    body.dark-mode .dropdown-menu i:not([class*="text-"]) {
      color: #FFFFFF !important;
    }

    /* Dropdown menus for user profile */
    body.dark-mode .dropdown-menu {
      background-color: #24243E;
      border: none !important;
      box-shadow: none !important;
    }

    body.dark-mode .dropdown-menu a,
    body.dark-mode .dropdown-menu .dropdown-item {
      color: #FFFFFF !important;
    }

    body.dark-mode .dropdown-menu a:hover,
    body.dark-mode .dropdown-menu .dropdown-item:hover {
      background-color: #33334d !important;
      color: #FFFFFF !important;
    }

    /* Cards - strictly #0E0E23 */
    body.dark-mode .card {
      background-color: #0E0E23;
      border: none !important;
      box-shadow: none !important;
      color: #FFFFFF !important;
    }

    /* Special: GIF card should be #24243E */
    body.dark-mode .sidebar-gif-wrapper .card {
      background-color: #24243E !important;
      border: none !important;
      box-shadow: none !important;
      color: #FFFFFF !important;
    }

    /* Card text rules */
    body.dark-mode .card h1,
    body.dark-mode .card h2,
    body.dark-mode .card h3,
    body.dark-mode .card h4,
    body.dark-mode .card h5,
    body.dark-mode .card h6,
    body.dark-mode .card p,
    body.dark-mode .card label,
    body.dark-mode .card small {
      color: #FFFFFF !important;
    }

    /* Only top-level labels (Capacity, Yield, etc.) inside cards */
    body.dark-mode .card small.text-muted.d-block {
      color: #000000ff !important;
    }


    /* Values (numbers inside spans) = white in dark mode 
   but keep bootstrap contextual colors (success, danger, warning, etc.) */
    body.dark-mode .card span.fs-5:not([class*="text-"]) {
      color: #000000ff !important;
    }

    /* Sidebar text */
    body.dark-mode .pc-sidebar .pc-mtext {
      color: #FFFFFF !important;
    }

    /* Badges keep their bootstrap colors */
    body.dark-mode .badge,
    body.dark-mode .badge * {
      background: inherit !important;
      color: inherit !important;
    }
  </style>


</head>
<!-- [Head] end -->


<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
  <!-- [ Sidebar Menu ] start -->
  <nav class="pc-sidebar">
    <div class="navbar-wrapper">
      <div class="m-header">
        <a href="#" class="custom-logo-link" style="display:flex; align-items:center; text-decoration:none;">
          <img src="../../images/LogoNoBG.png" alt="Smart Solar Logo"
            style="max-height:50px; display:block; margin-right:10px;">
          <span style="font-size:1.4rem; font-weight:bold; color:#000;">Smart Solar</span>
        </a>
      </div>

      <div class="navbar-content">
        <ul class="pc-navbar">
          <li class="pc-item">
            <a href="../dashboard/adminDashboard.php" class="pc-link">
              <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
              <span class="pc-mtext">Dashboard</span>
            </a>
          </li>

          <li class="pc-item">
            <a href="../control-load/index.html" class="pc-link">
              <span class="pc-micon"><i class="ti ti-power"></i></span>
              <span class="pc-mtext">Control Load</span>
            </a>
          </li>

          <li class="pc-item sidebar-gif-wrapper">
            <div class="card"
              style="width: 220px; border-radius: 0.75rem; overflow: hidden; box-shadow: 0 .25rem .5rem rgba(0,0,0,.15); text-align:center;">
              <div class="card-body p-2">
                <img src="../../images/Solar Panel GIF.gif" alt="Sidebar GIF"
                  style="width: 100%; height: auto; border-radius: 0.5rem; display:block; margin:0 auto;">
                <h6 style="margin-top: 0.5rem; font-size: 18px; font-weight:600; color:#333;">
                  Solar Admin
                </h6>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
  <header class="pc-header">
    <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
      <div class="me-auto pc-mob-drp">
        <ul class="list-unstyled">
          <!-- ======= Menu collapse Icon ===== -->
          <li class="pc-h-item pc-sidebar-collapse">
            <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
              <i class="ti ti-menu-2"></i>
            </a>
          </li>
          <li class="pc-h-item pc-sidebar-popup">
            <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
              <i class="ti ti-menu-2"></i>
            </a>
          </li>
          <!-- Dark Mode Toggle -->
          <li class="pc-h-item">
            <a href="#" class="pc-head-link ms-0" id="darkModeToggle" title="Toggle Dark Mode">
              <i class="ti ti-moon" id="darkModeIcon"></i>
            </a>
          </li>
        </ul>
      </div>

      <?php
      require_once "config.php";

      // Ensure user is logged in
      if (!isset($_SESSION['user_id'])) {
        die("You must be logged in to view this page.");
      }

      $userId = $_SESSION['user_id'];

      // Fetch user info
      $sql = "SELECT * FROM users WHERE id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $userId);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $fullName = $user['full_name'];
        $email = $user['email'];
        $phone = $user['contact_number'];
        $dob = $user['date_of_birth'];
        $address = $user['address'];
        $role = $user['role'];
        $profilePhoto = $user['profile_image'] ?? '../assets/images/user/avatar-2.jpg';

        // Optional: store in session too
        $_SESSION['email'] = $email;
      } else {
        die("User not found.");
      }
      ?>

      <div class="ms-auto d-flex align-items-center">
        <ul class="list-unstyled d-flex align-items-center mb-0">

          <!-- User Profile Dropdown -->
          <li class="dropdown pc-h-item">
            <a class="pc-head-link dropdown-toggle d-flex align-items-center"
              style="padding: 20px 16px; gap:12px; min-width: 280px; cursor:pointer;"
              data-bs-toggle="dropdown" href="#"
              role="button" aria-haspopup="true" data-bs-auto-close="outside" aria-expanded="false">

              <!-- Avatar -->
              <img src="<?php echo htmlspecialchars(isset($user['profile_image']) && $user['profile_image'] != '' ? '../' . $user['profile_image'] : '/Smart Solar/dist/assets/images/user/avatar-1.jpg'); ?>" alt="Profile Picture" style="width:40px; height:40px; object-fit:cover; border-radius:50%; flex-shrink:0; display:block;">
              <!-- Full Name -->
              <span style="color:#000; font-weight:600; font-size:16px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                <?php echo htmlspecialchars($fullName); ?>
              </span>

            </a>

            <!-- Dropdown Menu -->
            <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
              <div class="dropdown-header d-flex align-items-center">
                <img src="<?php echo htmlspecialchars(isset($user['profile_image']) && $user['profile_image'] != '' ? '../' . $user['profile_image'] : '/Smart Solar/dist/assets/images/user/avatar-1.jpg'); ?>"
                  alt="user-image"
                  style="width:50px; height:50px; object-fit:cover; border-radius:50%; flex-shrink:0;">
                <div class="ms-3">
                  <h6><?php echo htmlspecialchars($fullName); ?></h6>
                  <span><?php echo htmlspecialchars(ucfirst($role)); ?></span>
                </div>
              </div>

              <div class="px-3 py-2">
                <h6 class="dropdown-header">Settings</h6>
                <a href="accountSettings.php" class="dropdown-item">
                  <i class="ti ti-user"></i>
                  <span>Account Settings</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ti ti-help"></i>
                  <span>Support</span>
                </a>
                <a href="#" class="dropdown-item logout-btn">
                  <i class="ti ti-power"></i>
                  <span>Logout</span>
                </a>
              </div>
            </div>
          </li>
        </ul>
      </div>

    </div>
  </header>
  <!-- [ Header ] end -->










  <!-- [ Main Content ] start -->
  <div class="pc-container">
    <div class="pc-content" style="padding-bottom: 2rem;">

      <!-- ✅ TOP METRICS ROW -->
      <div class="row g-3 mt-4 mb-4">
        <!-- Solar Voltage -->
        <div class="col-12 col-md-4">
          <div class="card h-100 card-hover">
            <div class="card-body d-flex justify-content-between align-items-center p-3">
              <div class="flex-grow-1 pe-2">
                <h6 class="mb-2 small">Solar Voltage</h6>
                <h4 class="mb-3 fw-bold">
                  <span id="voltage">--</span> V
                  <span class="badge bg-light-primary border border-primary small">
                    <i class="ti ti-trending-up"></i> <span id="voltage-status">--</span>
                  </span>
                </h4>
                <p class="mb-0 text-muted small">
                  The solar voltage is <span class="text-primary fw-bold" id="voltage-text">--</span>.
                </p>
              </div>
              <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none"
                  stroke="#0d6efd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                </svg>
              </div>
            </div>
          </div>
        </div>

        <!-- Solar Current -->
        <div class="col-12 col-md-4">
          <div class="card h-100 card-hover">
            <div class="card-body d-flex justify-content-between align-items-center p-3">
              <div class="flex-grow-1 pe-2">
                <h6 class="mb-2 small">Solar Current</h6>
                <h4 class="mb-3 fw-bold">
                  <span id="current">--</span> A
                  <span class="badge bg-light-success border border-success small">
                    <i class="ti ti-trending-up"></i> <span id="current-status">--</span>
                  </span>
                </h4>
                <p class="mb-0 text-muted small">
                  The solar current is <span class="text-success fw-bold" id="current-text">--</span>.
                </p>
              </div>
              <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none"
                  stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 22v-5"></path>
                  <path d="M7 7l3 3"></path>
                  <path d="M17 7l-3 3"></path>
                  <path d="M8 2h8v4H8z"></path>
                  <path d="M8 6h8l-1 4H9z"></path>
                </svg>
              </div>
            </div>
          </div>
        </div>

        <!-- Solar Power -->
        <div class="col-12 col-md-4">
          <div class="card h-100 card-hover">
            <div class="card-body d-flex justify-content-between align-items-center p-3">
              <div class="flex-grow-1 pe-2">
                <h6 class="mb-2 small">Solar Power</h6>
                <h4 class="mb-3 fw-bold">
                  <span id="power">--</span> W
                  <span class="badge bg-light-warning border border-warning small">
                    <i class="ti ti-trending-down"></i> <span id="power-status">--</span>
                  </span>
                </h4>
                <p class="mb-0 text-muted small">
                  Solar power is <span class="text-warning fw-bold" id="power-text">--</span>.
                </p>
              </div>
              <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none"
                  stroke="#ffc107" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 3v3"></path>
                  <path d="M16.24 7.76l-2.12 2.12"></path>
                  <path d="M9.88 9.88L7.76 7.76"></path>
                  <path d="M12 12v7"></path>
                  <circle cx="12" cy="12" r="9"></circle>
                </svg>
              </div>
            </div>
          </div>
        </div>

        <!-- Battery Voltage -->
        <div class="col-12 col-md-4">
          <div class="card h-100 card-hover">
            <div class="card-body d-flex justify-content-between align-items-center p-3">
              <div class="flex-grow-1 pe-2">
                <h6 class="mb-2 small">Battery Voltage</h6>
                <h4 class="mb-3 fw-bold">
                  <span id="battery-voltage">--</span> V
                  <span class="badge bg-light-info border border-info small">
                    <i class="ti ti-bolt"></i> <span id="battery-voltage-status">--</span>
                  </span>
                </h4>
                <p class="mb-0 text-muted small">
                  Battery voltage is <span class="text-info fw-bold" id="battery-voltage-text">--</span>.
                </p>
              </div>
              <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none"
                  stroke="#0dcaf0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="2" y="7" width="20" height="10" rx="2" ry="2"></rect>
                  <line x1="6" y1="11" x2="6" y2="13"></line>
                  <line x1="18" y1="11" x2="18" y2="13"></line>
                </svg>
              </div>
            </div>
          </div>
        </div>

        <!-- Battery Current -->
        <div class="col-12 col-md-4">
          <div class="card h-100 card-hover">
            <div class="card-body d-flex justify-content-between align-items-center p-3">
              <div class="flex-grow-1 pe-2">
                <h6 class="mb-2 small">Battery Current</h6>
                <h4 class="mb-3 fw-bold">
                  <span id="battery-current">--</span> A
                  <span class="badge bg-light-danger border border-danger small">
                    <i class="ti ti-current"></i> <span id="battery-current-status">--</span>
                  </span>
                </h4>
                <p class="mb-0 text-muted small">
                  Battery current is <span class="text-danger fw-bold" id="battery-current-text">--</span>.
                </p>
              </div>
              <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none"
                  stroke="#dc3545" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 22v-5"></path>
                  <path d="M7 7l3 3"></path>
                  <path d="M17 7l-3 3"></path>
                  <path d="M8 2h8v4H8z"></path>
                  <path d="M8 6h8l-1 4H9z"></path>
                </svg>
              </div>
            </div>
          </div>
        </div>

        <!-- Battery Power -->
        <div class="col-12 col-md-4">
          <div class="card h-100 card-hover">
            <div class="card-body d-flex justify-content-between align-items-center p-3">
              <div class="flex-grow-1 pe-2">
                <h6 class="mb-2 small">Battery Power</h6>
                <h4 class="mb-3 fw-bold">
                  <span id="battery-power">--</span> W
                  <span class="badge bg-light-warning border border-warning small">
                    <i class="ti ti-trending-down"></i> <span id="battery-power-status">--</span>
                  </span>
                </h4>
                <p class="mb-0 text-muted small">
                  Battery power is <span class="text-warning fw-bold" id="battery-power-text">--</span>.
                </p>
              </div>
              <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none"
                  stroke="#fd7e14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="9"></circle>
                  <path d="M12 3v3"></path>
                  <path d="M16.24 7.76l-2.12 2.12"></path>
                  <path d="M9.88 9.88L7.76 7.76"></path>
                  <path d="M12 12v7"></path>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- ✅ PERFORMANCE & STATUS ROW -->
      <div class="row g-4 align-items-stretch">
        <!-- LEFT COLUMN -->
        <div class="col-12 col-md-6 d-flex">
          <div class="card card-hover w-100">
            <div class="card-body d-flex flex-column h-100">
              <!-- TOP SECTION -->
              <div class="d-flex justify-content-between align-items-start mb-4">
                <div class="flex-grow-1 pe-3">
                  <h6 class="mb-3">Performance Monitoring</h6>
                  <h4 class="mb-4">Detailed analytics and real-time monitoring</h4>
                  <p class="mb-0 text-muted small">
                    Get insights into daily, weekly, and monthly trends of your solar system performance.
                  </p>
                </div>
                <div class="flex-shrink-0">
                  <img src="../../images/Solar Panel.png" alt="Solar Panel"
                    style="max-width:300px; height:auto; border-radius:0.5rem;">
                </div>
              </div>

              <!-- BOTTOM SECTION -->
              <div class="d-flex justify-content-between align-items-start mt-auto">
                <div class="flex-grow-1 pe-3">
                  <h6 class="mb-1 d-flex align-items-center">
                    <i class="ti ti-bolt me-2 text-warning fs-4"></i>
                    Power Usage
                  </h6>
                  <h3 class="mb-1 fw-bold">12.35</h3>
                  <small class="text-muted">
                    1 Hour usage <span class="fw-bold">6.8 kWh</span>
                  </small>
                </div>
                <div class="card"
                  style="min-width:320px; border-radius:1rem; box-shadow:0 .25rem .5rem rgba(0,0,0,.1); background-color:#f8f9fa;">
                  <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                      <div class="d-flex align-items-center me-4">
                        <i class="ti ti-battery-charging me-3 text-primary fs-3"></i>
                        <div>
                          <small class="text-muted d-block">Capacity</small>
                          <span class="fw-bold fs-5">210 kWh</span>
                        </div>
                      </div>
                      <div class="d-flex align-items-center">
                        <i class="ti ti-sun me-3 text-warning fs-3"></i>
                        <div>
                          <small class="text-muted d-block">Yield</small>
                          <span class="fw-bold fs-5">178 kWh</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- bottom section -->
            </div>
          </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="col-12 col-md-6 d-flex flex-column h-100">
          <div class="d-flex flex-column h-100 w-100">

            <!-- Battery Level -->
            <div class="card card-hover mb-3 flex-fill">
              <div class="card-body d-flex justify-content-between align-items-center h-100">
                <div class="flex-grow-1 pe-3">
                  <h6 class="mb-3">Battery Level</h6>
                  <h4 class="mb-4">
                    <span id="battery-soc">--</span>%
                    <span class="badge bg-light-success border border-success" id="battery-status">
                      <i class="ti ti-battery"></i> --
                    </span>
                  </h4>
                  <p class="mb-0 text-muted small">
                    Battery level is <span class="text-success fw-bold" id="battery-text">--</span>.
                  </p>
                </div>
                <div class="flex-shrink-0">
                  <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none"
                    stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="7" width="18" height="10" rx="2" ry="2"></rect>
                    <line x1="22" y1="11" x2="22" y2="13"></line>
                    <rect id="battery-fill" x="4" y="9" width="10" height="6" fill="#198754" stroke="none"></rect>
                  </svg>
                </div>
              </div>
            </div>

            <!-- Temperature Status -->
            <div class="card card-hover flex-fill">
              <div class="card-body d-flex justify-content-between align-items-center h-100">
                <div class="flex-grow-1 pe-3">
                  <h6 class="mb-3">Temperature Status</h6>
                  <h4 class="mb-4">
                    <span id="temperature">--</span>°C
                    <span class="badge bg-light-warning border border-warning" id="temperature-status">
                      <i class="ti ti-sun"></i> --
                    </span>
                  </h4>
                  <p class="mb-0 text-muted small">
                    System temperature is <span class="text-warning fw-bold" id="temperature-text">--</span>.
                  </p>
                </div>
                <div class="flex-shrink-0">
                  <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 26" fill="none"
                    stroke="#ffc107" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 14.76V3.5a2.5 2.5 0 1 0-5 0v11.26a5 5 0 1 0 5 0z"></path>
                  </svg>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div><!-- row -->

      <!-- ✅ WEATHER & GRAPH ROW -->
      <div class="row g-3">
        <!-- 🌤️ WEATHER CARD -->
        <div class="col-12 col-md-6">
          <div class="card card-hover h-100">
            <div class="card-body d-flex justify-content-between align-items-center p-3">
              <!-- LEFT CONTENT -->
              <div class="flex-grow-1 pe-3">
                <h6 class="mb-2">Weather</h6>
                <h4 class="mb-1">
                  <span class="fw-bold" id="temp">--°C</span>
                </h4>
                <p class="mb-1 text-muted small" id="temp-min-max">H: --°C / L: --°C</p>
                <p class="mb-3 text-muted small" id="description">--</p>
                <p class="mb-1 text-muted small" id="date">--/--/----</p>
                <p class="mb-0 text-muted small">
                  The current weather is <span class="text-info fw-bold" id="weather-info">--</span>.
                </p>

                <!-- CREDIT LABEL -->
                <p class="mt-3 mb-0 text-muted small">
                  Data provided by <a href="https://openweathermap.org/" target="_blank" class="text-decoration-none">OpenWeather</a>
                </p>
              </div>

              <!-- RIGHT ICON -->
              <div class="flex-shrink-0" id="weather-icon" style="font-size: 100px; line-height: 1;">
                🌡️
              </div>
            </div>
          </div>
        </div>


        <!-- 📈 GRAPH CARD -->
        <div class="col-12 col-md-6">
          <div class="card card-hover h-100 shadow-sm border-0">
            <div class="card-body d-flex flex-column justify-content-between" style="height:260px;">
              <h6 class="mb-3 fw-semibold text-primary">Weather Trend</h6>

              <div class="mb-2">
                <select id="trendSelector" class="form-select form-select-sm w-auto">
                  <option value="hourly">Hourly</option>
                  <option value="daily" selected>Daily</option>
                  <option value="weekly">Weekly</option>
                  <option value="monthly">Monthly</option>
                </select>
              </div>

              <div class="flex-grow-1" style="height:140px;">
                <canvas id="weatherChart" style="width:100%; height:100%;"></canvas>
              </div>

              <p id="weather-span" class="mt-2 text-muted small fst-italic">
              </p>
            </div>
          </div>
        </div>
      </div>



    </div>
  </div>


  <!-- [ Main Content ] end -->


  <!-- [Page Specific JS] start -->
  <script src="../assets/js/plugins/apexcharts.min.js"></script>
  <script src="../assets/js/pages/dashboard-default.js"></script>
  <!-- [Page Specific JS] end -->
  <!-- Required Js -->
  <script src="../assets/js/plugins/popper.min.js"></script>
  <script src="../assets/js/plugins/simplebar.min.js"></script>
  <script src="../assets/js/plugins/bootstrap.min.js"></script>
  <script src="../assets/js/fonts/custom-font.js"></script>
  <script src="../assets/js/pcoded.js"></script>
  <script src="../assets/js/plugins/feather.min.js"></script>
  <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    let chartInstance = null;

    async function loadWeatherTrend(span = 'daily') {
      try {
        const response = await fetch(`get_weather_history.php?span=${span}`);
        const data = await response.json();

        let labels = [];
        let temps = [];

        if (span === 'hourly') {
          // 00:00 → 23:00
          const allHours = Array.from({
            length: 24
          }, (_, i) => i.toString().padStart(2, '0') + ':00');
          const tempMap = {};
          data.forEach(entry => {
            const hour = new Date(entry.time).getHours();
            tempMap[hour] = entry.temperature;
          });
          labels = allHours;
          temps = allHours.map((_, i) => tempMap[i] ?? null);
          document.getElementById('weather-span').textContent = "Hourly trend for today (00:00 → 23:00)";

        } else if (span === 'daily') {
          const weekdays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
          const tempMap = {};
          data.forEach(entry => {
            const d = new Date(entry.time);
            const dayName = weekdays[(d.getDay() + 6) % 7]; // start from Monday
            tempMap[dayName] = entry.temperature;
          });
          labels = weekdays;
          temps = weekdays.map(day => tempMap[day] ?? null);
          document.getElementById('weather-span').textContent = "Daily trend for the last 7 days (Monday → Sunday)";

        } else if (span === 'weekly') {
          // Use dynamic labels based on returned week_number
          labels = data.map(d => "Week " + d.week_number);
          temps = data.map(d => d.avg_temp);
          document.getElementById('weather-span').textContent = "Weekly trend for the last 4 weeks";

        } else if (span === 'monthly') {
          const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
          const tempMap = {};
          // Map the returned data
          data.forEach(d => {
            tempMap[months[d.month_number - 1]] = d.avg_temp;
          });
          // Always display all 12 months
          labels = months;
          temps = months.map(m => tempMap[m] ?? null); // null for missing months
          document.getElementById('weather-span').textContent = "Monthly trend for the last 12 months (Jan → Dec)";
        }


        if (chartInstance) chartInstance.destroy();

        const ctx = document.getElementById('weatherChart').getContext('2d');
        chartInstance = new Chart(ctx, {
          type: 'line',
          data: {
            labels: labels,
            datasets: [{
              label: 'Temperature (°C)',
              data: temps,
              fill: true,
              backgroundColor: 'rgba(54, 162, 235, 0.2)',
              borderColor: 'rgba(54, 162, 235, 1)',
              tension: 0.3,
              pointRadius: 4,
              pointHoverRadius: 6
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
              y: {
                beginAtZero: false,
                title: {
                  display: true,
                  text: 'Temperature (°C)'
                }
              },
              x: {
                title: {
                  display: true,
                  text: span === 'hourly' ? 'Hour' : span === 'daily' ? 'Day' : span === 'weekly' ? 'Week' : 'Month'
                }
              }
            },
            plugins: {
              legend: {
                display: true,
                position: 'top'
              },
              tooltip: {
                mode: 'index',
                intersect: false,
                callbacks: {
                  label: function(context) {
                    return context.raw === null ? 'No data' : context.raw + ' °C';
                  }
                }
              }
            }
          }
        });

      } catch (err) {
        console.error('Error loading weather trend:', err);
      }
    }

    // Initial load
    loadWeatherTrend();

    // Change trend on selector
    document.getElementById('trendSelector').addEventListener('change', (e) => {
      loadWeatherTrend(e.target.value);
    });


    // Change trend on selector
    document.getElementById('trendSelector').addEventListener('change', (e) => {
      loadWeatherTrend(e.target.value);
    });





    document.querySelectorAll('.logout-btn').forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault(); // prevent default link behavior

        Swal.fire({
          title: 'Are you sure?',
          text: "You will be logged out!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Yes, logout!',
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = 'logout.php';
          }
        });
      });
    });



    // Tuburan, Cebu coordinates
    const lat = 10.7333;
    const lon = 123.8176;

    // Philippine-weather-appropriate emojis
    const weatherMap = {
      "Clear": {
        text: "Clear sky",
        icon: "☀️"
      },
      "Clouds": {
        text: "Cloudy / Overcast",
        icon: "☁️"
      },
      "Rain": {
        text: "Rain showers",
        icon: "🌧️"
      },
      "Drizzle": {
        text: "Light drizzle",
        icon: "🌦️"
      },
      "Thunderstorm": {
        text: "Thunderstorm",
        icon: "⛈️"
      },
      "Mist": {
        text: "Fog / Haze",
        icon: "🌫️"
      },
      "Haze": {
        text: "Haze",
        icon: "🌫️"
      },
      "Fog": {
        text: "Fog / Mist",
        icon: "🌫️"
      },
    };

    // Replace with your OpenWeather API key
    const apiKey = "365ca26744409589e2dd00f63f051ba6";

    async function getWeather() {
      try {
        const response = await fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`);
        const data = await response.json();

        const temp = data.main.temp.toFixed(0);
        const tempMin = data.main.temp_min.toFixed(0);
        const tempMax = data.main.temp_max.toFixed(0);

        const condition = data.weather[0].main;
        const weatherData = weatherMap[condition] || {
          text: condition,
          icon: "🌡️"
        };

        // Update UI
        document.getElementById("temp").textContent = `${temp}°C`;

        // Show highs and lows
        document.getElementById("temp-min-max").textContent = `H: ${tempMax}°C / L: ${tempMin}°C`;

        document.getElementById("description").textContent = weatherData.text;
        document.getElementById("weather-info").textContent = weatherData.text;
        document.getElementById("weather-icon").textContent = weatherData.icon;


        const today = new Date();
        document.getElementById("date").textContent = `${today.getMonth() + 1}/${today.getDate()}/${today.getFullYear()}`;

        // Send current temperature to database
        saveWeatherToDB(temp);

      } catch (err) {
        console.error("Error fetching weather:", err);
      }
    }

    // Function to send temperature to PHP
    async function saveWeatherToDB(temp) {
      try {
        const formData = new FormData();
        formData.append('temperature', temp);

        const response = await fetch('save_weather.php', {
          method: 'POST',
          body: formData
        });

        const result = await response.json();
        console.log('Weather saved:', result);

      } catch (err) {
        console.error('Error saving weather:', err);
      }
    }

    // Initial fetch
    getWeather();
    // Update every 5 minutes
    setInterval(getWeather, 300000);

    // -----------------------------
    // MQTT WebSocket Connection
    // -----------------------------
    const client = mqtt.connect('ws://broker.hivemq.com:8000/mqtt'); // non-TLS

    // Keep latest values for calculations
    let latestSolarV = 0;
    let latestSolarI = 0;
    let latestBattV = 0;
    let latestBattI = 0;
    let latestTemperature = 0;

    client.on('connect', () => {
      console.log('Connected to MQTT broker via WebSocket');

      const topics = [
        'solar/voltage',
        'solar/current',
        'solar/power',
        'battery/voltage',
        'battery/current',
        'battery/power',
        'battery/soc',
        'system/temperature'
      ];

      topics.forEach(topic => {
        client.subscribe(topic, (err) => {
          if (!err) console.log('Subscribed to', topic);
          else console.error('Subscribe error for', topic, err);
        });
      });
    });

    client.on('error', (err) => {
      console.error('MQTT connection error:', err);
    });

    // -----------------------------
    // MQTT Message Handling
    // -----------------------------
    client.on('message', (topic, message) => {
      const value = parseFloat(message.toString());

      switch (topic) {
        // -------- Solar --------
        case 'solar/voltage':
          latestSolarV = value;
          document.getElementById('voltage').innerText = value.toFixed(2);
          document.getElementById('voltage-status').innerText = value > 12.5 ? 'Stable' : 'Low';
          document.getElementById('voltage-text').innerText = value > 12.5 ? 'within normal range' : 'low';
          break;

        case 'solar/current':
          latestSolarI = value;
          document.getElementById('current').innerText = Math.abs(value).toFixed(2);
          document.getElementById('current-status').innerText = Math.abs(value) < 10 ? 'Normal' : 'High';
          document.getElementById('current-text').innerText = Math.abs(value) < 10 ? 'within safe limits' : 'overcurrent!';
          break;

        case 'solar/power':
          document.getElementById('power').innerText = value.toFixed(1);
          document.getElementById('power-status').innerText = '--';
          document.getElementById('power-text').innerText = '--';
          break;

          // -------- Battery --------
        case 'battery/voltage':
          latestBattV = value;
          document.getElementById('battery-voltage').innerText = value.toFixed(2);
          document.getElementById('battery-voltage-status').innerText = value > 12 ? 'Stable' : 'Low';
          document.getElementById('battery-voltage-text').innerText = value > 12 ? 'within normal range' : 'low';
          break;

        case 'battery/current':
          latestBattI = value;
          document.getElementById('battery-current').innerText = Math.abs(value).toFixed(2);
          document.getElementById('battery-current-status').innerText = Math.abs(value) < 10 ? 'Normal' : 'High';
          document.getElementById('battery-current-text').innerText = Math.abs(value) < 10 ? 'within safe limits' : 'overcurrent!';
          break;

        case 'battery/power':
          document.getElementById('battery-power').innerText = value.toFixed(1);
          document.getElementById('battery-power-status').innerText = '--';
          document.getElementById('battery-power-text').innerText = '--';
          break;

        case 'battery/soc':
          document.getElementById('battery-soc').innerText = value.toFixed(0);
          if (value > 75) {
            document.getElementById('battery-status').innerText = 'Good';
            document.getElementById('battery-text').innerText = 'optimal range';
            document.getElementById('battery-fill').setAttribute('width', '18');
          } else if (value > 50) {
            document.getElementById('battery-status').innerText = 'Moderate';
            document.getElementById('battery-text').innerText = 'acceptable range';
            document.getElementById('battery-fill').setAttribute('width', '12');
          } else {
            document.getElementById('battery-status').innerText = 'Low';
            document.getElementById('battery-text').innerText = 'needs charging';
            document.getElementById('battery-fill').setAttribute('width', '6');
          }
          break;

          // -------- Temperature --------
        case 'system/temperature':
          latestTemperature = value;
          document.getElementById('temperature').innerText = value.toFixed(1);
          if (value < 40) {
            document.getElementById('temperature-status').innerText = 'Normal';
            document.getElementById('temperature-text').innerText = 'within safe operating levels';
          } else {
            document.getElementById('temperature-status').innerText = 'High';
            document.getElementById('temperature-text').innerText = 'temperature too high!';
          }
          break;
      }
    });


    const darkModeToggle = document.getElementById('darkModeToggle');
    const darkModeIcon = document.getElementById('darkModeIcon');

    // Check if dark mode was previously enabled
    if (localStorage.getItem('darkMode') === 'enabled') {
      document.body.classList.add('dark-mode');
      darkModeIcon.classList.remove('ti-moon');
      darkModeIcon.classList.add('ti-sun');
    }

    darkModeToggle.addEventListener('click', (e) => {
      e.preventDefault();
      document.body.classList.toggle('dark-mode');

      if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('darkMode', 'enabled');
        darkModeIcon.classList.remove('ti-moon');
        darkModeIcon.classList.add('ti-sun');
      } else {
        localStorage.setItem('darkMode', 'disabled');
        darkModeIcon.classList.remove('ti-sun');
        darkModeIcon.classList.add('ti-moon');
      }
    });
  </script>




  <script>
    layout_change('light');
  </script>




  <script>
    change_box_container('false');
  </script>



  <script>
    layout_rtl_change('false');
  </script>


  <script>
    preset_change("preset-1");
  </script>


  <script>
    font_change("Public-Sans");
  </script>



</body>
<!-- [Body] end -->

</html>