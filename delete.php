<?php
if (isset($_GET["id"])) {
     $id = $_GET["id"];

     
     require_once "iconn.php";
     require_once "conn.php";

     //Create Connection
     //$conn = new conn("localhost", "root", "", "crud2");

     $conn = new conn("us-cdbr-east-06.cleardb.net", "heroku_c6d76a1a0db8ac9", "bf87fbf69295b7", "64613672");

     $sql = "DELETE FROM persons WHERE id=$id";
     $conn->query($sql);
}
header("location: index.php");
exit;
