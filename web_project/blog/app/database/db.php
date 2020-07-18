<?php

session_start();
require('connect.php');

function dd($value)
{
    echo "<pre>", print_r($value, true), "</pre>";
    die();
}

function executeQuery($sql, $data)
{
    global $conn;
    $stmt = $conn->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt;
}

function countRows($table)
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM $table";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_assoc();
    return $records;
}

function selectAll($table, $cond = [])
{
    global $conn;
    $sql = "SELECT * FROM $table";
    if(empty($cond)){
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }else{

        $i = 0;
        foreach($cond as $key => $value){
            if($i === 0){
                $sql = $sql . " WHERE $key=?";
            } else {
                $sql = $sql . " AND $key=?";
            }
            $i++;
        }
        $stmt = executeQuery($sql, $cond);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
}


function selectOne($table, $cond)
{
    global $conn;
    $sql = "SELECT * FROM $table";
    

    $i = 0;
    foreach($cond as $key => $value){
        if($i === 0){
            $sql = $sql . " WHERE $key=?";
        } else {
            $sql = $sql . " AND $key=?";
        }
        $i++;
    }
    $sql = $sql . " LIMIT 1";

    $stmt = executeQuery($sql, $cond);
    $records = $stmt->get_result()->fetch_assoc();
    return $records;
    
}

function create($table, $data){
    global $conn;
    $sql = "INSERT INTO $table SET ";

    $i = 0;
    foreach($data as $key => $value){
        if($i === 0){
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }
    
    $stmt = executeQuery($sql, $data);
    $id = $stmt->insert_id;
    return $id;

}

function update($table, $id, $data){
    global $conn;
    $sql = "UPDATE $table SET ";

    $i = 0;
    foreach($data as $key => $value){
        if($i === 0){
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }

    $sql = $sql . " WHERE id=?";
    $data['id'] = $id;
    $stmt = executeQuery($sql, $data);
    return $stmt->affected_rows;

}

function delete($table, $id){
    global $conn;
    $sql = "DELETE FROM $table WHERE id=? ";

    $stmt = executeQuery($sql, ['id' => $id]);
    return $stmt->affected_rows;

}

function getPublishedPosts(){
    global $conn;
    $sql = "SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id=users.id WHERE posts.published=?";

    $stmt = executeQuery($sql, ['posts.published' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getPosts(){
    global $conn;
    $sql = "SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id=users.id WHERE users.admin=?";

    $stmt = executeQuery($sql, ['users.admin' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getCategoryPosts($category_id){
    global $conn;
    $sql = "SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id=users.id WHERE posts.published=? AND category_id=?";

    $stmt = executeQuery($sql, ['posts.published' => 1, 'category_id' => $category_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function searchPosts($search){
    
    $matches = '%' . $search . '%';
    global $conn;
    $sql = "SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id=users.id WHERE posts.published=? AND posts.title LIKE ? OR posts.body LIKE ?";;

    $stmt = executeQuery($sql, ['published' => 1, 'title' => $matches, 'body' => $matches]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}
