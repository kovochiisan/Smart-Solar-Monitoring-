<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Solar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="signIn.css">
    <link rel="icon" type="image/png" sizes="32x32" href="../../images/LogoNoBG.png">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

</head>

<body class="h-screen flex items-center justify-between font-[Poppins]">

    <!-- Background Images -->
    <div class="background-container">
        <img src="../../images/Background 2.jpg" class="bg-slide">
        <img src="../../images/Background 3.jpg" class="bg-slide">
        <img src="../../images/Background 4.jpg" class="bg-slide">
    </div>

    <!-- Left Side Content -->
    <div class="flex flex-col justify-center items-center h-screen text-white ml-36 fade-in text-center">
        <h1 class="text-6xl font-extrabold mb-4 transition-transform duration-700 text-shadow">Welcome to</h1>

        <div class="w-[32rem] h-[20rem] mb-4 flex items-center justify-center rounded-full p-2">
            <img src="../../images/LogoNoBG.png" alt="Smart Solar Logo">
        </div>

        <h2 class="text-5xl font-bold mb-2 transition-transform duration-700 text-shadow">Smart Solar</h2>
        <p class="text-2xl text-gray-200 mt-2 text-shadow">Your solution for smart solar energy monitoring</p>
    </div>

    <!-- Right Side Form -->
    <div class="mr-20 slide-in w-[40em]">

        <!-- Form Title -->
        <h2 class="text-4xl font-bold mb-10 text-center text-black" id="formTitle">Sign In</h2>

        <!-- Sign In Form -->
        <form id="loginForm" class="space-y-8" action="signInScript.php" method="POST">
            <!-- Email -->
            <div class="flex items-center border-b border-gray-500 py-3">
                <i class="fas fa-envelope text-gray-500 mr-3"></i>
                <input type="email" name="email" placeholder="Enter email"
                    class="w-full bg-transparent placeholder-gray-500 text-black text-lg focus:outline-none focus:border-blue-400" required>
            </div>

            <!-- Password -->
            <div class="flex items-center border-b border-gray-500 py-3">
                <i class="fas fa-lock text-gray-500 mr-3"></i>
                <input type="password" name="password" placeholder="Enter password"
                    class="w-full bg-transparent placeholder-gray-500 text-black text-lg focus:outline-none focus:border-blue-400" required>
            </div>

            <button type="submit"
                class="w-full mt-8 bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg text-lg font-semibold">
                Sign In
            </button>

            <p class="text-center text-base mt-6 text-black">
                Don't have an account?
                <button type="button" class="underline text-blue-600 hover:text-blue-800" onclick="toggleForm()">Sign Up</button>
            </p>
        </form>

        <!-- Sign Up Form -->
        <form id="registerForm" class="space-y-8 hidden" action="signUpScript.php" method="POST">
            <!-- Full Name -->
            <div class="flex items-center border-b border-gray-500 py-3">
                <i class="fas fa-user text-gray-500 mr-3"></i>
                <input type="text" name="full_name" placeholder="Enter full name"
                    class="w-full bg-transparent placeholder-gray-500 text-black text-lg focus:outline-none focus:border-green-400" required>
            </div>

            <!-- Email -->
            <div class="flex items-center border-b border-gray-500 py-3">
                <i class="fas fa-envelope text-gray-500 mr-3"></i>
                <input type="email" name="email" placeholder="Enter email"
                    class="w-full bg-transparent placeholder-gray-500 text-black text-lg focus:outline-none focus:border-green-400" required>
            </div>

            <!-- Contact Number -->
            <div class="flex items-center border-b border-gray-500 py-3">
                <i class="fas fa-phone text-gray-500 mr-3"></i>
                <input type="tel" name="contact_number" placeholder="Enter contact number"
                    class="w-full bg-transparent placeholder-gray-500 text-black text-lg focus:outline-none focus:border-green-400"
                    inputmode="numeric" pattern="[0-9]*" required>
            </div>

            <!-- Password -->
            <div class="flex items-center border-b border-gray-500 py-3">
                <i class="fas fa-lock text-gray-500 mr-3"></i>
                <input type="password" name="password" placeholder="Create password"
                    class="w-full bg-transparent placeholder-gray-500 text-black text-lg focus:outline-none focus:border-green-400" required>
            </div>

            <button type="submit"
                class="w-full mt-8 bg-green-500 hover:bg-green-600 text-white py-3 rounded-lg text-lg font-semibold">
                Sign Up
            </button>

            <p class="text-center text-base mt-6 text-black">
                Already have an account?
                <button type="button" class="underline text-green-600 hover:text-green-800" onclick="toggleForm()">Sign In</button>
            </p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Toggle Script -->
    <script>
        function toggleForm() {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const formTitle = document.getElementById('formTitle');

            if (loginForm.classList.contains('hidden')) {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                formTitle.textContent = "Sign In";
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                formTitle.textContent = "Sign Up";
            }
        }

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            const formData = new FormData(this);

            fetch('signInScript.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Welcome!',
                            text: 'Login successful!',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            if (data.role === 'admin') {
                                window.location.href = 'adminDashboard.php';
                            } else if (data.role === 'staff') {
                                window.location.href = 'staffDashboard.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message
                        });
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!'
                    });
                });
        });



        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            const formData = new FormData(this);

            fetch('signUpScript.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            // Switch to Sign In form after successful registration
                            toggleForm();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message
                        });
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!'
                    });
                });
        });
    </script>

    </script>

</body>

</html>