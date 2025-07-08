<?php
require 'header.php';
require '../connect.php';
require '../security.php';

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
    <title>Comment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col">
            <form method="post">
                <label for="comm" class="form-label mt-4 h5">Leave a Comment:</label>
                <textarea rows="4" class="form-control shadow" name="comment" id="comm" maxlength="255"></textarea>
                <input type="submit" name="send" value="Send" class="btn btn-outline-dark mt-3 d-block mx-auto">
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST["send"])){
        $comment = $_POST["comment"];
        if(comment_R($comment) == 0){
            //its not too long insert it into database
            if(text_input($comment)){
                $username = $_SESSION["username"];
                $time = date('Y-m-d H:i:s');
                $sql = "INSERT INTO `messages` (`username`, `message`, `sent_time`) VALUES ('$username', '$comment', '$time')";
                $execute = $db->prepare($sql);
                if($execute->execute()){
                    echo '
                    <div class="alert alert-success alert-dismissible mt-3">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    Message sent successfully!.
                    </div>
                    ';
                }
            }
        }
        else{
            $char = comment_R($comment);
            echo '
            <div class="alert alert-danger alert-dismissible mt-3">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            Your message is too long please remove '.$char.' character.
            </div>
            ';
        }
    }
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
require '../footer.php';
?>