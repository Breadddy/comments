<?php
    require_once 'inc/class.php';
    require_once 'config.php';
    $data['name']=$obj->clearString($_POST['name']);
    $data['message'] = $obj->clearString($_POST['message']);
    if(!empty($data['name']) && !empty($data['message']))
        $data['result'] = $obj->addComment($data['name'], $data['message']);
    if(!$data['result'])
    {
        session_start();
        $_SESSION['error']='Не удалось отправить сообщение';
        $_SESSION['data']=$data;
    }
    header("Location: comments.php");
?>