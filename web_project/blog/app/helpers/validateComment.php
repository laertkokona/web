<?php

function validateComment($comment){
    global $conn;
    $errors = array();

    if(empty($comment['body'])){
        array_push($errors, 'Body is required');
    }
}