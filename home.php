<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full text-center">
        <div class="mb-6">
            <div class="w-20 h-20 mx-auto rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white text-3xl font-bold shadow-lg">
                <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
            </div>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Welcome, 
            <span class="text-blue-600"><?php echo htmlspecialchars($_SESSION['username']); ?></span>!
        </h2>
        <p class="text-gray-600 mt-2">Your email: 
            <span class="font-medium"><?php echo htmlspecialchars($_SESSION['email']); ?></span>
        </p>

        <div class="mt-6 flex flex-col space-y-3">
            <a href="edit.php" 
               class="w-full py-2 px-4 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition duration-200">
                Edit Profile
            </a>
            <a href="logout.php" 
               class="w-full py-2 px-4 bg-red-500 text-white rounded-lg shadow hover:bg-red-600 transition duration-200">
                Logout
            </a>
        </div>
    </div>

</body>
</html>
