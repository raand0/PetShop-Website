<?php
require '../connect.php';
require 'adminHeader.php';

if(!isset($_GET["Pid"])){
    header("Location:dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordered</title>
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div>
                    <p class="display-6">Ordered by:</p>
                </div>
                <div>
                    <?php
                    $id = $_GET["ID"];

                    $sql = "SELECT * FROM `orders` WHERE ID = :id";
                    $execute = $db->prepare($sql);

                    $execute->bindParam(':id', $id, PDO::PARAM_INT);
                    
                    $execute->execute();
                    $row = $execute->fetch(PDO::FETCH_OBJ);
                    if ($row) {
                        $username = $row->username;
                        $num = $row->phone_number;
                        $order_time = $row->order_placed;
                    echo '
                    <p class="h5 mt-4">Username:'.$username.'</p>
                    <p class="h5 mt-4">Phone number:'.$num.'</p>
                    <p class="h5 mt-4">Order placed at:'.$order_time.'</p>
                    ';
                    }
                    ?>
                </div>
            </div>
            <div class="col-6">
                <div>
                    <p class="display-6 text-center">Ordered pet:</p>
                </div>
                <div class="d-flex justify-content-center">
                    <?php
                    $Pid = $_GET["Pid"];

                    $sql = "SELECT * FROM `pets` WHERE ID = :Pid";
                    $execute = $db->prepare($sql);

                    $execute->bindParam(':Pid', $Pid, PDO::PARAM_INT);
                    
                    $execute->execute();
                    $row = $execute->fetch(PDO::FETCH_OBJ);
                    if ($row) {
                            $pet_name = $row->Pet_name;
                            $pet_age = $row->Pet_age;
                            $pet_image = $row->image;
                            $pet_price = $row->Price;
                            $detail = $row->Detail;
                        echo '
                        <div class="col-lg-10 col-md-8 col-sm-8">
                            <div class="card">
                            <img class="card-img-top" src="../imgs/'.$pet_image.'" style="height: 200px; object-fit: cover;"/>
                            <div class="card-header h4 text-center bg-warning">'.$pet_name.'</div>
                            <div class="card-body">
                                <p class="card-text h6">Age:'.$pet_age.'</p>
                            </div>
                            <div class="card-footer">
                                <p class="h4">'.$pet_price.'</p>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


</body>
</html>

<?php
require '../footer.php';
?>