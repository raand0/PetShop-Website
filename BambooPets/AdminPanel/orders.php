<?php
require '../connect.php';
require 'adminHeader.php';


//doesnt let regular users access adminpanel.
if($_SESSION["username"] != "rand09"){
    header("Location:../UserPanel/home.php");
}

//delete button
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM `orders` WHERE `ID` = :id";
    
    $execute = $db->prepare($sql);
    $execute->bindParam(':id', $id, PDO::PARAM_INT); // Assuming ID is an integer
    
    if ($execute->execute()) {
        // Successfully deleted
        header("Location:orders.php");
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="conainer">
    <div class="card shadow mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" width="100%">
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Phone Number</th>
                        <th>Pet ID</th>
                        <th>Ordered Time</th>
                        <th>Delete</th>
                    </tr>

                    <?php
                    $sql = "SELECT * FROM `orders`";

                    $execute = $db->prepare($sql);
                    if($execute->execute()){
                        for($i=0; $row=$execute->fetch(PDO::FETCH_OBJ); $i++){
                            $ID = $row->ID;
                            $USERNAME = $row->username;
                            $PHONE_NUM = $row->phone_number;
                            $PET_ID = $row->pet_id;
                            $ORDER_TIME = $row->order_placed;
                            echo'
                            <tr>
                                <td class="text-center">'.$ID.'</td>
                                <td class="text-center">'.$USERNAME.'</td>
                                <td class="text-center">'.$PHONE_NUM.'</td>
                                <td class="text-center">'.$PET_ID.'</td>
                                <td class="text-center">'.$ORDER_TIME.'"</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a name="delete" href="?id='.$ID.'" class="btn btn-danger me-3">Delete</a>
                                        <a name="find" href="orderedPet.php?Pid='.$PET_ID.'&ID='.$ID.'" class="btn btn-success">Expand</a>
                                    </div>
                                </td>
                            </tr>
                            ';
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<button id="Scroll" style="display: none;">▲</button>
<script src="../scButton.js"></script>

</body>
</html>

<?php
require '../footer.php';
?>