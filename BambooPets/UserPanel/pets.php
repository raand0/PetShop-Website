<?php
require 'header.php';
require '../connect.php';

//doesnt let users access the page if they are not logged in
if(!isset($_SESSION["username"])){
    header("Location:../index.php");
}

if(!isset($_GET["category"])){
$_GET["category"] = 0;
}
if(isset($_POST["reset"])){
    header("Location:pets.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<form method="post">
<div class="d-flex justify-content-center mt-3">
    
    <div class="dropdown  me-2">
        <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown">
            Category
        </button>
        <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="?category=1">Dog & Cats</a></li>
            <li><a class="dropdown-item" href="?category=2">Birds</a></li>
            <li><a class="dropdown-item" href="?category=3">Fish</a></li>
            <li><a class="dropdown-item" href="?category=4">Other</a></li>
        </ul>
    </div>

    <button type="submit" name="reset" class="btn btn-danger <?php if($_GET["category"]==0){echo 'd-none';}?>">Reset</button>
</div>
</form>


<div class="container mt-3">
    <div class="row">
        <?php
    $sql = "SELECT * FROM `pets`";
        
    //checks the category
    switch($_GET["category"]){
        case 1: $sql = "SELECT * FROM `pets` WHERE Pet_type = 'Dog & Cat'"; break;
        case 2: $sql = "SELECT * FROM `pets` WHERE Pet_type = 'Birds'"; break;
        case 3: $sql = "SELECT * FROM `pets` WHERE Pet_type = 'Fish'"; break;
        case 4: $sql = "SELECT * FROM `pets` WHERE Pet_type = 'Other'"; break;
    }

    $execute = $db->prepare($sql);
    
    if($execute->execute()){
        for($i=0; $row=$execute->fetch(PDO::FETCH_OBJ); $i++){
            $ID = $row->ID;
            $PET_NAME = $row->Pet_name;
            $PET_AGE = $row->Pet_age;
            $PET_IMAGE = $row->image;
            $PET_PRICE = $row->Price;
            $PET_DETAIL = $row->Detail;
            echo'
                <div class="col-sm-12 col-lg-4 col-md-6">
                    <div class="card">
                    <img class="card-img-top" src="../imgs/'.$PET_IMAGE.'" style="height: 200px; object-fit: cover;"/>
                        <div class="card-header h4 text-center bg-warning">'.$PET_NAME.'</div>
                    <div class="card-body">
                        <p class="card-text h6">Age: '.$PET_AGE.'</p>
                    </div>
                    <div class="card-footer">
                        <p class="h4 d-inline">$'.$PET_PRICE.'</p>
                        <!-- Button trigger modal -->
                            <button
                                type="button"
                                class="btn btn-dark float-end"
                                data-bs-toggle="modal"
                                data-bs-target="#modalId'.$ID.'"
                            >
                                Details >
                            </button>

                            <!-- Modal -->
                            <div
                                class="modal fade"
                                id="modalId'.$ID.'"
                                tabindex="-1"
                                role="dialog"
                                aria-labelledby="modalTitleId"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitleId">
                                                Details
                                            </h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"
                                            ></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                '.$PET_DETAIL.'
                                                <br>
                                                <br>
                                                <hr>
                                                <h6>If you have any questions please contact us through this number: 0770 456 7890.</h6>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex flex-column" style="height: 120px;">
                                            <h5>Do you want to buy this pet?</h5>
                                            <div class="d-flex">
                                            <a class="btn btn-primary btn-lg me-5" href="buy.php?iD='.$ID.'&img='.$PET_IMAGE.'&name='.$PET_NAME.'&age='.$PET_AGE.'&price='.$PET_PRICE.'">Yes</a>
                                            <button type="button" data-bs-dismiss="modal" class="btn btn-danger btn-lg">no</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </div>
                </div>
            ';
        }
    }
        ?>
    </div>
</div>

<button id="Scroll" style="display: none;">▲</button>
<script src="../scButton.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
require '../footer.php';
?>