<?php

function sanitizeFromString($input){
    $input = strip_tags($input);
    $input = str_replace(" ", "", $input);
    $input = strtolower($input);
    $input = ucfirst($input);
    return $input;
}

function sanitizeFormPassword($input){
    $input = strip_tags($input);
    return $input;
}

function sanitizeFormEmail($input){
    $input = strip_tags($input);
    $input = str_replace(" ", "", $input);
    return $input;
}
