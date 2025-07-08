<?php
require 'header.php';

//doesnt let users access the page if they are not logged in
if(!isset($_SESSION["username"])){
    header("Location:../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col mt-4">
                <h3><span class="badge bg-dark">About us</span></h3>
                <p class="mt-3">
                Welcome to Bamboo Petshop! We're all about helping you find the perfect pet companion. Whether you’re looking for a playful puppy, a cuddly kitten, or a friendly bird, we’ve got you covered.

We believe every pet deserves a loving home, and we're here to make that happen. From pet adoption to supplies, we’ve got everything to keep your furry (or feathered) friends happy and healthy.

Feel free to drop by, say hi, and meet our amazing team. We love what we do, and we can’t wait to help you find your new best friend!
                </p>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
require '../footer.php';
?>