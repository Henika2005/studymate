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
        echo "<script>alert('Registration Successful!');</script>";
    }
    else
    {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>StudyMate - Register</title>
</head>
<body>

    <h2>StudyMate Registration</h2>

    <form method="POST">

        <label>Full Name</label><br>
        <input type="text" name="fullname" required><br><br>

        <label>Email</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit" name="register">
            Register
        </button>

    </form>

</body>
</html>