<?php
require '../connect.php';
require 'header.php';
require '../security.php';

//doesnt let users access this page
if(!isset($_GET["iD"])){
    header("Location:home.php");
}

$pet_ID = $_GET["iD"];
if (isset($_POST["Buy"])) {
    $phone = $_POST['phone'];
    $time = date('Y-m-d H:i:s');

    $pattern = "/^[0-9]{11}$/";

    if(!empty($phone)){
        if (preg_match($pattern, $phone)) {
            if(text_input($phone)){
                $username = $_SESSION["username"];
                $sql = "INSERT INTO `orders`(`username`,`phone_number`,`pet_id`,`order_placed`) VALUES ('$username','$phone','$pet_ID','$time')";
                $execute = $db->prepare($sql);
                if($execute->execute()){
                    header("Location:orderSuccess.php?m=true");
                }
                else{
                    echo '
                    <div class="alert alert-danger alert-dismissible mt-3">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    Error occured.
                    </div>
                    ';
                }
            }
        } else {
            echo '
                <div class="alert alert-danger alert-dismissible mt-3">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                Invalid phone number. Please enter a valid number.
                </div>
                ';
        }
    }
    else{
        echo '
            <div class="alert alert-danger alert-dismissible mt-3">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            Phone number is required.
            </div>
            ';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy</title>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8">
                <form class="mt-5 text-center" method="post">
                    <label class="form-label h5" for="pn">Enter a phone number:</label>
                    <input type="tel" id="pn" name="phone" placeholder="Enter a phone number" class="form-control mt-2">
                    <input type="submit" class="btn btn-success btn-lg d-block mx-auto mt-3" name="Buy" value="Buy">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
            <?php
            $PET_IMAGE = $_GET["img"];
            $PET_AGE = $_GET["age"];
            $PET_NAME = $_GET["name"];
            $PET_PRICE = $_GET["price"];
            echo'
                <div class="col-sm-12 col-lg-4 col-md-6 mt-5">
                    <div class="card">
                    <img class="card-img-top" src="../imgs/'.$PET_IMAGE.'" style="height: 200px; object-fit: cover;"/>
                        <div class="card-header h4 text-center bg-warning">'.$PET_NAME.'</div>
                    <div class="card-body">
                        <p class="card-text h6">Age: '.$PET_AGE.'</p>
                    </div>
                    <div class="card-footer">
                        <p class="h4 d-inline">$'.$PET_PRICE.'</p>
                    </div>
                    </div>
                </div>
            ';
            ?>
            </div>
        </div>
    </div>
    
    
</body>
</html>

<?php
require '../footer.php';
?>