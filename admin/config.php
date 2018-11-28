<?php 
// $connect_error = 'sorry, we\'re expriencing connection issues. ';
// $con = mysqli_connect('localhost', 'root')
// mysqli_select_db('POS') or die($connect_error)
$host="localhost";
$username="root";
$password="";
$db_name="pos";
$conn = mysqli_connect($host, $username, $password) or die("cannot connect"); 
mysqli_select_db($conn, $db_name) or die("cannot select DB");
// mysqli_connect("localhost","root");
// mysqli_select_db("pos");
?>