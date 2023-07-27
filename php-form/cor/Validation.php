<?php

function minVal($in,$n){
if (strlen($in)>$n ){
    return true;
}
return false;
}

function maxVal($in,$x){
    if (strlen($in)<$x) {
        return true;
        }
        return false;
}

function emailVal($email){
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
      }
    return false;
}