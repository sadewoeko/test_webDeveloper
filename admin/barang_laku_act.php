<?php 

include 'config.php';
$kode=$_POST['kode'];
$tgl=$_POST['tgl'];
$nama=$_POST['nama'];
$harga=$_POST['harga'];
$jumlah=$_POST['jumlah'];
$status=$_POST['status'];

$dt=mysqli_query($conn,"select * from barang where nama='$nama'");
$data=mysqli_fetch_array($dt);
$sisa=$data['jumlah']-$jumlah;
mysqli_query($conn,"update barang set jumlah='$sisa' where nama='$nama'");

$dt=mysqli_query($conn,"select * from barang_laku where nama='$nama'");
$data=mysqli_fetch_array($dt);
// var_dump($dt);
$total_harga=$harga*$jumlah;
mysqli_query($conn,"insert into barang_laku values('','$kode','$tgl','$nama','$jumlah','$harga','$total_harga','$status')")or die(mysql_error());

// $modal=$data['modal'];
// $laba=$harga-$modal;
// $labaa=$laba*$jumlah;
// $total_harga=$harga*$jumlah;
// mysqli_query($conn,"insert into barang_laku values('','$tgl','$nama','$jumlah','$harga','$total_harga','$labaa')")or die(mysql_error());
header("location:barang_laku.php");

?>