<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/check.php");
include(ROOT_PATH . "/app/helpers/validatePost.php");

$table = 'posts';

function countValues(){
    countRows($table);
}

$categories = selectAll('categories');
$posts = selectAll($table);
$u_posts = getPosts();

$i = 1;

$pposts = array_slice($u_posts, 0, 5, true);

$errors = array();

$id = "";
$title = "";
$body = "";
$category_id = "";
$published = "";


if(isset($_GET['delete_id'])){
    adminOnly();
    $count = delete($table, $_GET['delete_id']);
    $_SESSION['message'] = "Post deleted successfully";
    $_SESSION['type'] = "success";

    header("location: " . BASE_URL . "/admin/posts/index.php");
    exit();
}

if (isset($_GET['published']) && isset($_GET['p_id'])) {
    adminOnly();
    $published = $_GET['published'];
    $p_id = $_GET['p_id'];

    $count = update($table, $p_id, ['published' => $published]);

    $_SESSION['message'] = "Post publish state successfully";
    $_SESSION['type'] = "success";

    header("location: " . BASE_URL . "/admin/posts/index.php");
    exit();

}

if(isset($_GET['id'])){
    $post = selectOne($table, ['id' => $_GET['id']]);
    $id = $post['id'];
    $title = $post['title'];
    $body = $post['body'];
    $category_id = $post['category_id'];
    $published = $post['published'];
}

if(isset($_POST['add-post'])){
    adminOnly();
    $errors = validatePost($_POST);

    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/materials/images/" . $image_name;

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($result) {
            $_POST['image'] = $image_name;
        } else {
            array_push($errors, "Failed to upload Image");
        }
    } else {
        array_push($errors, "Post Image required");
    }
    

    if (count($errors) === 0) {
        unset($_POST['add-post']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);

        $post_id = create($table, $_POST);

        $_SESSION['message'] = "Post created successfully";
        $_SESSION['type'] = "success";

        header("location: " . BASE_URL . "/admin/posts/index.php");
        exit();
    } else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $category_id = $_POST['category_id'];
        $published = isset($_POST['published']) ? 1 : 0;

    }
    

    
}

if(isset($_POST['update-post'])){
    adminOnly();
    $errors = validatePost($_POST);

    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/materials/images/" . $image_name;

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($result) {
            $_POST['image'] = $image_name;
        } else {
            array_push($errors, "Failed to upload Image");
        }
    } else {
        array_push($errors, "Post Image required");
    }

    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['update-post'], $_POST['id']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);

        $post_id = update($table, $id, $_POST);

        $_SESSION['message'] = "Post updated successfully";
        $_SESSION['type'] = "success";

        header("location: " . BASE_URL . "/admin/posts/index.php");
    } else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $category_id = $_POST['category_id'];
        $published = isset($_POST['published']) ? 1 : 0;

    }
}