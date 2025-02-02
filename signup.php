<?php

include 'config.php';

if(isset($_POST['submit'])) {

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    } elseif ($password !== $confirm_password) {
        echo "Passwords do not match.";
    } elseif (strlen($password) < 8) {
        echo "Password must be at least 8 characters long.";
    } else {
     
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    
        $sql = "INSERT INTO users (email, password, role) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($email, $hashed_password, $role);

        if ($stmt->execute()) {
          
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign up your account - tsa.com</title>
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
        <header>Signup</header>
            <form action="login.php" method="POST">
                <div class="field email-field">
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Enter your email" class="email">
                    </div>
                    <span class="error email-error">
                        <i class="bx bx-error-circle error-icon"></i>
                        <p class="error-text">Please enter a valid email</p>
                    </span>
                </div>
                <div class="field create-password">
                    <div class="input-field">
                        <input type="password" name="password" placeholder="Create password" class="password">
                        <i class="bx bx-hide show-hide"></i>
                    </div>
                    <span class="error password-error">
                        <i class="bx bx-error-circle error-icon"></i>
                        <p class="error-text">
                        Please enter atleast 8 charatcer with number, symbol, small and
                        capital letter.</p>
                    </span>
                </div>
                <div class="field confirm-password">
                    <div class="input-field">
                        <input type="password" name="confirm_password" placeholder="Confirm password" class="cPassword">
                        <i class="bx bx-hide show-hide"></i>
                    </div>
                    <span class="error cPassword-error">
                        <i class="bx bx-error-circle error-icon"></i>
                        <p class="error-text">Password don't match</p>
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
                    <input type="submit" value="Sign Up">
                </div>
            </form>
            <div class="toggle-link">
                Don't have an account? <a a href="login.php">Log In</a>
            </div>
        </div>

        <script src="script.js"></script>
    </body>
</html>
