<?php
session_start();
include("config/config.php");

if (!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$success = "";
$error = "";

if (isset($_POST['update'])) {
    $new_email = trim($_POST['email']);
    $new_username = trim($_POST['username']);
    $new_password = trim($_POST['password']);

    if(empty($new_email) || empty($new_username)){
        $error = "Email and Username are required!";
    }else {
        if (!empty($new_password)) {
            $update = mysqli_query($con, "UPDATE users SET Email='$new_email', Username='$new_username', Password='$new_password' WHERE id='$user_id'");
        }else{
             $update = mysqli_query($con, "UPDATE users SET Email='$new_email', Username='$new_username' WHERE id='$user_id'");
        }

        if ($update) {
            $_SESSION['email'] = $new_email;
            $_SESSION['username'] = $new_username;
            $success = "Profile updated successfully!";
        }else{
            $error = "Failed to update: " . mysqli_error($con);
        }
    }
}

$result = mysqli_query($con, "SELECT * FROM users WHERE id='$user_id' LIMIT 1");
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Edit Profile</h2>

        <?php if ($success): ?>
            <p class="bg-green-100 text-green-700 px-4 py-2 rounded-lg mb-4 text-center"><?php echo $success; ?></p>
        <?php endif; ?>
        <?php if ($error): ?>
            <p class="bg-red-100 text-red-700 px-4 py-2 rounded-lg mb-4 text-center"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="" method="post" class="space-y-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['Email']); ?>" required 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Username</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($user['Username']); ?>" required 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">New Password (leave blank to keep current)</label>
                <input type="password" name="password" 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>

            <button type="submit" name="update" 
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200 shadow">
                 Update Profile
            </button>
        </form>

        <p class="text-center mt-6">
            <a href="home.php" class="text-blue-600 hover:underline">⬅ Back to Home</a>
        </p>
    </div>

</body>
</html>
