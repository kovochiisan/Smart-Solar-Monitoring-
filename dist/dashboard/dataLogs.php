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

        .btn-fixed-height {
            height: 45px;
            /* adjust the height as needed */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .info-row {
            display: flex;
            gap: 10px;
            flex-wrap: nowrap;
            overflow-x: auto;
            margin-bottom: 20px;
            justify-content: space-between;
            /* distribute boxes evenly */
        }

        .info-card {
            display: flex;
            align-items: center;
            justify-content: start;
            padding: 12px;
            /* slightly more padding */
            border-radius: 0.5rem;
            color: #fff;
            flex: 1 1 0;
            /* allow cards to grow evenly */
            max-width: 250px;
            /* maintain square-ish size */
            height: 130px;
            /* fixed height */
            transition: transform 0.2s;
        }

        .info-card:hover {
            transform: translateY(-5px);
        }

        .info-icon {
            font-size: 2rem;
            margin-right: 12px;
        }

        .info-text h6 {
            margin: 0;
            font-size: 0.9rem;
            /* slightly larger */
            font-weight: 600;
            /* semi-bold */
            color: #ffffff;
            /* high contrast */
        }

        .info-text span {
            display: block;
            font-size: 1.3rem;
            /* bigger number */
            font-weight: 700;
            /* bold */
            color: #ffffff;
            margin-top: 4px;
        }


        /* Color coding */
        .bg-solar {
            background-color: #0d6efd;
        }

        .bg-battery {
            background-color: #198754;
        }

        .bg-soc {
            background-color: #fd7e14;
        }

        .bg-max-temp {
            background-color: #dc3545;
        }

        .bg-min-temp {
            background-color: #0dcaf0;
        }

        .bg-readings {
            background-color: #6c757d;
        }

        /* Table styling */
        .table thead th {
            position: sticky;
            top: 0;
            background: #f8f9fa;
            z-index: 10;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        .table td,
        .table th {
            vertical-align: middle;
            text-align: center;
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

        /* Dark mode for the new table */
        body.dark-mode .table {
            background-color: #0E0E23;
            /* match card/container tone */
            color: white;
            border-color: #2f2f4a !important;
        }

        body.dark-mode .table thead th {
            background-color: #24243E;
            color: white;
            border-color: #2f2f4a !important;
        }

        body.dark-mode .table tbody tr:nth-child(odd) {
            background-color: #1a1a2e;
        }

        body.dark-mode .table tbody tr:nth-child(even) {
            background-color: #0E0E23;
        }

        body.dark-mode .table tbody tr:hover {
            background-color: #33334d;
            /* subtle highlight */
        }

        body.dark-mode .table td,
        body.dark-mode .table th {
            color: white !important;
            border-color: #2f2f4a !important;
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
    <?php
    // Database connection
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "smart_solar";

    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    // Date & time range from POST
    $start_date = $_POST['start_date'] ?? date('Y-m-d');
    $end_date   = $_POST['end_date'] ?? date('Y-m-d');
    $start_time = $_POST['start_time'] ?? '00:00:00';
    $end_time   = $_POST['end_time'] ?? '23:59:59';

    // Combine date + time for SQL
    $from_datetime = "$start_date $start_time";
    $to_datetime   = "$end_date $end_time";

    // -----------------------------
    // Compute totals using capped time differences
    // -----------------------------
    $summary_sql = "
SELECT 
    SUM(energy_wh) AS total_solar_energy,
    SUM(battery_energy_wh) AS total_battery_energy,
    AVG(battery_soc) AS avg_battery_soc,
    MAX(temperature) AS max_temp,
    MIN(temperature) AS min_temp,
    COUNT(*) AS total_readings
FROM (
    SELECT 
        solar_power,
        battery_power,
        battery_soc,
        temperature,
        reading_time,
        LAG(reading_time) OVER (ORDER BY reading_time) AS prev_time,
        IF(
            LAG(reading_time) OVER (ORDER BY reading_time) IS NULL, 
            0,
            solar_power * LEAST(TIMESTAMPDIFF(SECOND, LAG(reading_time) OVER (ORDER BY reading_time), reading_time), 3600)/3600
        ) AS energy_wh,
        IF(
            LAG(reading_time) OVER (ORDER BY reading_time) IS NULL, 
            0,
            battery_power * LEAST(TIMESTAMPDIFF(SECOND, LAG(reading_time) OVER (ORDER BY reading_time), reading_time), 3600)/3600
        ) AS battery_energy_wh
    FROM sensor_reading
    WHERE reading_time BETWEEN '$from_datetime' AND '$to_datetime'
) AS subquery
";

    $summary_result = $conn->query($summary_sql);

    if ($summary_result) {
        $summary = $summary_result->fetch_assoc();
    } else {
        // Default values if query fails
        $summary = [
            'total_solar_energy' => 0,
            'total_battery_energy' => 0,
            'avg_battery_soc' => 0,
            'max_temp' => 0,
            'min_temp' => 0,
            'total_readings' => 0
        ];
    }

    // -----------------------------
    // Fetch all sensor readings (optional for charts or tables)
    // -----------------------------
    $data_sql = "
SELECT * FROM sensor_reading
WHERE reading_time BETWEEN '$from_datetime' AND '$to_datetime'
ORDER BY reading_time ASC
";

    $data_result = $conn->query($data_sql);
    ?>



    <div class="pc-container">
        <div class="pc-content" style="padding: 22px 35px 32px;">

            <!-- Big Data Logs Card -->
            <div class="card shadow-lg card-hover" style="height: 100%;">
                <div class="card-body p-4">

                    <!-- Header + Date Filter -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold mb-0">Data Logs</h4>

                        <div class="d-flex gap-2 align-items-end">

                            <!-- Filter Form (POST) -->
                            <form method="POST" class="d-flex gap-2 align-items-end" id="filterForm">
                                <!-- From Date + Time -->
                                <div class="d-flex flex-column">
                                    <label for="start_date" class="form-label mb-1">From</label>
                                    <div class="d-flex gap-1">
                                        <input type="date" id="start_date" name="start_date" value="<?= $start_date ?>" class="form-control">
                                        <select name="start_time" class="form-select">
                                            <?php
                                            for ($h = 0; $h < 24; $h++) {
                                                for ($m = 0; $m < 60; $m += 30) {
                                                    $time = sprintf('%02d:%02d:00', $h, $m);
                                                    $display = date('h:i A', strtotime($time));
                                                    $selected = (isset($_POST['start_time']) && $_POST['start_time'] == $time) ? 'selected' : '';
                                                    echo "<option value='$time' $selected>$display</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- To Date + Time -->
                                <div class="d-flex flex-column">
                                    <label for="end_date" class="form-label mb-1">To</label>
                                    <div class="d-flex gap-1">
                                        <input type="date" id="end_date" name="end_date" value="<?= $end_date ?>" class="form-control">
                                        <select name="end_time" class="form-select">
                                            <?php
                                            for ($h = 0; $h < 24; $h++) {
                                                for ($m = 0; $m < 60; $m += 30) {
                                                    $time = sprintf('%02d:%02d:00', $h, $m);
                                                    $display = date('h:i A', strtotime($time));
                                                    $selected = (isset($_POST['end_time']) && $_POST['end_time'] == $time) ? 'selected' : '';
                                                    echo "<option value='$time' $selected>$display</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" name="filter" class="btn btn-primary btn-fixed-height">Filter</button>
                            </form>


                            <!-- Action Buttons -->
                            <div class="d-flex gap-2 align-items-end">

                                <!-- Generate Report -->
                                <form method="GET" action="generate_report.php" target="_blank">
                                    <input type="hidden" name="start_date" value="<?= isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d') ?>">
                                    <input type="hidden" name="end_date" value="<?= isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d') ?>">
                                    <input type="hidden" name="start_time" value="<?= isset($_POST['start_time']) ? $_POST['start_time'] : '00:00:00' ?>">
                                    <input type="hidden" name="end_time" value="<?= isset($_POST['end_time']) ? $_POST['end_time'] : '23:30:00' ?>">
                                    <button type="submit" class="btn btn-success btn-fixed-height">Generate Logs</button>
                                </form>

                                <!-- Single Delete Button Form -->
                                <form method="POST" action="delete_readings.php" id="deleteForm">
                                    <!-- Selected readings filled by JS -->
                                    <input type="hidden" name="selected_readings" id="selected_readings_input">

                                    <!-- Track if filter was applied -->
                                    <input type="hidden" name="filter_applied" id="delete_filter_applied" value="<?= isset($_POST['filter']) ? '1' : '0' ?>">

                                    <!-- Hidden inputs to preserve filtered date/time only if filter was applied -->
                                    <?php if (isset($_POST['filter'])): ?>
                                        <!-- Delete form hidden inputs -->
                                        <input type="hidden" name="start_date" id="delete_start_date" value="<?= isset($_POST['filter']) ? $_POST['start_date'] : '' ?>">
                                        <input type="hidden" name="end_date" id="delete_end_date" value="<?= isset($_POST['filter']) ? $_POST['end_date'] : '' ?>">
                                        <input type="hidden" name="start_time" id="delete_start_time" value="<?= isset($_POST['filter']) ? $_POST['start_time'] : '' ?>">
                                        <input type="hidden" name="end_time" id="delete_end_time" value="<?= isset($_POST['filter']) ? $_POST['end_time'] : '' ?>">
                                    <?php endif; ?>

                                    <button type="submit" id="deleteBtn" class="btn btn-danger btn-fixed-height">Delete</button>
                                </form>




                            </div>
                        </div>
                    </div>


                    <!-- Summary Info Boxes Row -->
                    <div class="info-row">
                        <?php
                        $summaries = [
                            ['label' => 'Number of Readings', 'value' => $summary['total_readings'], 'class' => 'bg-readings', 'icon' => '📊'],
                            ['label' => 'Total Solar Energy Yield (Wh)', 'value' => number_format($summary['total_solar_energy'], 4), 'class' => 'bg-solar', 'icon' => '☀️'],
                            ['label' => 'Total Battery Output (Wh)', 'value' => number_format($summary['total_battery_energy'], 4), 'class' => 'bg-battery', 'icon' => '🔋'],
                            ['label' => 'Avg Battery SOC (%)', 'value' => number_format($summary['avg_battery_soc'], 2), 'class' => 'bg-soc', 'icon' => '⚡'],
                            ['label' => 'Max Temp (°C)', 'value' => number_format($summary['max_temp'], 2), 'class' => 'bg-max-temp', 'icon' => '🔥'],
                            ['label' => 'Min Temp (°C)', 'value' => number_format($summary['min_temp'], 2), 'class' => 'bg-min-temp', 'icon' => '❄️'],
                        ];

                        foreach ($summaries as $item): ?>
                            <div class="info-card <?= $item['class'] ?>">
                                <div class="info-icon"><?= $item['icon'] ?></div>
                                <div class="info-text text-start">
                                    <h6><?= $item['label'] ?></h6>
                                    <span><?= $item['value'] ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Scrollable Table -->
                    <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                        <table class="table table-bordered table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>
                                        <input type="checkbox" id="selectAll">
                                    </th>
                                    <th>#</th>
                                    <th>Solar Voltage (V)</th>
                                    <th>Solar Current (A)</th>
                                    <th>Solar Power (W)</th>
                                    <th>Battery Voltage (V)</th>
                                    <th>Battery Current (A)</th>
                                    <th>Battery Power (W)</th>
                                    <th>Battery SOC (%)</th>
                                    <th>Temperature (°C)</th>
                                    <th>Reading Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data_result->num_rows > 0): ?>
                                    <?php $counter = 1; ?>
                                    <?php while ($row = $data_result->fetch_assoc()): ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="selected_readings[]" value="<?= $row['id'] ?>">
                                            </td>
                                            <td><?= $counter++ ?></td>
                                            <td><?= number_format($row['solar_voltage'], 2) ?></td>
                                            <td><?= number_format($row['solar_current'], 2) ?></td>
                                            <td><?= number_format($row['solar_power'], 2) ?></td>
                                            <td><?= number_format($row['battery_voltage'], 2) ?></td>
                                            <td><?= number_format($row['battery_current'], 2) ?></td>
                                            <td><?= number_format($row['battery_power'], 2) ?></td>
                                            <td><?= number_format($row['battery_soc'], 2) ?></td>
                                            <td><?= number_format($row['temperature'], 2) ?></td>
                                            <td><?= date('M d, Y h:i:s A', strtotime($row['reading_time'])) ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="11">No data available.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>



                </div> <!-- /.card-body -->
            </div> <!-- /.big card -->








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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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


        // ===== Data Logs Delete JS =====
        // Elements
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('input[name="selected_readings[]"]');
        const deleteBtn = document.getElementById('deleteBtn');
        const form = deleteBtn.closest('form');

        // ===== Select All Functionality =====
        selectAll.addEventListener('change', () => {
            checkboxes.forEach(cb => cb.checked = selectAll.checked);
            updateDeleteButton();
        });

        // Update delete button label when individual checkboxes change
        checkboxes.forEach(cb => cb.addEventListener('change', updateDeleteButton));

        function updateDeleteButton() {
            const selectedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
            deleteBtn.textContent = selectedCount > 0 ? `Delete ${selectedCount}` : 'Delete';
        }

        // ===== Handle Delete Form Submission =====
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // prevent default form submission

            // If no data available
            if (checkboxes.length === 0) {
                Swal.fire({
                    title: 'No data available to delete',
                    icon: 'info',
                    showConfirmButton: true
                });
                return;
            }

            // Get selected readings
            const selected = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            // ===== Determine date & time range for confirmation =====
            const filterApplied = document.querySelector('#delete_filter_applied')?.value === '1';

            // Default placeholders if no filter applied
            let startDisplay, endDisplay;

            // If filter applied, use the filtered range
            if (filterApplied) {
                const startDateInput = document.getElementById('delete_start_date').value;
                const endDateInput = document.getElementById('delete_end_date').value;
                const startTimeInput = document.getElementById('delete_start_time').value;
                const endTimeInput = document.getElementById('delete_end_time').value;

                const startDateTime = new Date(`${startDateInput}T${startTimeInput}`);
                const endDateTime = new Date(`${endDateInput}T${endTimeInput}`);

                startDisplay = startDateTime.toLocaleString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric',
                    hour: 'numeric',
                    minute: 'numeric',
                    hour12: true
                });
                endDisplay = endDateTime.toLocaleString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric',
                    hour: 'numeric',
                    minute: 'numeric',
                    hour12: true
                });
            } else {
                // Default to today from 00:00 to 23:59
                const today = new Date();
                const startDateTime = new Date(today.getFullYear(), today.getMonth(), today.getDate(), 0, 0, 0);
                const endDateTime = new Date(today.getFullYear(), today.getMonth(), today.getDate(), 23, 59, 59);

                startDisplay = startDateTime.toLocaleString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric',
                    hour: 'numeric',
                    minute: 'numeric',
                    hour12: true
                });
                endDisplay = endDateTime.toLocaleString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric',
                    hour: 'numeric',
                    minute: 'numeric',
                    hour12: true
                });
            }



            // SweetAlert confirmation title
            const confirmTitle = selected.length > 0 ?
                `Delete ${selected.length} selected reading(s)?` :
                `No readings selected. This will delete all readings from ${startDisplay} to ${endDisplay}. Proceed?`;

            // Show confirmation dialog
            Swal.fire({
                title: confirmTitle,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proceed with deletion
                    const formData = new FormData(form);
                    if (selected.length > 0) {
                        formData.set('selected_readings', selected.join(','));
                    }

                    fetch(form.action, {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.text())
                        .then(() => {
                            Swal.fire({
                                title: 'Deleted successfully',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => window.location.reload());
                        })
                        .catch(err => {
                            Swal.fire({
                                title: 'Error deleting records',
                                icon: 'error'
                            });
                            console.error(err);
                        });

                } else {
                    // ===== Reset date/time pickers on Cancel =====
                    const startDateInput = document.getElementById('start_date');
                    const endDateInput = document.getElementById('end_date');
                    const startTimeInput = document.querySelector('select[name="start_time"]');
                    const endTimeInput = document.querySelector('select[name="end_time"]');

                    const today = new Date();
                    startDateInput.value = today.toISOString().split('T')[0]; // yyyy-mm-dd
                    endDateInput.value = today.toISOString().split('T')[0];
                    startTimeInput.value = '00:00:00';
                    endTimeInput.value = '23:30:00'; // or '23:59:59' if you prefer
                }
            });
        });




        const generateBtn = document.querySelector('form[action="generate_report.php"] button');
        generateBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');

            const selected = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            if (selected.length > 0) {
                Swal.fire({
                    title: `Generate ${selected.length} selected reading${selected.length === 1 ? '' : 's'}?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, generate',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        let input = form.querySelector('input[name="selected_readings"]');
                        if (!input) {
                            input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'selected_readings';
                            form.appendChild(input);
                        }
                        input.value = selected.join(',');
                        form.submit();
                    }
                });
            } else if (<?= $data_result->num_rows ?? 0 ?> > 0) {
                Swal.fire({
                    title: `Generate logs for all readings in this range?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, generate',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            } else {
                Swal.fire({
                    title: 'No data available for the selected range',
                    icon: 'info',
                    confirmButtonText: 'Ok'
                });
            }
        });


        document.addEventListener('DOMContentLoaded', () => {
            const checkboxes = document.querySelectorAll('input[name="selected_readings[]"]');
            const selectAll = document.getElementById('selectAll');

            // Info card elements
            const infoCards = {
                totalReadings: document.querySelector('.info-row .bg-readings span'),
                totalSolar: document.querySelector('.info-row .bg-solar span'),
                totalBattery: document.querySelector('.info-row .bg-battery span'),
                avgSOC: document.querySelector('.info-row .bg-soc span'),
                maxTemp: document.querySelector('.info-row .bg-max-temp span'),
                minTemp: document.querySelector('.info-row .bg-min-temp span')
            };

            // Get all rows with their data and timestamps
            const rowData = Array.from(document.querySelectorAll('table tbody tr')).map(tr => ({
                solar_power: parseFloat(tr.children[4].textContent) || 0,
                battery_power: parseFloat(tr.children[7].textContent) || 0,
                battery_soc: parseFloat(tr.children[8].textContent) || 0,
                temperature: parseFloat(tr.children[9].textContent) || 0,
                reading_time: new Date(tr.children[10].textContent).getTime() / 1000 // Unix timestamp in seconds
            }));

            function updateSummary() {
                const selectedIndices = Array.from(checkboxes)
                    .map((cb, i) => cb.checked ? i : -1)
                    .filter(i => i !== -1);

                // If none selected, use all rows
                const indices = selectedIndices.length ? selectedIndices : rowData.map((_, i) => i);

                let totalSolarEnergy = 0;
                let totalBatteryEnergy = 0;
                let totalSOC = 0;
                let maxTemp = -Infinity;
                let minTemp = Infinity;

                for (let i = 0; i < indices.length; i++) {
                    const idx = indices[i];
                    const current = rowData[idx];
                    const prev = i > 0 ? rowData[indices[i - 1]] : null;

                    // Time difference capped at 3600 seconds
                    const dt = prev ? Math.min(current.reading_time - prev.reading_time, 3600) : 0;

                    totalSolarEnergy += current.solar_power * dt / 3600;
                    totalBatteryEnergy += current.battery_power * dt / 3600;
                    totalSOC += current.battery_soc;
                    if (current.temperature > maxTemp) maxTemp = current.temperature;
                    if (current.temperature < minTemp) minTemp = current.temperature;
                }

                const totalReadings = indices.length;
                const avgSOC = totalReadings ? totalSOC / totalReadings : 0;

                // Update cards
                infoCards.totalReadings.textContent = totalReadings;
                infoCards.totalSolar.textContent = totalSolarEnergy.toFixed(4);
                infoCards.totalBattery.textContent = totalBatteryEnergy.toFixed(4);
                infoCards.avgSOC.textContent = avgSOC.toFixed(2);
                infoCards.maxTemp.textContent = isFinite(maxTemp) ? maxTemp.toFixed(2) : 0;
                infoCards.minTemp.textContent = isFinite(minTemp) ? minTemp.toFixed(2) : 0;
            }

            // Event listeners
            checkboxes.forEach(cb => cb.addEventListener('change', updateSummary));
            selectAll.addEventListener('change', () => {
                checkboxes.forEach(cb => cb.checked = selectAll.checked);
                updateSummary();
            });

            // Initial summary
            updateSummary();
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