<?php 
include "config.php";
class comments 
{   
    public $mysqli; 

    function __construct()
    {
        $this->mysqli = new mysqli(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
        $this->mysqli->set_charset("utf8");
    }
    function clearString($string)
    {
        return $this->mysqli->escape_string(strip_tags(trim($string)));
    }
    function addComment($name, $message)
    {
        $datatime=time();
        if ($stmt = $this->mysqli->prepare("INSERT INTO comments (name, message, datatime) VALUES (?, ?, ?)")) 
        {
            $stmt->bind_param("ssi", $name, $message, $datatime);
            $stmt->execute();
            if (!empty($stmt->error))
                { //echo $stmt->error;
                  $stmt->close();
                  return false;
                }
            $id = $stmt->insert_id;
            $stmt->close();
        }
        return $id;
    }
    function getComments() 
    {
        $quest = "SELECT id, name, name, message, datatime FROM comments ORDER BY datatime DESC limit 100";
        if(!$result = $this->mysqli->query($quest))
            return false;
        $items = mysqli_fetch_all($result, MYSQLI_ASSOC); 
        mysqli_free_result($result);
        return $items;
    }
}
