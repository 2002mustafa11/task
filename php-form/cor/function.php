<?php
function request($method){
    if ($_SERVER['REQUEST_METHOD'] == $method) {
        return true;
        }
return false;
}

function input($name){
if (isset($_POST[$name])) {
    return true;
}
return false;
}

function test_input($data) {
    return htmlspecialchars(htmlentities(stripslashes(trim($data))));
}

function redirect($path){
    header("Location:$path");
    exit;
}