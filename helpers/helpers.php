<?php

function sanitizestring($value) {
    $value=trim($value);
    $value=stripslashes($value);
    $value=htmlspecialchars($value);
    return $value;

}
function sanitizeemail($value) {
    return filter_var($value, FILTER_SANITIZE_EMAIL);
}
function sanitizeint($value){
    return filter_var($value,FILTER_SANITIZE_NUMBER_INT);
}


function validaterequired($value){
    return (!empty($value));
}
function validateemail($value){
    return filter_var($value, FILTER_VALIDATE_EMAIL);
}
function validateint($value){
    return filter_var($value, FILTER_VALIDATE_INT);
}