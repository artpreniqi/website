<?php
include 'config.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo "Login successful";
            $_SESSION['user_id'] = $row['id']; 
            $_SESSION['user_role'] = $row['role']; 
            if ($row['role'] == 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: user.php");
            }
            exit(); 
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found with this email";
    }

    $sql->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Log in into your account - tsa.com</title>
        <link rel="icon" href="img/icon.jpg" type="image/jpg">
        <link rel="stylesheet" href="login.css">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="goback">
            <button onclick="goBack()">Go Back</button>
        </div>

        <div class="container">
        <img src="img/logo.png" alt="logo">
        <header>Log in</header>
            <form action="user.php" method="POST">
                <div class="field email-field">
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Enter your email" class="email">
                    </div>
                    <span class="error email-error">
                        <i class="bx bx-error-circle error-icon"></i>
                        <p class="error-text">Please enter a valid email</p>
                    </span>
                </div>
                <div class="field enter-password">
                    <div class="input-field">
                        <input type="password" name="password" placeholder="Enter password" class="password">
                        <i class="bx bx-hide show-hide"></i>
                    </div>
                    <span class="error password-error">
                        <i class="bx bx-error-circle error-icon"></i>
                        <p class="error-text">
                        Password is required.</p>
                    </span>
                </div>
                <div class="field role-field">
                    <div class="input-field">
                        <select name="role" class="role">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="input-field button">
                    <input type="submit" value="Log In">
                </div>
            </form>
            <div class="toggle-link">
                Don't have an account? <a a href="signup.html">Sign Up</a>
            </div>
        </div>

        <script src="login.js"></script>
    </body>
</html>
