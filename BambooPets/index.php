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
    <title>Login</title>
    <link rel="icon" href="imgs/Screenshot (13).png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    </style>
</head>
<body>


<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-6 col-lg-4" id="login">
            <h4 class="text-center">Login</h4>
            <form action="" method="post">
            <div class="form-floating mb-3 mt-3">
            <input type="text" id="userLabel" placeholder="Enter email" name="username" class="form-control">
            <label for="userLabel">Username:</label>
            </div>
            <div class="form-floating mb-3 mt-3">
            <input type="password" id="passLabel" placeholder="Enter Password" name="password" class="form-control">
            <label for="passLabel" class="form-label">Password</label>
            </div>
            <input type="submit" name="Login" value="Login" class="btn btn-primary form-control">
            <p>Don't have an account?<a href="signUp.php" class="small"> Signup.</a></p>
            </form>
        </div>
    </div>
</div>

<?php
if(isset($_POST["Login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    //admin info
    $admin_user = "admin";
    $admin_pass = "admin";

    $temp = false;

    //check if its admin
    if($username == $admin_user && $password == $admin_pass){
        $_SESSION["username"] = $admin_user;
        header("Location:AdminPanel/dashboard.php");
    }
    else{
        if(text_input($username) & username_R($username)){
            $temp = true;
        }
        else{
            echo '
            <div class="alert alert-danger alert-dismissible mt-3">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            Username is required and should contain numbers in it and have a length more than 3 characters.<br>
            </div>
            ';
            $temp = true;
        }                                   
        if(password_input($password) && password_R($password) && $temp==true){
            $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
            $sql = "SELECT * FROM `users` WHERE `Username` = :username";
            $execute = $db->prepare($sql);
            $execute->bindParam(':username', $username);
            $execute->execute();
            $user = $execute->fetch(PDO::FETCH_ASSOC);
    
            if ($user) {
                if (password_verify($password, $user['Password'])) {
                    $_SESSION["username"] = $username;
                    header("Location:UserPanel/home.php");
                } 
                else {
                    echo '
                    <div class="alert alert-danger alert-dismissible mt-3">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    Wrong password.
                    </div>
                    ';
                }
            } 
            else {
                echo '
                <div class="alert alert-danger alert-dismissible mt-3">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                Username does not exist.
                </div>
                ';
            }
        }   
        else{
            echo '
            <div class="alert alert-danger alert-dismissible mt-3">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            Password is required and should contain numbers in it and have a length more than 7 characters.
            </div>
            ';
        }
    }

    
}
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>