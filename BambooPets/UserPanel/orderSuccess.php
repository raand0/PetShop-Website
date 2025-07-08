<?php
require 'header.php';

//doesnt let users access this page
if(!isset($_GET["m"])){
    header("Location:home.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successfully placed</title>
</head>
<body>

<?php
echo '
<div class="mt-5 alert alert-success alert-dismissible mt-3">
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
You placed an order successfully, we will call you soon.
</div>
';
?>
<div class="container mt">
    <div class="row mt-5">
        <div class="col">
            <a href="home.php" class="btn btn-lg btn-outline-success text-black w-25 d-block mx-auto">Go back to home</a>
        </div>
    </div>
</div>
    
</body>
</html>

<?php
require '../footer.php';
?>