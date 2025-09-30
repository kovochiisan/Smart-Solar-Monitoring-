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
            $fullName = $_SESSION['full_name'] ?? 'Guest User';
            $role = $_SESSION['role'] ?? 'User';
            ?>

            <div class="ms-auto d-flex align-items-center">
                <ul class="list-unstyled d-flex align-items-center mb-0">

                    <!-- User Profile Dropdown -->
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle d-flex align-items-center"
                            style="padding: 20px 16px; gap:12px; min-width: 280px; cursor:pointer;" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="true" data-bs-auto-close="outside" aria-expanded="false">

                            <!-- Avatar -->
                            <img src="../assets/images/user/avatar-2.jpg" alt="user-image"
                                style="width:40px; height:40px; object-fit:cover; border-radius:50%; flex-shrink:0; display:block;">

                            <!-- Full Name -->
                            <span
                                style="color:#000; font-weight:600; font-size:16px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <?php echo htmlspecialchars($fullName); ?>
                            </span>

                        </a>

                        <!-- Dropdown Menu -->
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center">
                                <img src="../assets/images/user/avatar-2.jpg" alt="user-image"
                                    style="width:50px; height:50px; object-fit:cover; border-radius:50%; flex-shrink:0;">
                                <div class="ms-3">
                                    <h6><?php echo htmlspecialchars($fullName); ?></h6>
                                    <span><?php echo htmlspecialchars(ucfirst($role)); ?></span>
                                </div>
                            </div>

                            <div class="px-3 py-2">
                                <h6 class="dropdown-header">Settings</h6>
                                <a href="#!" class="dropdown-item">
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
        <div class="pc-content" style="padding: 2rem;">

            <div class="row g-3">

                <!-- Left Column -->
                <div class="col-12 col-lg-8 d-flex flex-column gap-3">

                    <!-- Load Control Card (Full Width) -->
                    <div class="card card-hover shadow-lg text-center">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-2">Load Control</h4>
                            <p class="text-muted small mb-3">Manually switch the load ON or OFF.</p>
                            <div class="form-check form-switch d-flex justify-content-center align-items-center" style="gap: 10px;">
                                <input class="form-check-input" type="checkbox" id="loadSwitch" style="width: 60px; height: 34px;">
                                <label class="form-check-label fs-5" for="loadSwitch">Load</label>
                            </div>
                        </div>
                    </div>


                    <!-- Bottom row: Battery Status + Chart -->
                    <div class="row g-3">

                        <!-- Battery Status Card -->
                        <div class="col-12 col-md-6">
                            <div class="card card-hover shadow-lg h-100">
                                <div class="card-body p-4">
                                    <h4 class="fw-bold mb-2">Battery Status</h4>
                                    <p class="text-muted small mb-4">
                                        Set the battery % threshold to automatically turn off the load if it drops below this level.
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div style="flex-shrink: 0;">
                                            <svg class="battery" viewBox="0 0 100 100" width="140px" height="140px">
                                                <g fill="none" transform="rotate(-75,50,50)">
                                                    <circle r="40" cx="50" cy="50" stroke="hsla(223,10%,50%,0.2)" stroke-width="20"
                                                        stroke-dasharray="251.33 251.33" stroke-dashoffset="20.944" />
                                                    <circle class="battery__fill1" r="40" cx="50" cy="50" stroke="hsl(123,90%,45%)" stroke-width="20"
                                                        stroke-dasharray="251.33 251.33" stroke-dashoffset="20.944" />
                                                </g>
                                                <text class="battery__value" font-size="16" fill="currentColor" x="50" y="56" text-anchor="middle" data-value>100%</text>
                                            </svg>
                                        </div>
                                        <div class="text-end" style="flex-shrink: 0;">
                                            <h6 class="mb-1">Current Threshold</h6>
                                            <span id="batteryThresholdValueDisplay" class="fw-bold fs-2">100%</span>
                                        </div>
                                    </div>
                                    <label for="batteryThreshold" class="form-label fw-bold">Auto Shutdown Threshold (%)</label>
                                    <input type="range" class="form-range mb-3" min="0" max="100" value="100" id="batteryThreshold">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span>0%</span>
                                        <span id="batteryThresholdValue">100%</span>
                                    </div>
                                    <div class="text-end">
                                        <button id="applyThresholdBtn" class="btn btn-success btn-lg shadow-sm">Apply Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Chart Card -->
                        <div class="col-12 col-md-6">
                            <div class="card card-hover shadow-lg text-center h-100">
                                <div class="card-body p-5">
                                    <h4 class="fw-bold mb-2">Load Activity Chart</h4>
                                    <p class="text-muted small mb-4">Visualize recent load activity and battery status trends.</p>
                                    <canvas id="loadChart" style="width:100%; height:300px;"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Right Column: Load Overview Card -->
                <div class="col-12 col-lg-4">
                    <div class="card card-hover shadow-lg h-100">
                        <div class="card-body p-4 d-flex flex-column justify-content-start align-items-center">

                            <!-- Placeholder for Image or Icon -->
                            <img src="https://via.placeholder.com/80x80?text=Load" alt="Load Image" class="mb-3" style="border-radius: 8px;">

                            <h4 class="fw-bold mb-4 text-center">Load Overview</h4>

                            <div class="row w-100">
                                <!-- Left Column of Info -->
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><span style="color:#4CAF50;">●</span> Load Status: <span id="loadStatus">ON</span></li>
                                        <li class="mb-2"><span style="color:#2196F3;">●</span> Auto Shutdown Threshold: <span id="batteryThresholdDisplay">100%</span></li>
                                    </ul>
                                </div>

                                <!-- Right Column of Info -->
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><span style="color:#E91E63;">●</span> Runtime Today: <span id="loadRuntime">3h 20m</span></li>
                                        <li class="mb-2"><span style="color:#FF5722;">●</span> Last Load Action: <span id="loadLastTriggered">10:45 AM</span></li>
                                    </ul>
                                </div>
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
        const batteryThresholdSlider = document.getElementById('batteryThreshold');
        const batteryThresholdValue = document.getElementById('batteryThresholdValue');

        function updateSliderColor(value) {
            let color;
            if (value > 80) color = 'hsl(123, 90%, 45%)'; // full green
            else if (value > 60) color = 'hsl(96, 90%, 45%)'; // light green
            else if (value > 40) color = 'hsl(58, 90%, 45%)'; // yellow
            else if (value > 20) color = 'hsl(30, 90%, 45%)'; // orange
            else color = 'hsl(3, 90%, 45%)'; // red

            // Apply gradient fill for slider
            batteryThresholdSlider.style.background = `linear-gradient(to right, ${color} 0%, ${color} ${value}%, #d3d3d3 ${value}%, #d3d3d3 100%)`;
        }

        // Initialize
        updateSliderColor(batteryThresholdSlider.value);

        // Update dynamically
        batteryThresholdSlider.addEventListener('input', () => {
            batteryThresholdValue.innerText = batteryThresholdSlider.value + '%';
            updateSliderColor(batteryThresholdSlider.value);
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




        const loadSwitch = document.getElementById('loadSwitch');
        const loadStatusDisplay = document.getElementById('loadStatus');

        loadSwitch.addEventListener('change', () => {
            const status = loadSwitch.checked ? "ON" : "OFF";
            loadStatusDisplay.innerText = status;

            // Publish to MQTT
            client.publish('system/load/control', status, {
                qos: 1,
                retain: true
            });

            // Optional: Show feedback
            console.log('Load control sent:', status);
        });



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
                    // Update display
                    batteryThresholdDisplay.innerText = thresholdValue + '%';
                    document.getElementById('batteryThresholdDisplay').innerText = thresholdValue + '%';

                    // Publish to MQTT
                    client.publish('system/battery/threshold', thresholdValue.toString(), {
                        qos: 1,
                        retain: true
                    });

                    console.log('Battery threshold sent:', thresholdValue);

                    Swal.fire({
                        title: 'Applied!',
                        text: `Battery threshold set to ${thresholdValue}%`,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
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


        const ctx = document.getElementById('loadChart').getContext('2d');
        const loadChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['10AM', '11AM', '12PM', '1PM', '2PM', '3PM'],
                datasets: [{
                    label: 'Voltage (V)',
                    data: [12.4, 12.6, 12.8, 13.0, 12.9, 12.7],
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        suggestedMin: 11,
                        suggestedMax: 14
                    }
                }
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