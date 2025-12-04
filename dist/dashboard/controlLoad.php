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
            background-color: #E8EBF5;
            /* light gray background */
        }

        .pc-header {
            height: 70px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12) !important;
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
            border: 1px solid #dee2e6 !important;
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
            box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .1) !important;
            border-radius: 0.75rem;
        }

        /* Special: sidebar gif card (light mode) */
        .sidebar-gif-wrapper .card {
            background-color: #E8EBF5 !important;
            border: 3px solid #dee2e6 !important;
            box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .1) !important;
            border-radius: 0.75rem !important;
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
        body.dark-mode .pc-header {
            background-color: #0E0E23;
            color: #FFFFFF !important;
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
            background-color: #33334d !important;
            color: #FFFFFF !important;
        }

        /* Cards - strictly #0E0E23 */
        /* Cards - strictly #0E0E23 */
        body.dark-mode .card {
            background-color: #0E0E23;
            border: none !important;
            box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .6) !important;
            border: 3px solid #2f2f4a !important;
        }

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

        .battery {
            --percent: 1;
            display: block;
            margin: 0 auto 1.5em auto;
            width: 10em;
            height: 10em;
        }

        .battery__bottom {
            transform: rotate(calc(330deg * var(--percent))) translate(0, -50px);
            transition: transform 0.5s ease-in-out;
        }

        .battery__fill1,
        .battery__fill2,
        .battery__fill3 {
            transition: stroke 0.5s ease-in-out, stroke-dashoffset 0.5s ease-in-out;
        }

        .battery__fill1 {
            stroke-dashoffset: calc(20.944px + 230.383px * (1 - var(--percent)));
        }

        .battery__fill2 {
            stroke-dashoffset: calc(16.755px + 184.307px * (1 - var(--percent)));
        }

        .battery__fill3 {
            stroke-dashoffset: calc(23.038px + 253.422px * (1 - var(--percent)));
        }

        .battery__plus,
        .battery__minus {
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
        }

        .battery__minus {
            transform: rotate(calc(330deg * var(--percent))) translate(0, -44px);
        }

        .battery--fullgreen .battery__fill1 {
            stroke: hsl(123, 90%, 45%);
        }

        .battery--lightgreen .battery__fill1 {
            stroke: hsl(96, 90%, 45%);
        }

        .battery--yellow .battery__fill1 {
            stroke: hsl(58, 90%, 45%);
        }

        .battery--orange .battery__fill1 {
            stroke: hsl(30, 90%, 45%);
        }

        .battery--critical .battery__fill1 {
            stroke: hsl(3, 90%, 45%);
        }

        .battery--hide-symbols .battery__plus,
        .battery--hide-symbols .battery__minus {
            opacity: 0;
        }




        /* Override Bootstrap form-range track */
        #batteryThreshold {
            width: 100%;
            height: 15px;
            border-radius: 10px;
            outline: none;
            background: #d3d3d3;
            /* fallback */
            transition: background 0.2s ease;
        }

        /* Chrome/Safari */
        #batteryThreshold::-webkit-slider-runnable-track {
            height: 15px;
            border-radius: 10px;
            background: transparent;
            /* background applied to input instead */
        }

        /* Thumb */
        #batteryThreshold::-webkit-slider-thumb {
            appearance: none;
            width: 25px;
            height: 25px;
            background: #4A90E2;
            /* professional blue */
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid #2C3E50;
            /* slightly darker for contrast */
            margin-top: -5px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        /* Cards in dark mode - with border + shadow */
        body.dark-mode .card {
            background-color: #0E0E23 !important;
            border: 3px solid #2f2f4a !important;
            box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .6) !important;
            color: #FFFFFF !important;
        }

        /* Special: Sidebar GIF card */
        body.dark-mode .sidebar-gif-wrapper .card {
            background-color: #24243E !important;
            border: 3px solid #2f2f4a !important;
            box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .6) !important;
            color: #FFFFFF !important;
        }

        .pc-container {
            min-height: 100vh;
        }

        /* Full name text inside dark mode */
        body.dark-mode h6.user-fullname {
            color: white !important;
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
    </style>


</head>
<!-- [Head] end -->



<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ---------------------------------------------
// DETERMINE USER STATE
// ---------------------------------------------
if (!isset($_SESSION['user_id'])) {
    showAccessDenied("You must log in to access this page.", "authentication.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch user info
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    showAccessDenied("User not found.", "authentication.php");
    exit();
}

$user = $result->fetch_assoc();

// ---------------- STORE INFO VARIABLES ----------------
$fullName     = $user['full_name'];
$email        = $user['email'];
$phone        = $user['contact_number'];
$dob          = $user['date_of_birth'];
$address      = $user['address'];
$role         = $user['role'];
$profilePhoto = $user['profile_image'] ?? '../assets/images/user/avatar-2.jpg';

$_SESSION['email'] = $email;

// ---------------------------------------------
// ADMIN ROLE VALIDATION
// ---------------------------------------------
if ($role !== 'admin') {
    showAccessDenied("You are logged in, but you do not have permission to access this admin page.", "staffDashboard.php");
    exit();
}

// ------------------ ACCESS DENIED FUNCTION ------------------
function showAccessDenied($message, $redirect)
{
?>



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Access Restricted</title>
        <link rel="stylesheet" href="access_denied.css">
    </head>

    <body>
        <div class="glass-card">
            <img src="../../images/LogoNoBG.png" class="logo" alt="Logo">
            <div class="lock-emoji">🔒</div>
            <h1>Access Denied</h1>
            <p><?= $message ?></p>
            <p class="redirect-msg">Redirecting in <span id="countdown" data-redirect="<?= $redirect ?>">10</span> seconds...</p>
            <a href="<?= $redirect ?>" class="btn-modern">Go Now</a>
        </div>

        <script src="countdown.js"></script>
    </body>

    </html>
<?php
}
?>



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
                        <a href="../dashboard/dataLogs.php" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-file-text"></i></span>
                            <span class="pc-mtext">Data Logs</span>
                        </a>
                    </li>

                    <li class="pc-item">
                        <a href="../dashboard/manageAccounts.php" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-settings"></i></span>
                            <span class="pc-mtext">Manage Accounts</span>
                        </a>
                    </li>


                    <li class="pc-item sidebar-gif-wrapper">
                        <div class="card"
                            style="margin-bottom: 50px; width: 220px; border-radius: 0.75rem; overflow: hidden; box-shadow: 0 .25rem .5rem rgba(0,0,0,.15); text-align:center;">
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
    <div class="pc-container">
        <div class="pc-content" style="padding: 22px 35px 32px">

            <div class="row g-3 mt-1">

                <!-- Left Column -->
                <div class="col-12 col-lg-8 d-flex flex-column">

                    <!-- Load Control Card (Full Width) -->
                    <div class="card card-hover shadow-lg text-center" style="margin-bottom: 15px !important">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-2">Load Control</h4>
                            <p class="text-muted small mb-3">Manually switch the load ON or OFF.</p>
                            <div class="form-check form-switch d-flex justify-content-center align-items-center"
                                style="gap: 10px;">
                                <input class="form-check-input" type="checkbox" id="loadSwitch"
                                    style="width: 60px; height: 34px;">
                                <label class="form-check-label fs-5" for="loadSwitch">Load</label>
                            </div>
                        </div>
                    </div>


                    <!-- Bottom row: Battery Status + Chart -->
                    <div class="row g-3">

                        <?php
                        // Database connection
                        $conn = new mysqli("localhost", "root", "", "smart_solar");
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Fetch the current battery threshold
                        $sql = "SELECT value FROM battery_threshold WHERE threshold_name = 'MainBattery' LIMIT 1";
                        $result = $conn->query($sql);
                        $thresholdValue = 100; // default

                        if ($result && $row = $result->fetch_assoc()) {
                            $thresholdValue = $row['value'];
                        }
                        ?>


                        <!-- Battery Status Card -->
                        <div class="col-12 col-md-6">
                            <div class="card card-hover shadow-lg h-100">
                                <div class="card-body p-4">
                                    <h4 class="fw-bold mb-2">Battery Status</h4>
                                    <p class="text-muted small mb-4">
                                        Set the battery % threshold to automatically turn off the load if it drops below
                                        this level.
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div style="flex-shrink: 0;">
                                            <svg class="battery" viewBox="0 0 100 100" width="140px" height="140px">
                                                <g fill="none" transform="rotate(-75,50,50)">
                                                    <circle r="40" cx="50" cy="50" stroke="hsla(223,10%,50%,0.2)"
                                                        stroke-width="20" stroke-dasharray="251.33 251.33"
                                                        stroke-dashoffset="20.944" />
                                                    <circle class="battery__fill1" r="40" cx="50" cy="50"
                                                        stroke="hsl(123,90%,45%)" stroke-width="20"
                                                        stroke-dasharray="251.33 251.33" stroke-dashoffset="20.944" />
                                                </g>
                                                <text class="battery__value" font-size="16" fill="currentColor" x="50"
                                                    y="56" text-anchor="middle" data-value>100%</text>
                                            </svg>
                                        </div>
                                        <div class="text-end" style="flex-shrink: 0;">
                                            <h6 class="mb-1">Current Threshold</h6>
                                            <span id="batteryThresholdValueDisplay" class="fw-bold fs-2"><?php echo $thresholdValue; ?>%</span>
                                        </div>
                                    </div>
                                    <input type="range" class="form-range mb-3" min="0" max="100" value="<?php echo $thresholdValue; ?>" id="batteryThreshold">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span>0%</span>
                                        <span id="batteryThresholdValue"><?php echo $thresholdValue; ?>%</span>
                                    </div>
                                    <div class="text-end">
                                        <button id="applyThresholdBtn" class="btn btn-success btn-lg shadow-sm">Apply
                                            Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Load Card -->
                        <div class="col-12 col-md-6">
                            <div class="card card-hover shadow-lg text-center h-100">
                                <div class="card-body px-5">
                                    <h4 class="fw-bold mb-2">Today's Peak Hours</h4>
                                    <p class="text-muted small mb-4">
                                        Load usage by hour for today. Peak hours are highlighted.
                                    </p>

                                    <canvas id="todayLoadChart" style="width:100%; height:300px;"></canvas>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>


                <!-- Right Column: Load Overview + Chart Cards -->
                <div class="col-12 col-lg-4">

                    <!-- Load Overview Card -->
                    <div class="card card-hover shadow-lg mb-3" style="height: 225px;">
                        <div class="card-body p-2 d-flex flex-column justify-content-start align-items-center">

                            <!-- Plug Emoji as Icon (bigger) -->
                            <div class="mb-2" style="font-size: 3rem;">🔌</div>

                            <h6 class="fw-bold mb-2 text-center">Load Overview</h6>

                            <div class="row w-100 text-start">

                                <!-- Left Column -->
                                <div class="col-6">
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-1"><span style="color:#4CAF50;">●</span> Load Status:
                                            <span id="loadStatus">ON</span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Right Column -->
                                <div class="col-6">
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-1"><span style="color:#2196F3;">●</span> Auto Shutdown:
                                            <span id="autoShutdownDisplay"><?php echo $thresholdValue; ?>%</span>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>



                    <!-- Cumulative Energy Consumed Today Card -->
                    <div class="card card-hover shadow-lg mb-3" style="height: 265px;">
                        <div class="card-body p-2">
                            <h6 class="fw-bold text-center mb-2">Today's Cumulative Energy Consumed(Wh)</h6>
                            <canvas id="cumulativeEnergyChart" style="height: 100%; width: 100%;"></canvas>
                            <p id="cumulativeEnergyLastUpdate" class="text-center small mb-0"></p>
                        </div>
                    </div>



                    <!-- Battery Charge/Discharge Card -->
                    <div class="card card-hover shadow-lg mb-3" style="height: 265px;">
                        <div class="card-body p-2">
                            <h6 class="fw-bold text-center mb-2">Today's Battery Charge/Discharge (W)</h6>
                            <canvas id="batteryChart" style="height: 100%; width: 100%;"></canvas>
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

    <script src="https://cdn.jsdelivr.net/npm/three@0.160.0/build/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        const batteryThresholdSlider = document.getElementById('batteryThreshold');
        const batteryThresholdValue = document.getElementById('batteryThresholdValue');
        const batteryThresholdDisplay = document.getElementById('batteryThresholdValueDisplay');
        const autoShutdownDisplay = document.getElementById('autoShutdownDisplay');
        const applyThresholdBtn = document.getElementById('applyThresholdBtn');

        const loadSwitch = document.getElementById('loadSwitch');
        const loadStatusDisplay = document.getElementById('loadStatus');

        // -------------------------------
        // Slider Color Function
        // -------------------------------
        function updateSliderColor(value) {
            let color;
            if (value > 80) color = 'hsl(123, 90%, 45%)';
            else if (value > 60) color = 'hsl(96, 90%, 45%)';
            else if (value > 40) color = 'hsl(58, 90%, 45%)';
            else if (value > 20) color = 'hsl(30, 90%, 45%)';
            else color = 'hsl(3, 90%, 45%)';

            batteryThresholdSlider.style.background = `linear-gradient(to right, ${color} 0%, ${color} ${value}%, #d3d3d3 ${value}%, #d3d3d3 100%)`;
        }

        // -------------------------------
        // Initialize Slider Color
        // -------------------------------
        updateSliderColor(batteryThresholdSlider.value);

        // -------------------------------
        // Dynamic Slider Input (Preview Only)
        // -------------------------------
        batteryThresholdSlider.addEventListener('input', () => {
            const val = batteryThresholdSlider.value;
            batteryThresholdValue.innerText = val + '%';
            updateSliderColor(val);
            // Do NOT change batteryThresholdDisplay here
        });

        // -------------------------------
        // Load Switch Event
        // -------------------------------
        loadSwitch.addEventListener('change', () => {
            const status = loadSwitch.checked ? "ON" : "OFF";

            // Publish MQTT
            client.publish('system/load/control', status, {
                qos: 1,
                retain: true
            });
            console.log('Load control sent:', status);

            // Update DB
            fetch('update_load_state.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'state=' + (loadSwitch.checked ? 1 : 0)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // ✅ Update display only on success
                        loadStatusDisplay.innerText = status;

                        // Success SweetAlert
                        Swal.fire({
                            title: 'Success!',
                            text: `Load turned ${status}`,
                            icon: 'success',
                            timer: 1200,
                            showConfirmButton: false
                        });
                    } else {
                        console.error('DB error:', data.error);
                        // Revert toggle if failed
                        loadSwitch.checked = !loadSwitch.checked;
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to update load state. Try again.',
                            icon: 'error'
                        });
                    }
                });
        });

        // -------------------------------
        // Apply Battery Threshold Event
        // -------------------------------
        applyThresholdBtn.addEventListener('click', () => {
            const thresholdValue = batteryThresholdSlider.value;

            Swal.fire({
                title: 'Are you sure?',
                text: `Apply battery threshold of ${thresholdValue}%?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, apply it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    // MQTT publish if needed
                    client.publish('system/battery/threshold', thresholdValue.toString(), {
                        qos: 1,
                        retain: true
                    });
                    console.log('Battery threshold sent:', thresholdValue);

                    // Update DB and live UI
                    fetch('update_threshold.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'value=' + thresholdValue
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                const newValue = data.value;

                                // ✅ Update current threshold display ONLY after successful DB update
                                batteryThresholdDisplay.innerText = newValue + '%';
                                autoShutdownDisplay.innerText = newValue + '%';

                                Swal.fire({
                                    title: 'Applied!',
                                    text: `Battery threshold set to ${newValue}%`,
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                            } else {
                                console.error('DB error:', data.error);
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Failed to apply threshold. Try again.',
                                    icon: 'error'
                                });
                            }
                        });
                }
            });
        });

        // -------------------------------
        // Initial Load from DB
        // -------------------------------
        function loadStateFromDB() {
            fetch('get_load_state.php')
                .then(res => res.json())
                .then(data => {
                    loadSwitch.checked = data.state == 1;
                    loadStatusDisplay.innerText = data.state == 1 ? 'ON' : 'OFF';
                });
        }

        function loadThresholdFromDB() {
            fetch('get_threshold.php')
                .then(res => res.json())
                .then(data => {
                    const val = data.value;
                    batteryThresholdSlider.value = val;
                    batteryThresholdValue.innerText = val + '%';
                    batteryThresholdDisplay.innerText = val + '%';
                    updateSliderColor(val);
                });
        }

        // Initial fetch on page load
        loadStateFromDB();
        loadThresholdFromDB();



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


        window.addEventListener("DOMContentLoaded", () => {
            const batteryMeter = new BatteryMeter(".battery");

            // -----------------------------
            // MQTT WebSocket Connection
            // -----------------------------
            const client = mqtt.connect('ws://broker.hivemq.com:8000/mqtt'); // non-TLS

            client.on('connect', () => {
                console.log('Connected to MQTT broker via WebSocket');

                client.subscribe('battery/soc', (err) => {
                    if (!err) console.log('Subscribed to battery/soc');
                    else console.error('Subscribe error:', err);
                });
            });

            client.on('error', (err) => {
                console.error('MQTT connection error:', err);
            });

            // Update battery meter when MQTT message arrives
            client.on('message', (topic, message) => {
                if (topic === 'battery/soc') {
                    const soc = parseFloat(message.toString()); // value from 0 to 100
                    batteryMeter.adjustHealth(soc / 100); // convert to 0-1 range for BatteryMeter
                }
            });
        });

        class BatteryMeter {
            health = 1;
            constructor(el) {
                this.el = document.querySelector(el);
                this.init();
            }
            get healthReadable() {
                return `${Math.round(this.health * 100)}%`;
            }
            init() {
                this.adjustHealth(this.health);
            }
            adjustHealth(value) {
                this.health = Math.max(Math.min(value, 1), 0);
                this.updateDisplay();
            }
            updateDisplay() {
                this.el.style.setProperty("--percent", this.health);

                const classes = ["battery--fullgreen", "battery--lightgreen", "battery--yellow", "battery--orange", "battery--critical", "battery--hide-symbols"];
                this.el.classList.remove(...classes);

                const valuePercent = this.health * 100;

                if (valuePercent > 80) this.el.classList.add("battery--fullgreen");
                else if (valuePercent > 60) this.el.classList.add("battery--lightgreen");
                else if (valuePercent > 40) this.el.classList.add("battery--yellow");
                else if (valuePercent > 20) this.el.classList.add("battery--orange");
                else this.el.classList.add("battery--critical");

                if (valuePercent <= 5) this.el.classList.add("battery--hide-symbols");

                const valueEl = this.el.querySelector("[data-value]");
                if (valueEl) valueEl.innerHTML = `${Math.round(valuePercent)}%`;
            }
        }


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

        const ctx = document.getElementById('todayLoadChart').getContext('2d');
        let todayLoadChart;

        function formatHour(hour) {
            const ampm = hour >= 12 ? 'PM' : 'AM';
            hour = hour % 12 || 12; // convert 0 → 12, 13 → 1
            return `${hour}:00 ${ampm}`;
        }

        async function fetchTodayLoad() {
            const response = await fetch('load_profile_data.php');
            const data = await response.json();

            // Labels for x-axis
            const labels = Array.from({
                length: 24
            }, (_, i) => formatHour(i));

            // Find the peak load
            const maxLoad = Math.max(...data);

            // Assign colors: red for peak load, blue for others
            const barColors = data.map(value => value === maxLoad ? 'rgba(255,99,132,0.8)' : 'rgba(54,162,235,0.6)');

            if (todayLoadChart) {
                todayLoadChart.data.labels = labels;
                todayLoadChart.data.datasets[0].data = data;
                todayLoadChart.data.datasets[0].backgroundColor = barColors;
                todayLoadChart.update();
            } else {
                todayLoadChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels,
                        datasets: [{
                            label: 'Load (W)',
                            data,
                            backgroundColor: barColors
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true
                            },
                            title: {
                                display: true,
                                text: "Today's Load Profile"
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        }

        // Load chart on page load
        fetchTodayLoad();


        // Cumulative Battery Energy Chart
        fetch('get_cumulative_battery_energy.php')
            .then(res => res.json())
            .then(res => {
                // Convert 24-hour labels to 12-hour
                const formattedLabels = res.labels.map(t => {
                    let [hour, minute] = t.split(':').map(Number);
                    const ampm = hour >= 12 ? 'PM' : 'AM';
                    hour = hour % 12 || 12;
                    return `${hour}:${minute.toString().padStart(2,'0')} ${ampm}`;
                });

                const ctx = document.getElementById('cumulativeEnergyChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: formattedLabels,
                        datasets: [{
                            label: 'Battery Energy Consumed (Wh)',
                            data: res.data,
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Wh'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Time'
                                }
                            }
                        }
                    }
                });
            });


        // Battery Chart
        const batteryCtx = document.getElementById('batteryChart').getContext('2d');

        const batteryChart = new Chart(batteryCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                        label: 'Charge (SOC Increase)',
                        data: [],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                        tension: 0.3
                    },
                    {
                        label: 'Discharge (Battery Power)',
                        data: [],
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: true,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        async function updateBatteryChart() {
            const res = await fetch('get_battery_data.php');
            const data = await res.json();

            // Convert 24-hour time to 12-hour format with AM/PM
            const formattedTime = data.time.map(t => {
                let [hour, minute] = t.split(':').map(Number);
                const ampm = hour >= 12 ? 'PM' : 'AM';
                hour = hour % 12 || 12;
                return `${hour}:${minute.toString().padStart(2, '0')} ${ampm}`;
            });

            batteryChart.data.labels = formattedTime;
            batteryChart.data.datasets[0].data = data.charge;
            batteryChart.data.datasets[1].data = data.discharge;
            batteryChart.update();
        }

        // Initial load
        updateBatteryChart();
        setInterval(updateBatteryChart, 60000);
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