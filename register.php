<?php
include "db.php";

if(isset($_POST['register']))
{
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users(fullname, email, password)
            VALUES('$fullname', '$email', '$password')";

    if(mysqli_query($conn, $sql))
    {
        echo "<script>
        alert('Registration Successful!');
        window.location='login.php';
        </script>";
    }
    else
    {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>StudyMate - Register</title>

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


        <!-- Register Title -->

        <div class="auth-title">

            <h2>Create Account ✨</h2>

            <p>Start organizing your study journey today.</p>

        </div>


        <!-- Registration Form -->

        <form method="POST" class="auth-form">

            <div class="auth-group">

                <label>Full Name</label>

                <input
                    type="text"
                    name="fullname"
                    placeholder="Enter your full name"
                    required>

            </div>


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
                    placeholder="Create a password"
                    required>

            </div>


            <button
                type="submit"
                name="register"
                class="auth-btn">

                Create Account →

            </button>

        </form>


        <!-- Login Link -->

        <p class="auth-footer">

            Already have an account?

            <a href="login.php">
                Login Here
            </a>

        </p>

    </div>

</div>

</body>

</html>