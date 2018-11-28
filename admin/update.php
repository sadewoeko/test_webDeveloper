<?php 
include 'config.php';
$id=$_POST['id'];
$kode=$_POST['kode'];
$nama=$_POST['nama'];
$harga=$_POST['harga'];
$jumlah=$_POST['jumlah'];

mysqli_query($conn,"update barang set kode='$kode', nama='$nama',harga='$harga', jumlah='$jumlah' where id='$id'");
header("location:barang.php");

?>