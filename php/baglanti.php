<?php
$servername="localhost";
$username="root";
$password="";
$dbname="gorsel_donusturucu";

$conn=new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
   return die("Connection Failed: ". $conn->connect_error);    
}
?>