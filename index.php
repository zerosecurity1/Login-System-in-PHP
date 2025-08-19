<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
        }
        .input-field {
            transition: all 0.3s ease;
        }
        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 text-white">
                <h1 class="text-2xl font-bold text-center">Create Your Account</h1>
                <p class="text-blue-100 text-center mt-2">Join our community today</p>
            </div>
            
            <div class="p-6 sm:p-8">

            <?php
            session_start();
                include("config/config.php");
                if(isset($_POST['submit'])){
                    $email = $_POST['email'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");
                    if (mysqli_num_rows($verify_query) !=0 ) {
                        echo"<div class='message'>
                                <p> This email is used, Try another One please</p>
                            </div> <br>";
                        echo "<a href='javascript:self.history.back()'>BACK</a>";
                    }else {
                        $insert = mysqli_query($con, "INSERT INTO users(Email,Username,Password) VALUES('$email','$username','$password')") or die("error");
                         
                        if ($insert) {
                            $user_id = mysqli_insert_id($con);

                            //set session
                            $_SESSION['user_id'] = $user_id;
                            $_SESSION['username'] = $username;
                            $_SESSION['email'] = $email;

                            header("Location: home.php");
                            exit();
                        }
                    }
                }
            ?>

                <form id="registerForm" method="post" class="space-y-5">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" id="email" name="email" 
                                   class="input-field pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border" 
                                   placeholder="your@email.com" required>
                        </div>
                        <div id="email-error" class="error-message">Please enter a valid email address</div>
                    </div>
                    
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" id="username" name="username" 
                                   class="input-field pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border" 
                                   placeholder="cooluser123" minlength="4" maxlength="20" required>
                        </div>
                        <div id="username-error" class="error-message">Username must be 4-20 characters</div>
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" id="password" name="password" 
                                   class="input-field pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border" 
                                   placeholder="••••••••" minlength="8" required>
                            <span id="togglePassword" class="password-toggle">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    
                    <button type="submit" name="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                        Create Account
                    </button>
                </form>
                
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">Already have an account?</span>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="login.html" class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                            Sign In
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-6 text-center text-sm text-gray-600">
            <p>© 2025 Your Company. All rights reserved.</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerForm');
            const passwordInput = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');
            const emailInput = document.getElementById('email');
            const usernameInput = document.getElementById('username');
            
            // Toggle password visibility
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            });
            
            // Real-time validation
            emailInput.addEventListener('input', function() {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailRegex.test(this.value)) {
                    document.getElementById('email-error').style.display = 'none';
                    this.classList.remove('border-red-500');
                }
            });
            
            usernameInput.addEventListener('input', function() {
                if (this.value.length >= 4 && this.value.length <= 20) {
                    document.getElementById('username-error').style.display = 'none';
                    this.classList.remove('border-red-500');
                }
            });
            
            passwordInput.addEventListener('input', function() {
                if (this.value.length >= 8) {
                    document.getElementById('password-error').style.display = 'none';
                    this.classList.remove('border-red-500');
                }
            });
        });
    </script>
</body>
</html>