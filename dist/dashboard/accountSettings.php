<?php
session_start();
require_once "config.php";
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

        /* Dark mode labels (small) */
        body.dark-mode .card small.text-muted.d-block {
            color: #f8f9fa !important;
            /* light color for dark mode */
        }

        /* Dark mode values (span.fs-5) */
        body.dark-mode .card span.fs-5:not([class*="text-"]) {
            color: #f8f9fa !important;
            /* light color for dark mode */
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


        /* ================================
   Form Styling for Profile Card
   ================================ */

        /* Form container spacing */
        .card-hover form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            /* increased spacing between rows */
        }

        /* Form rows for two-column layout */
        .card-hover form .row.g-3 {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            /* increased horizontal and vertical spacing */
        }

        .card-hover form .col-md-6 {
            flex: 0 0 48%;
            max-width: 48%;
        }

        /* Responsive: stack columns on small screens */
        @media (max-width: 768px) {
            .card-hover form .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        /* Form labels */
        .card-hover form .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            /* more space below label */
            font-size: 1.1rem;
            /* bigger text */
            color: #495057;
        }

        /* Form inputs */
        .card-hover form .form-control {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            /* larger padding */
            border: 1px solid #ced4da;
            font-size: 1.05rem;
            /* bigger text */
            transition: border 0.3s ease, box-shadow 0.3s ease;
        }

        /* Focus state for inputs */
        .card-hover form .form-control:focus {
            outline: none;
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        /* Submit button */
        .card-hover form .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            /* bigger button */
            font-size: 1.1rem;
            /* bigger text */
            font-weight: 600;
            align-self: flex-start;
            transition: all 0.3s ease;
        }

        .card-hover form .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
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



    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content" style="padding-bottom: 2rem;">
            <div class="row g-3 mt-4 mb-4">
                <!-- Main Profile Card -->
                <div class="col-lg-8 col-12 d-flex">
                    <div class="card card-hover flex-grow-1 h-100"
                        style="width:100%; border-radius:0.75rem; box-shadow:0 .25rem .5rem rgba(0,0,0,.1); overflow:hidden; display:flex; flex-direction:column;">

                        <!-- Form Section -->
                        <form id="updateForm" method="POST" enctype="multipart/form-data" style="flex-grow:1;">

                            <!-- Profile Section -->
                            <div style="display:flex; align-items:center; padding: 1.5rem;">
                                <div class="position-relative me-3" style="width: 140px; height: 140px;">

                                    <!-- Circular Wrapper with White Border -->
                                    <div class="border border-3 border-white rounded-circle shadow overflow-hidden"
                                        style="width: 100%; height: 100%;">
                                        <img id="profilePhoto"
                                            src="<?php echo htmlspecialchars(isset($user['profile_image']) && $user['profile_image'] != '' ? '../' . $user['profile_image'] : '../assets/images/user/avatar-1.jpg'); ?>"
                                            alt="Profile Photo"
                                            style="width:100%; height:100%; object-fit:cover; cursor:pointer;">
                                    </div>

                                    <!-- Hidden File Input (connected to form) -->
                                    <input type="file" name="profile_image" id="photoInput" accept="image/*" style="display: none;">
                                    <label for="photoInput"
                                        style="position: absolute; bottom: 0; right: 0; background-color: rgba(0,0,0,0.6); padding:6px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" viewBox="0 0 16 16">
                                            <path d="M9.5 2a.5.5 0 0 1 .5.5V3h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-10a1 1 0 0 1-1-1v-8a1 1 0 0 1 1-1h2v-.5a.5.5 0 0 1 .5-.5h5zM8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6z" />
                                        </svg>
                                    </label>
                                </div>

                                <div style="flex:1; text-align:left;">
                                    <h2 class="fw-bold mb-1" style="font-size:1.4rem;">
                                        <?php echo htmlspecialchars($fullName ?: 'N/A'); ?>
                                    </h2>
                                    <p class="text-muted mb-1" style="font-size:0.85rem;">
                                        <?php echo htmlspecialchars($_SESSION['email'] ?? 'N/A'); ?>
                                    </p>
                                    <p class="text-muted mb-0" style="font-size:0.8rem;">
                                        <?php echo htmlspecialchars(!empty($role) ? ucfirst($role) : 'N/A'); ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Editable Fields -->
                            <div style="padding: 1.5rem; border-top: 1px solid #eee;">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label fw-semibold">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" placeholder="N/A">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="fullname" class="form-label fw-semibold">Full Name</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname"
                                            value="<?php echo htmlspecialchars($user['full_name'] ?? ''); ?>" placeholder="N/A">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="phone" class="form-label fw-semibold">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            maxlength="11" pattern="^09\d{9}$"
                                            title="Enter a valid 11-digit Philippine phone number starting with 09"
                                            value="<?php echo htmlspecialchars($user['contact_number'] ?? ''); ?>" placeholder="N/A">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="dob" class="form-label fw-semibold">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob"
                                            value="<?php echo htmlspecialchars($user['date_of_birth'] ?? ''); ?>" placeholder="N/A">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="address" class="form-label fw-semibold">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="<?php echo htmlspecialchars($user['address'] ?? ''); ?>" placeholder="N/A">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password" class="form-label fw-semibold">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Enter new password">
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>


                <!-- Right Side Card (Account Overview) -->
                <div class="col-12 col-lg-4 d-flex">
                    <div class="card card-hover shadow-lg flex-grow-1 h-100 d-flex flex-column align-items-center justify-content-start text-center p-4">

                        <!-- Label -->
                        <h4 class="fw-bold mb-4">Profile Card</h4>

                        <!-- Profile Picture -->
                        <div class="position-relative mb-3"
                            style="width:140px; height:140px; border-radius:50%; overflow:hidden; border:3px solid white; box-shadow:0 0 8px rgba(0,0,0,0.15); cursor:pointer;">

                            <img id="profilePhoto"
                                src="<?php echo htmlspecialchars(isset($user['profile_image']) && $user['profile_image'] != '' ? '../' . $user['profile_image'] : '../assets/images/user/avatar-1.jpg'); ?>"
                                alt="Profile Picture"
                                style="width:100%; height:100%; object-fit:cover; display:block;">
                        </div>


                        <!-- User Info -->
                        <h4 class="fw-bold mb-1" style="font-size:1.4rem;">
                            <?php echo htmlspecialchars($fullName); ?>
                        </h4>
                        <p class="text-muted mb-1" style="font-size:1rem;">
                            <?php echo htmlspecialchars($_SESSION['email'] ?? 'user@example.com'); ?>
                        </p>
                        <span class="badge bg-primary mb-3" style="font-size:0.9rem; padding:0.5rem 1rem;">
                            <?php echo htmlspecialchars(ucfirst($role)); ?>
                        </span>

                        <!-- Divider -->
                        <hr class="w-100">
                        <!-- Other Details (Single Column, Centered, Bigger Text with Icons) -->
                        <div class="w-100 text-center">
                            <div class="mb-3">
                                <small class="text-muted d-block" style="font-size:1rem; font-weight:600;">
                                    <i class="bi bi-telephone me-1"></i> Phone
                                </small>
                                <span style="font-size:1.1rem;">
                                    <?php echo htmlspecialchars($phone ?? 'N/A'); ?>
                                </span>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted d-block" style="font-size:1rem; font-weight:600;">
                                    <i class="bi bi-calendar-event me-1"></i> Date of Birth
                                </small>
                                <span style="font-size:1.1rem;">
                                    <?php echo htmlspecialchars($dob ?? 'N/A'); ?>
                                </span>
                            </div>
                            <div class="mb-0">
                                <small class="text-muted d-block" style="font-size:1rem; font-weight:600;">
                                    <i class="bi bi-geo-alt me-1"></i> Address
                                </small>
                                <span style="font-size:1.1rem;">
                                    <?php echo htmlspecialchars($address ?? 'N/A'); ?>
                                </span>
                            </div>
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



        document.addEventListener('DOMContentLoaded', () => {
            const updateForm = document.getElementById('updateForm');
            const photoInput = document.getElementById('photoInput');
            const profilePhoto = document.getElementById('profilePhoto');

            // Preview profile image
            photoInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        profilePhoto.src = evt.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });

            // AJAX form submission
            updateForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const formData = new FormData(updateForm);

                fetch('updateUserInfo.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: data.message,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload(); // Refresh page after clicking OK
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message,
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while updating your profile.',
                            confirmButtonText: 'OK'
                        });
                    });
            });
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