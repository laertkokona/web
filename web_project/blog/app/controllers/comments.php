<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/check.php");
include(ROOT_PATH . "/app/helpers/validateComment.php");

$table = 'comments';

$comments = selectAll('comments');

$id = "";
$body = "";

if(isset($_POST['add-comment'])){
    userOnly();
    $errors = validateComment($_POST);

    if (count($errors) === 0) {
        unset($_POST['add-post']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['post_id'] = $
        $_POST['body'] = htmlentities($_POST['body']);

        $comment_id = create($table, $_POST);

        $_SESSION['message'] = "Comment added successfully";
        $_SESSION['type'] = "success";

        header("location: " . BASE_URL . "/admin/posts/index.php");
        exit();
    } else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $category_id = $_POST['category_id'];

    }
    

    
}