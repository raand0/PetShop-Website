<?php

//cleans a string
function text_input($text){
    if(empty($text)){
        return false;
    }
    else{
        trim($text);
        htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        filter_var($text, FILTER_SANITIZE_STRING);
        stripslashes($text);
        return true;
    }
        
    return false;
}

//cleans a password
function password_input($pass){
    trim($pass);
    if(empty($pass)){
        return false;
    }
    return true;
}

//username requirments
function username_R($text){
    if (preg_match('/[0-9]/', $text)) {
        if(strlen($text) > 4){
            return true;
        }
    }
    return false;
}

//password requirements
function password_R($pass){
    if (preg_match('/[0-9]/', $pass)) {
        if(strlen($pass) >= 8){
            return true;
        }
    }
    return false;
}

//checks the comment textarea if its too long.
function comment_R($txt){
    if(strlen($txt) > 255){
        $tmp = strlen($txt)-255;
        return $tmp;
    }
    return 0;
}

//do not let a string contain numbers.
function no_Number($txt){
    if (preg_match('/[0-9]/', $txt)) {
        return false;
    }
    else {
        return true;
    }
    return false;
}
?>