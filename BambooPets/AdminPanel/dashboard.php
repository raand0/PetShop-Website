<?php
require '../connect.php';
require 'adminHeader.php';
require '../security.php';


//doesnt let regular users access adminpanel.
if($_SESSION["username"] != "rand09"){
    header("Location:../UserPanel/home.php");
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM `pets` WHERE `ID` = :id";
    
    $execute = $db->prepare($sql);
    $execute->bindParam(':id', $id, PDO::PARAM_INT); // Assuming ID is an integer
    
    if ($execute->execute()) {
        // Successfully deleted
        header("Location:dashboard.php");
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .word-wrap {
            word-wrap: break-word; /* Allows long words to be broken and wrap onto the next line */
            overflow-wrap: break-word; /* Newer property for better browser support */
            white-space: normal; /* Ensures that text can wrap */
            max-width: 200px; /* Adjust max width as necessary */
        }
    </style>
</head>
<body>
 
<div class="container mt-3">
    <div class="row">
        <div class="col d-flex justify-content-center">
            <!-- Modal trigger button -->
<button
    type="button"
    class="btn btn-success"
    data-bs-toggle="modal"
    data-bs-target="#modalId"
>
    Add an animal
</button>

<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div
    class="modal fade"
    id="modalId"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    
    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true"
>
    <div
        class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
        role="document"
    >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Add an animal
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
        <form method="post" enctype="multipart/form-data" id="animalForm">
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" name="Pname" class="form-control">
            <label for="age" class="form-label">Age:</label>
            <input type="text" id="age" name="Page" class="form-control">
            <label for="type" class="form-label">Type:</label>
            <select name="Ptype" id="type" class="form-select">
                <option value="" hidden>select</option>
                <option value="Dog & Cat">Dog & Cat</option>
                <option value="Birds">Birds</option>
                <option value="Fish">Fish</option>
                <option value="Other">Other</option>
            </select> <br>
            <label for="price" class="form-label">Price:</label>
            <input type="number" id="price" name="Pprice" class="form-control">
            <label class="form-label" for="detail">Details:</label>
            <textarea class="form-control" name="details" id="detail"></textarea><br>
            <Label class="form-label" for="image">Image:</Label>
            <input type="file" id="image" name="image" class="form-control">
        </form>
            </div>
            <div class="modal-footer">
            <button type="submit" form="animalForm" name="addAnimal" class="btn btn-primary d-block mx-auto btn-lg">Add</button>   
        </div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>


<?php
    if(isset($_POST["addAnimal"])){
        $temp = 0;
        if(text_input($_POST["Pname"]) && no_Number($_POST["Pname"])){
            $petName = $_POST["Pname"];
            $temp++;
        }
        if(is_numeric($_POST["Page"]) && text_input($_POST["Page"])){
            $petAge = $_POST["Page"];
            $temp++;
        }
        if(text_input($_POST["Ptype"])){
            $petType = $_POST["Ptype"];
            $temp++;
        }
        if(text_input($_POST["Pprice"])){
            $petPrice = $_POST["Pprice"];
            $temp++;
        }
        if(comment_R($_POST["details"]) == 0){
            if(text_input($_POST["details"])){
                $detail = $_POST["details"];
                $temp++;
            }
        }
        else{
            $char = comment_R($_POST["details"]);
            echo '
            <div class="alert alert-danger alert-dismissible mt-3">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            Your detail is too long please remove '.$char.' character.
            </div>
            ';
        }
        //checks if a file was uploaded
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $file_type = $_FILES['image']['type'];
            //checks if the file is an image
            if(in_array($file_type, $allowed_types)){
                $petImage = @$_FILES['image']['name'];
                $tmpImgName = @$_FILES['image']['tmp_name'];
                $temp++;
            }
            else{
                echo '
                <div class="alert alert-danger alert-dismissible mt-3">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                Invalid data type, only images are allowed.
                </div>
                ';
            }
        }
        //if all the fields are valid, insert them.
        if($temp == 6){
            $sql = "INSERT INTO `pets` (`Pet_name`, `Pet_age`, `Pet_type`, `image`, `Price`, `Detail`) VALUES ('$petName', '$petAge', '$petType', '$petImage', '$petPrice', '$detail')";
            $execute = $db->prepare($sql);

            if($execute->execute()){
                move_uploaded_file($tmpImgName,"../imgs/$petImage");
                echo '
                <div class="alert alert-success alert-dismissible mt-3">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                Animal added successfully.
                </div>
                ';
            }
        }
        else{
            echo '
            <div class="alert alert-danger alert-dismissible mt-3">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            All of the fields are required and accept valid data.
            </div>
            ';
        }
    }
?>

<hr>

<div class="conainer">
    <div class="card shadow mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" width="100%">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Type</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Detail</th>
                        <th>Delete</th>
                    </tr>

                    <?php
                    $sql = "SELECT * FROM `pets`";

                    $execute = $db->prepare($sql);
                    if($execute->execute()){
                        for($i=0; $row=$execute->fetch(PDO::FETCH_OBJ); $i++){
                            $ID = $row->ID;
                            $PET_NAME = $row->Pet_name;
                            $PET_AGE = $row->Pet_age;
                            $PET_TYPE = $row->Pet_type;
                            $PET_IMAGE = $row->image;
                            $PET_PRICE = $row->Price;
                            $PET_DETAIL = $row->Detail;
                            echo'
                            <tr>
                                <td class="text-center">'.$ID.'</td>
                                <td class="text-center">'.$PET_NAME.'</td>
                                <td class="text-center">'.$PET_AGE.'</td>
                                <td class="text-center">'.$PET_TYPE.'</td>
                                <td><img src="../imgs/'.$PET_IMAGE.'" height="100px" class="d-block mx-auto"></td>
                                <td class="text-center">$'.$PET_PRICE.'</td>
                                <td class="word-wrap">'.$PET_DETAIL.'</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a name="delete" href="?id='.$ID.'" class="btn btn-danger">Delete</a>
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

<script>
    const myModal = new bootstrap.Modal(
        document.getElementById("modalId"),
        options,
    );
</script>
</body>
</html>

<?php
require '../footer.php';
?>