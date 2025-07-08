<?php
include 'security.php';
require 'connect.php';
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" href="imgs/Screenshot (13).png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-6 col-lg-4">
            <h4 class="text-center">Sign Up</h4>
            <p class="text-center">Create an account</p>
            <form action="" method="post">
            <div class="form-floating mb-3 mt-3">
            <input type="text" id="userLabel" placeholder="Enter email" name="username" class="form-control">
            <label for="userLabel">Username:</label>
            </div>
            <div class="form-floating mb-3 mt-3">
            <input type="password" id="passLabel" placeholder="Enter Password" name="password" class="form-control">
            <label for="passLabel" class="form-label">Password</label>
            </div>
            <input type="submit" name="signUp" value="Sign Up" class="btn btn-primary form-control">
            Already have an account?<a href="index.php" class="small"> Login.</a>
            </form>
        </div>
    </div>
</div>

<?php
if(isset($_POST["signUp"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $temp = false;
    if(text_input($username) & username_R($username)){
        $temp = true;
    }
    else{
        echo '
        <div class="alert alert-danger alert-dismissible mt-3">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        Username is required and should contain numbers and be bigger than 3 characters.<br>
        </div>
        ';
    }
    if(password_input($password) && password_R($password) && $temp==true){
        $_SESSION["username"] = $username;
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`Username`, `Password`) VALUES ('$username', '$hashed_pass')";
        $execute = $db->prepare($sql);
        if($execute->execute()){
            echo '
            <div class="alert alert-success alert-dismissible mt-3">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            Account created successfully! <a href="index.php" class="alert-link">try login now.</a>
            </div>
            ';
        }
    }   
    else{
        echo '
        <div class="alert alert-danger alert-dismissible mt-3">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        Password is required and should contain numbers and be bigger than 7 characters.
        </div>
        ';
    }
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>