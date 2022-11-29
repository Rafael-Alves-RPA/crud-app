<?php
if (isset($_GET["id"])) {
     $id = $_GET["id"];

     //require_once "iconn.php";
     require "conn.php";

     //Create Connection
     //$conn = new conn("localhost", "root", "", "crud2");

     $dbh = new conn();

     $stmt = $dbh->query("DELETE FROM persons WHERE id=$id");
     $stmt->execute();
}
header("location: index.php");
exit;
