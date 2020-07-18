<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/check.php");
include(ROOT_PATH . "/app/helpers/validateCategory.php");
// require(ROOT_PATH . "/app/helpers/Post.php");


$table = 'categories';

function countValues(){
    countRows($table);
}

$categories = selectAll($table);

$errors = array();

$id = '';
$name = '';
$description = '';


if(isset($_POST['add-category'])){
    adminOnly();
    $errors = validateCategory($_POST);

    if(count($errors) === 0){
        unset($_POST['add-category']);
        $category_id = create($table, $_POST);
        $_SESSION['message'] = 'Category created successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/categories/index.php');
        exit();
    } else {
        $name = $_POST['name'];
        $description = $_POST['description'];
    }

    
}


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $category = selectOne($table, ['id' => $id]);
    $id = $category['id'];
    $name = $category['name'];
    $description = $category['description'];
}

if(isset($_GET['del_id'])){
    adminOnly();
    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Category deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/categories/index.php');
    exit();
}

if(isset($_POST['update-category'])){
    adminOnly();
    $errors = validateCategory($_POST);

    if(count($errors) === 0){
        $id = $_POST['id'];
        unset($_POST['update-category'], $_POST['id']);

        $category_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'Category updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/categories/index.php');
        exit();
    } else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
    }
    
}