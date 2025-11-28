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
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12) !important;
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

    /* @@@@@@@@@@@@@@@@@@@@@@@ Light Mode Styles @@@@@@@@@@@@@@@@@@@@@@@ */

    /* Dropdown menus (light mode) */
    .dropdown-menu {
      background-color: #ffffff;
      border: px solid #dee2e6 !important;
      /* soft gray border */
      box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .1) !important;
      /* subtle shadow */
      border-radius: 0.5rem;
      /* match rounded edges */
    }

    .dropdown-menu a,
    .dropdown-menu .dropdown-item {
      color: #212529 !important;
      /* bootstrap default text */
    }

    .dropdown-menu a:hover,
    .dropdown-menu .dropdown-item:hover {
      background-color: #f1f3f5 !important;
      /* light hover */
      color: #000 !important;
    }

    /* Cards (light mode) */
    .card {
      background-color: #ffffff;
      border: 3px solid #dee2e6 !important;
      /* light gray */
      box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .1) !important;
      /* subtle lift */
      border-radius: 0.75rem;
      /* same rounding as hover cards */
    }

    /* Special: sidebar gif card (light mode) */
    .sidebar-gif-wrapper .card {
      background-color: #E8EBF5 !important;
      border: 3px solid #dee2e6 !important;
      box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .1) !important;
      border-radius: 0.75rem !important;
    }


    /* @@@@@@@@@@@@@@@@@@@@@@@@  Dark Mode Theme  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/

    body.dark-mode {
      background-color: #0E0E23;
    }

    /* PC container keeps its distinct color */
    body.dark-mode .pc-container {
      background-color: #24243E;
    }

    /* Sidebar + Navbar */
    body.dark-mode .pc-header {
      background-color: #0E0E23;
      color: #FFFFFF !important;
      box-shadow: none !important;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.6) !important;
    }

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
      box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .6) !important;
      border: 3px solid #2f2f4a !important;
    }

    body.dark-mode .dropdown-menu a,
    body.dark-mode .dropdown-menu .dropdown-item {
      color: #FFFFFF !important;
    }

    body.dark-mode .dropdown-menu a:hover,
    body.dark-mode .dropdown-menu .dropdown-item:hover {
      background-color: #33334D !important;
      /* darker hover shade */
      color: #e4e6eb !important;
      /* soft readable text */
    }


    /* Cards - strictly #0E0E23 */
    body.dark-mode .card {
      background-color: #0E0E23;
      border: none !important;
      box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .6) !important;
      border: 3px solid #2f2f4a !important;
    }

    /* Special: GIF card should be #24243E */
    body.dark-mode .sidebar-gif-wrapper .card {
      background-color: #24243E !important;
      box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .6) !important;
      border: 3px solid #2f2f4a !important;
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

    body.dark-mode .pc-header .pc-head-link,
    body.dark-mode .pc-header .pc-head-link:hover {
      color: #24243E !important;
      transition: background-color 0.3s ease;
      /* smooth hover effect */
    }

    /* Light mode (default) */
    .user-fullname-title {
      color: #000 !important;
      /* black */
    }

    /* Dark mode */
    body.dark-mode .user-fullname-title {
      color: #fff !important;
      /* white */
    }


    body.dark-mode h6.user-fullname {
      color: white !important;
    }

    /* Default (light mode) fullname color */
    .user-fullname {
      color: #000 !important;
    }

    /* Dark mode default (not hovered) */
    body.dark-mode .pc-head-link .user-fullname {
      color: #fff !important;
    }

    /* Dark mode on hover */
    body.dark-mode .pc-head-link:hover .user-fullname {
      color: #000 !important;
    }


    /* Notification Bell Container */
    .pc-h-item.notification {
      position: relative;
    }

    /* Bell icon */
    #notificationButton {
      padding: 20px 21px;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    #notificationButton i {
      font-size: 1.8rem;
    }

    /* Notification badge */
    #notificationBadge {
      position: absolute;
      top: 1px;
      right: 1px;
      background-color: #dc3545;
      /* red */
      color: white;
      font-size: 0.7rem;
      font-weight: 600;
      border-radius: 50%;
      width: 18px;
      height: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 0 4px rgba(0, 0, 0, 0.3);
    }


    /* ////////////   NOTIF DROP DOWN STYLE  //////////////*/

    /* Notification Dropdown Container */
    .notification-dropdown {
      position: absolute;
      top: 60px;
      right: 0;
      width: 320px;
      background-color: #ffffff;
      /* Light mode background */
      color: #212529;
      border-radius: 0.5rem;
      border: 3px solid #dee2e6;
      /* match your card/dropdown borders */
      box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .1);
      overflow: hidden;
      display: none;
      flex-direction: column;
      z-index: 1000;
      transition: all 0.3s ease;
    }

    /* Show when active (JS can toggle this later) */
    .notification-dropdown.active {
      display: flex;
    }

    /* Header and Footer */
    .notification-dropdown .dropdown-header {
      font-weight: 600;
      padding: 12px 16px;
      border-bottom: 1px solid rgba(0, 0, 0, 0.08);
      background-color: rgba(232, 235, 245, 0.6);
      /* matches your light theme tone */
    }

    .notification-dropdown .dropdown-footer {
      text-align: center;
      padding: 10px;
      border-top: 1px solid rgba(0, 0, 0, 0.08);
      background-color: rgba(232, 235, 245, 0.6);
    }

    .notification-dropdown .dropdown-footer a {
      color: #007bff;
      font-size: 0.9rem;
      text-decoration: none;
      transition: color 0.2s ease;
    }

    .notification-dropdown .dropdown-footer a:hover {
      color: #0056b3;
    }

    /* Notification list */
    .notification-list {
      max-height: 300px;
      /* fits ~5 notifications */
      overflow-y: auto;
    }

    /* Hide scrollbar */
    .notification-list::-webkit-scrollbar {
      width: 0;
      background: transparent;
    }

    .notification-list {
      -ms-overflow-style: none;
      /* IE/Edge */
      scrollbar-width: none;
      /* Firefox */
    }

    /* Notification item */
    .notification-item {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      padding: 10px 14px;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      transition: background 0.25s ease;
    }

    .notification-item:hover {
      background: rgba(0, 0, 0, 0.05);
    }

    .notification-item i {
      font-size: 1.2rem;
      flex-shrink: 0;
      color: #ffb300;
      /* consistent with warning tone */
    }

    .notification-content {
      flex: 1;
    }

    .notification-title {
      display: block;
      font-size: 0.9rem;
      font-weight: 600;
      color: var(--text-color, #222);
    }

    .notification-time {
      font-size: 0.78rem;
      color: #888;
    }

    .mark-read-disabled {
      background: #b6d4fe !important;
      /* lighter blue */
      color: #fff !important;
      cursor: not-allowed !important;
      opacity: 0.6;
      pointer-events: none;
    }

    .clear-all-disabled {
      background: #f5a6a6 !important;
      /* lighter red */
      color: #fff !important;
      cursor: not-allowed !important;
      opacity: 0.6;
      pointer-events: none;
    }


    /* Dark mode support */
    body.dark-mode .notification-dropdown {
      background-color: rgba(36, 36, 62, 0.96);
      /* match dark dropdown w/ soft opacity */
      color: #f0f0f0;
      border: 3px solid #2f2f4a;
      box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .6);
    }

    body.dark-mode .notification-dropdown .dropdown-header,
    body.dark-mode .notification-dropdown .dropdown-footer {
      background-color: rgba(14, 14, 35, 0.6);
      border-color: rgba(255, 255, 255, 0.05);
    }

    body.dark-mode .notification-item {
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    body.dark-mode .notification-item:hover {
      background: rgba(255, 255, 255, 0.05);
    }

    body.dark-mode .notification-title {
      color: #f5f5f5;
    }

    body.dark-mode .notification-time {
      color: #aaa;
    }

    body.dark-mode .notification-dropdown .dropdown-footer a {
      color: #66b0ff;
    }

    body.dark-mode .notification-dropdown .dropdown-footer a:hover {
      color: #99ccff;
    }


    /* Role switch container */
    .role-toggle-wrapper {
      position: relative;
      display: inline-block;
      width: 90px;
      height: 35px;
    }

    /* Hide default checkbox */
    .role-toggle-wrapper .role-switch {
      opacity: 0;
      width: 0;
      height: 0;
    }

    /* The slider */
    .role-label {
      position: absolute;
      cursor: pointer;
      background-color: #ccc;
      border-radius: 20px;
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 10px;
      font-size: 0.9rem;
      font-weight: 600;
      transition: background-color 0.3s;
    }

    /* Text inside switch */
    .switch-text-off {
      color: #fff;
    }

    .switch-text-on {
      color: #fff;
      opacity: 0;
      transition: opacity 0.3s;
    }

    /* Circle slider */
    .role-label::before {
      content: "";
      position: absolute;
      left: 2px;
      top: 2px;
      width: 30px;
      height: 30px;
      background-color: #fff;
      border-radius: 50%;
      transition: transform 0.3s;
      z-index: 2;
    }

    /* Checked state */
    .role-switch:checked+.role-label {
      background-color: #4CAF50;
    }

    .role-switch:checked+.role-label::before {
      transform: translateX(55px);
    }

    .role-switch:checked+.role-label .switch-text-on {
      opacity: 1;
    }

    .role-switch:checked+.role-label .switch-text-off {
      opacity: 0;
    }

    /* Dark mode adjustments */
    body.dark-mode .role-label {
      background-color: #555;
    }

    body.dark-mode .role-switch:checked+.role-label {
      background-color: #28a745;
    }

    /* Table light mode (default) */
    table.table {
      color: #212529;
      /* default dark text */
      background-color: #ffffff;
    }

    table.table th,
    table.table td {
      vertical-align: middle;
    }

    table.table thead {
      background-color: #f8f9fa;
      /* light gray header */
      color: #212529;
    }

    /* Table hover row effect */
    table.table-hover tbody tr:hover {
      background-color: #f1f3f5;
    }

    /* Role dropdown in table */
    .role-select {
      min-width: 100px;
    }

    /* Delete button in table */
    .delete-account {
      display: inline-flex;
      align-items: center;
      gap: 4px;
    }

    /* ====================================== */
    /* Dark mode for table */
    body.dark-mode table.table {
      color: #ffffff;
      background-color: #24243E;
      /* match pc-container dark bg */
      border-color: #2f2f4a;
    }

    body.dark-mode table.table thead {
      background-color: #3B3B7A !important;
      /* semicolon added */
      color: #ffffff !important;
      /* force text color */
    }



    body.dark-mode table.table tbody tr {
      background-color: #24243E;
      color: #ffffff;
      border-bottom: 1px solid #2f2f4a;
    }

    body.dark-mode table.table tbody tr:hover {
      background-color: #2f2f4a;
      /* subtle hover effect */
    }

    body.dark-mode .role-select {
      background-color: #0E0E23;
      color: #ffffff;
      border: 1px solid #2f2f4a;
    }

    body.dark-mode .role-select option {
      background-color: #0E0E23;
      color: #ffffff;
    }

    /* Delete button dark mode */
    body.dark-mode .delete-account {
      color: #ffffff;
      background-color: #dc3545;
      /* keep red */
      border-color: #b52a38;
    }

    body.dark-mode .delete-account:hover {
      background-color: #b52a38;
      border-color: #92212d;
    }


    /* /////////////////// PISTI KA LISOD KAYKA /////////////////// */
    /* If your theme uses pseudo-element overlays, hide them */
    /* body.dark-mode .pc-header .pc-head-link::before,
body.dark-mode .pc-header .pc-head-link::after {
  content: none !important;
  color: inherit !important;
  opacity: 1 !important; 
  filter: none !important;
} */
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
            <a href="../dashboard/controlLoad.php" class="pc-link">
              <span class="pc-micon"><i class="ti ti-power"></i></span>
              <span class="pc-mtext">Control Load</span>
            </a>
          </li>

          <li class="pc-item">
            <a href="../dashboard/manageAccounts.php" class="pc-link">
              <span class="pc-micon"><i class="ti ti-settings"></i></span>
              <span class="pc-mtext">Manage Accounts</span>
            </a>
          </li>

          <li class="pc-item sidebar-gif-wrapper">
            <div class="card" style="width:220px; border-radius:0.75rem !important; overflow:hidden !important; 
           box-shadow:0 .25rem .5rem rgba(0,0,0,.15); text-align:center !important; 
           margin-bottom:50px !important;">
              <div class="card-body p-2">
                <img src="../../images/Solar Panel GIF.gif" alt="Sidebar GIF" style="width:100% !important; height:auto !important; border-radius:0.5rem !important; 
               display:block !important; margin:0 auto !important;">
                <h6 style="margin-top:0.5rem !important; font-size:18px !important; font-weight:600 !important">
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

          <!-- Notification Bell Button -->
          <li class="pc-h-item notification" style="position: relative;">
            <a href="#" class="pc-head-link ms-0" id="notificationButton" title="Notifications"
              style="padding: 20px 21px; display: flex; align-items: center; justify-content: center;">
              <i class="ti ti-bell" style="font-size: 1.8rem;"></i>
              <span id="notificationBadge" style="position:absolute; top:1px; right:1px; background:#dc3545; color:white; 
                            font-size:0.7rem; font-weight:600; border-radius:50%; width:18px; height:18px;
                            display:flex; align-items:center; justify-content:center; box-shadow:0 0 4px rgba(0,0,0,0.3); display:none;">
              </span>
            </a>

            <!-- Dropdown -->
            <div class="notification-dropdown" id="notificationDropdown" style="display: none;">
              <div class="dropdown-header"
                style="display:flex; justify-content:space-between; align-items:center; padding:8px 12px;">

                <span style="font-weight:600;">Notifications</span>

                <!-- BUTTONS -->
                <div style="display:flex; gap:8px;">
                  <button id="markAllReadBtn"
                    style="
                    background:#0d6efd;
                    color:white;
                    border:none;
                    padding:4px 10px;
                    border-radius:4px;
                    font-size:0.7rem;
                    cursor:pointer;
                ">
                    Mark all as read
                  </button>

                  <button id="clearAllBtn"
                    style="
                    background:#dc3545;
                    color:white;
                    border:none;
                    padding:4px 10px;
                    border-radius:4px;
                    font-size:0.7rem;
                    cursor:pointer;
                ">
                    Clear all
                  </button>
                </div>
              </div>

              <div class="notification-list" id="notificationList"></div>
            </div>

          </li>


          <!-- User Profile Dropdown -->
          <li class="dropdown pc-h-item">
            <a class="pc-head-link dropdown-toggle d-flex align-items-center"
              style="padding: 20px 16px; gap:12px; min-width: 280px; cursor:pointer;"
              data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true"
              data-bs-auto-close="outside" aria-expanded="false">

              <!-- Avatar -->
              <img src="<?php echo htmlspecialchars(isset($user['profile_image']) && $user['profile_image'] != '' ? '../' . $user['profile_image'] : '/Smart Solar/dist/assets/images/user/avatar-1.jpg'); ?>"
                alt="Profile Picture"
                style="width:40px; height:40px; object-fit:cover; border-radius:50%; flex-shrink:0; display:block;">
              <!-- Full Name -->
              <span class="user-fullname"
                style="font-weight:600; font-size:16px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
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
                  <h6 class="user-fullname"><?php echo htmlspecialchars($fullName); ?></h6>
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
  <main class="pc-container" style="padding: 20px; min-height: 85vh; color: #000;" data-dark-color="#fff">
    <div class="container-fluid">

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0" style="color: inherit;">Manage Accounts</h3>
      </div>

      <div class="card card-hover">
        <div class="card-body p-3">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" style="color: inherit;">
              <thead class="table-light" style="color: inherit;">
                <tr>
                  <th style="text-align:center">ID</th>
                  <th style="text-align:center">Full Name</th>
                  <th style="text-align:center">Email</th>
                  <th style="text-align:center">Role</th>
                  <th style="text-align:center">Contact Number</th>
                  <th style="text-align:center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                require_once "config.php";

                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $role = $row['role'];
                    echo "<tr style='color: inherit;'>";
                    echo "<td style='color: inherit; text-align:center'>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td style='color: inherit; text-align:center'>" . htmlspecialchars($row['full_name']) . "</td>";
                    echo "<td style='color: inherit; text-align:center'>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td style='align-item:center'>
                              <select class='form-select role-select' data-id='" . $row['id'] . "' style='color: inherit; background-color: inherit;'>
                                <option value='staff' " . ($role === 'staff' ? 'selected' : '') . ">Staff</option>
                                <option value='admin' " . ($role === 'admin' ? 'selected' : '') . ">Admin</option>
                              </select>
                            </td>";
                    echo "<td style='color: inherit; text-align:center'>" . htmlspecialchars($row['contact_number']) . "</td>";
                    echo "<td style='text-align:center'>
                              <button class='btn btn-danger btn-sm delete-account' data-id='" . $row['id'] . "' style='color: #fff;'>
                                <i class='ti ti-trash'></i> Delete
                              </button>
                            </td>";
                    echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='6' class='text-center' style='color: inherit;'>No accounts found.</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </main>
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


    document.addEventListener('DOMContentLoaded', function() {
      const bellBtn = document.getElementById('notificationButton');
      const dropdown = document.getElementById('notificationDropdown');
      const list = document.getElementById('notificationList');
      const badge = document.getElementById('notificationBadge');
      const markBtn = document.getElementById("markAllReadBtn");
      const clearBtn = document.getElementById("clearAllBtn");

      const readNotifications = new Set();

      // ----------------------------
      // Fetch notifications
      // ----------------------------
      function fetchNotifications() {
        fetch('fetch_notifications.php')
          .then(res => res.json())
          .then(data => {
            if (!data.success) return;

            const notifications = data.notifications;
            let unreadCount = 0;
            list.innerHTML = '';

            if (notifications.length === 0) {
              list.innerHTML = '<div class="text-center p-3 text-muted">No notifications</div>';
            } else {
              notifications.forEach(n => {
                const isRead = n.is_read == 1 || readNotifications.has(n.user_notification_id);
                if (!isRead) unreadCount++;

                const style = isRead ? 'opacity:0.7;' : '';
                list.innerHTML += `
                            <div class="notification-item" style="cursor:pointer; ${style}" data-id="${n.user_notification_id}">
                                <i class="${n.icon || 'ti ti-bell'}"></i>
                                <div class="notification-content">
                                    <span class="notification-title">${n.message}</span>
                                    <span class="notification-time">${formatTime(n.time_stamp)}</span>
                                </div>
                            </div>
                        `;
              });
            }

            // Update badge
            badge.textContent = unreadCount;
            badge.style.display = unreadCount > 0 ? 'flex' : 'none';

            // Update buttons
            updateMarkAllButton(unreadCount);
            updateClearAllButton(notifications.length);
          })
          .catch(err => console.error('Error fetching notifications:', err));
      }

      // ----------------------------
      // Mark individual notification as read
      // ----------------------------
      function markAsRead(userNotificationId, itemElement = null) {
        fetch('mark_as_read.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'user_notification_id=' + encodeURIComponent(userNotificationId)
          })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              readNotifications.add(userNotificationId);
              if (itemElement) itemElement.style.opacity = 0.7;

              let count = parseInt(badge.textContent || '0');
              if (count > 0) count--;
              badge.textContent = count;
              badge.style.display = count > 0 ? 'flex' : 'none';

              updateMarkAllButton(count);
            } else {
              console.error('Failed to mark as read:', data.error);
            }
          })
          .catch(err => console.error(err));
      }

      function formatTime(dateString) {
        const date = new Date(dateString);
        if (isNaN(date)) return '';
        return date.toLocaleString('en-PH', {
          hour12: true
        });
      }

      // ----------------------------
      // Toggle dropdown
      // ----------------------------
      bellBtn.addEventListener('click', (e) => {
        e.preventDefault();
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
      });

      // ----------------------------
      // Event delegation for individual notification clicks
      // ----------------------------
      list.addEventListener('click', function(e) {
        const item = e.target.closest('.notification-item');
        if (!item) return;

        const id = item.dataset.id;
        markAsRead(id, item);
      });

      // ----------------------------
      // Mark All as Read
      // ----------------------------
      markBtn.addEventListener("click", () => {
        if (markBtn.classList.contains("mark-read-disabled")) return;

        Swal.fire({
          title: 'Mark all notifications as read?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Yes, mark all',
          cancelButtonText: 'Cancel',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            fetch("mark_all_read.php", {
                method: "POST"
              })
              .then(res => res.json())
              .then(data => {
                if (data.status === "success") {
                  document.querySelectorAll(".notification-item").forEach(item => item.classList.add("read"));
                  badge.style.display = "none";
                  badge.textContent = "0";
                  updateMarkAllButton(0);

                  Swal.fire('Marked!', 'All notifications are marked as read.', 'success');
                } else {
                  Swal.fire('Error', data.message, 'error');
                }
              });
          }
        });
      });

      function updateMarkAllButton(unreadCount) {
        if (unreadCount === 0) {
          markBtn.classList.add("mark-read-disabled");
        } else {
          markBtn.classList.remove("mark-read-disabled");
        }
      }

      // ----------------------------
      // Clear All Notifications
      // ----------------------------
      clearBtn.addEventListener("click", () => {
        if (clearBtn.classList.contains("clear-all-disabled")) return;

        Swal.fire({
          title: 'Clear all notifications?',
          text: "This action cannot be undone!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, clear all',
          cancelButtonText: 'Cancel',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            fetch("clear_all_notifications.php", {
                method: "POST"
              })
              .then(res => res.json())
              .then(data => {
                if (data.status === "success") {
                  list.innerHTML = '<div class="text-center p-3 text-muted">No notifications</div>';
                  badge.style.display = "none";
                  badge.textContent = "0";

                  updateMarkAllButton(0);
                  updateClearAllButton(0);

                  Swal.fire('Cleared!', 'All notifications have been cleared.', 'success');
                } else {
                  Swal.fire('Error', data.message, 'error');
                }
              });
          }
        });
      });

      function updateClearAllButton(notificationsCount) {
        if (notificationsCount === 0) {
          clearBtn.classList.add("clear-all-disabled");
        } else {
          clearBtn.classList.remove("clear-all-disabled");
        }
      }

      // ----------------------------
      // Initial fetch + auto-refresh
      // ----------------------------
      fetchNotifications();
      setInterval(fetchNotifications, 5000);
    });

    // Event delegation for role updates
    document.querySelector('tbody').addEventListener('change', function(e) {
      if (e.target && e.target.classList.contains('role-select')) {
        const select = e.target;
        const userId = select.dataset.id;
        const newRole = select.value;

        fetch('update_role.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${encodeURIComponent(userId)}&role=${encodeURIComponent(newRole)}`
          })
          .then(res => res.json())
          .then(data => {
            if (!data.success) alert('Failed to update role.');
          })
          .catch(err => {
            console.error(err);
            alert('Error updating role.');
          });
      }
    });

    // Event delegation for delete buttons
    document.querySelector('tbody').addEventListener('click', function(e) {
      if (e.target && (e.target.classList.contains('delete-account') || e.target.closest('.delete-account'))) {
        const btn = e.target.closest('.delete-account');
        const userId = btn.dataset.id;

        if (confirm('Are you sure you want to delete this account?')) {
          fetch('delete_account.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
              },
              body: `id=${encodeURIComponent(userId)}`
            })
            .then(res => res.json())
            .then(data => {
              if (data.success) {
                btn.closest('tr').remove();
              } else {
                alert('Failed to delete account.');
              }
            })
            .catch(err => {
              console.error(err);
              alert('Error deleting account.');
            });
        }
      }
    });


    function updateFontColors() {
      const isDark = document.body.classList.contains('dark-mode');
      const mainContent = document.querySelector('main.pc-container');
      const color = isDark ? '#ffffff' : '#000000';

      mainContent.style.setProperty('color', color, 'important');

      mainContent.querySelectorAll('*').forEach(el => {
        if (
          el.tagName !== 'OPTION' &&
          el.tagName !== 'TH' &&
          el.closest('thead') === null
        ) {
          el.style.setProperty('color', color, 'important');
        }
      });

      const theads = mainContent.querySelectorAll('thead');
      const ths = mainContent.querySelectorAll('thead th');

      theads.forEach(thead => {
        if (isDark) {
          thead.style.setProperty('background-color', '#1e2f5a', 'important');
        } else {
          thead.style.backgroundColor = '';
        }
      });

      ths.forEach(th => {
        if (isDark) {
          th.style.setProperty('color', '#ffffff', 'important');
          th.style.setProperty('background-color', '#1e2f5a', 'important');
        } else {
          th.style.color = '';
          th.style.backgroundColor = '';
        }
      });


      mainContent.querySelectorAll('select.role-select').forEach(sel => {
        sel.style.setProperty('color', color, 'important');
        sel.style.setProperty('background-color', isDark ? '#0E0E23' : '#ffffff', 'important');
        sel.querySelectorAll('option').forEach(opt => {
          opt.style.color = color;
          opt.style.backgroundColor = isDark ? '#0E0E23' : '#ffffff';
        });
      });
    }



    // Run on page load
    updateFontColors();

    // Optional: if you toggle dark mode dynamically, listen for it
    const observer = new MutationObserver(updateFontColors);
    observer.observe(document.body, {
      attributes: true,
      attributeFilter: ['class']
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