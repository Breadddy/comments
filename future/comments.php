<head>
<title>Комментарии</title>
<link rel="shortcut icon" href="inc/logo.jpg" type="image/jpeg">
<link rel="stylesheet" href="style.css">
</head>
<?php
require_once 'inc/class.php';
require_once 'config.php';
session_start();
require_once 'inc/top.php';
echo '<div id="main">';
if(isset($_SESSION['error']))
    {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    $messages=$obj->getComments();
    if ($messages)
    foreach ($messages as $message)
    {
        $datatime=date('H:i d.m.Y',$message['datatime']);
        ?>
        <div id="block">
            <b><label id="labelName"><?=$message['name']?> </b></label> 
            <label id="datatime"><?=$datatime?> </label><br> <!-- echo $message['name'].'<br>'; -->
        </div>
         <div id="showMessage"><?=$message['message']?> </div><br>
   <?php  }
?>
<hr>
<h1 id="DownHeader"> Оставить комментарий</h1>
<form name="comment" action="commenting.php" method="post">
  <p>
  <div id="block">
    <label id="labelName">Ваше имя</label><br>
  </div>
    <input id="inputName" type="text" name="name" value="<?=$_SESSION['data']['name'] ?>" />
  </p>
  <p>
  <div id="block">
    <label id="labelName">Ваш комментарий</label>
  </div>
    <textarea id="message" name="message" > <?=$_SESSION['data']['message'] ?> </textarea>
  </p>
  <p>
    <input id="buttonComment" type="submit" value="Отправить" />
  </p>
</form>
<br><br><br>
</div>
<?php 
require_once 'inc/bottom.php';
unset($_SESSION['data']);
