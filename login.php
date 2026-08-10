<?php
include "db.php";

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0)
    {
        session_start();

        $row = mysqli_fetch_assoc($result);

        $_SESSION['fullname'] = $row['fullname'];

        header("Location: home.php");
        exit();
    }
    else
    {
        echo "<script>alert('Invalid Email or Password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>StudyMate - Login</title>

    <link rel="stylesheet" href="style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>

<body class="auth-page">

<div class="auth-container">

    <div class="auth-card">

        <!-- Logo -->

        <div class="auth-logo">
            📚
        </div>

        <h1>StudyMate</h1>

        <p class="auth-subtitle">
            Your Smart Study Planner
        </p>


        <!-- Login Title -->

        <div class="auth-title">

            <h2>Welcome Back 👋</h2>

            <p>Login to continue your study journey.</p>

        </div>


        <!-- Login Form -->

        <form method="POST" class="auth-form">

            <div class="auth-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    required>

            </div>


            <div class="auth-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required>

            </div>


            <button
                type="submit"
                name="login"
                class="auth-btn">

                Login →

            </button>

        </form>


        <!-- Register Link -->

        <p class="auth-footer">

            Don't have an account?

            <a href="register.php">
                Register Here
            </a>

        </p>

    </div>

</div>

</body>

</html>