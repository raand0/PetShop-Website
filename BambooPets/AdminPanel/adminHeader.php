<?php
session_start();
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
<nav class="navbar navbar-expand-sm navbar-info bg-info">
    <div class="container">

            <img class="rounded-circle navbar-brand" src="../Logo/Screenshot (13).png" height="70px" alt="Logo">
        
        <button
            class="navbar-toggler d-lg-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId"
            aria-controls="collapsibleNavId"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link active <?php if($current_page == "dashboard.php"){echo'btn btn-primary text-white';}?>" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active <?php if($current_page == "orders.php"){echo'btn btn-primary text-white';}?>" href="orders.php">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active <?php if($current_page == "messages.php"){echo'btn btn-primary text-white';}?>" href="messages.php">Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active <?php if($current_page == "home.php.php"){echo'btn btn-primary text-white';}?>" href="../UserPanel/home.php">Home</a>
                </li>
            </ul>

            <form class="d-flex" method="post">
                <input type="submit" name="logOut" value="Log Out" class="btn btn-danger">
            </form>
            <div class="d-flex align-items-center">
            <p class="h5 text-center mx-2"><?php echo $_SESSION["username"];?></p>
            </div>
        </div>
    </div>
</nav>

<?php
//log out button
if(isset($_POST["logOut"])){
    session_destroy();
    header("Location:../index.php");
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>