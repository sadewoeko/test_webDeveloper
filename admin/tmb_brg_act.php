<?php 
include 'config.php';
$kode=$_POST['kode'];
$nama=$_POST['nama'];

$harga=$_POST['harga'];
$jumlah=$_POST['jumlah'];
$sisa=$_POST['jumlah'];

mysqli_query($conn,"insert into barang values('','$kode','$nama','$harga','$jumlah','$sisa')");
header("location:barang.php");

 ?>