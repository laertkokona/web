<?php

function validatePost($post){
    global $conn;
    $errors = array();

    if(empty($post['title'])){
        array_push($errors, 'Title is required');
    }

    if(empty($post['body'])){
        array_push($errors, 'Body is required');
    }

    if(empty($post['category_id'])){
        array_push($errors, 'Please select a category');
    }

    $existingPost = selectOne('posts', ['title' => $post['title']]);
    if ($existingPost){
        if (isset($post['update-post']) && $existingPost['id'] != $post['id']) {
            array_push($errors, 'Post with the same title already exists');
        }

        if(isset($post['add-post'])){
            array_push($errors, 'Post with the same title already exists');
        }
    }

    return $errors;
}
