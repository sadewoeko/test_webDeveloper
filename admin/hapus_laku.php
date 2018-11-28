<?php 
include 'config.php';
include 'admin/config.php';
$id=$_GET['id'];
mysqli_query($conn,"delete from barang_laku where id='$id'");
// $b=mysqli_fetch_array($a);
// $kembalikan=$b['jumlah']+$jumlah;
// $c=mysqli_query($conn,"update barang set jumlah='$kembalikan' where nama='$nama'");
// mysqli_query("delete from barang_laku where id='$id'");
header("location:barang_laku.php");

 ?>