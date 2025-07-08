<?php
require '../connect.php';
require 'adminHeader.php';

//doesnt let regular users access adminpanel.
if($_SESSION["username"] != "rand09"){
    header("Location:../UserPanel/home.php");
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM `messages` WHERE `ID` = :id";
    
    $execute = $db->prepare($sql);
    // Bind the ID parameter
    $execute->bindParam(':id', $id, PDO::PARAM_INT); // Assuming ID is an integer
    
    if ($execute->execute()) {
        // Successfully deleted
        header("Location:messages.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
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
                        <th>Name</th>
                        <th>Message</th>
                        <th>Time</th>
                        <th>Delete</th>
                    </tr>

                    <?php
                    $sql = "SELECT * FROM `messages`";

                    $execute = $db->prepare($sql);
                    if($execute->execute()){
                        for($i=0; $row=$execute->fetch(PDO::FETCH_OBJ); $i++){
                            $ID = $row->ID;
                            $NAME = $row->username;
                            $MESSAGE = $row->message;
                            $TIME = $row->sent_time;
                            echo'
                            <tr>
                                <td class="text-center">'.$ID.'</td>
                                <td class="text-center">'.$NAME.'</td>
                                <td class="text-center">'.$MESSAGE.'</td>
                                <td class="text-center">'.$TIME.'</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a class="btn btn-danger" href="?id='.$ID.'">Delete</a>
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