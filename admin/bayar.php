<?php
include 'config.php';

$kode=$_POST['kode'];
$tgl=$_POST['tanggal'];
$nama=$_POST['nama'];
$jumlah=$_POST['jumlah'];
$harga=$_POST['harga'];
$total_harga=$_POST['total_harga'];


// $dt=mysqli_query($conn,"select sum(total_harga) as tot from barang_laku where nama='$nama'");
// $hasil=$data['total_harga'];
$dl=mysqli_query($conn,"insert into pengeluaran values ('','$kode','$tgl','$nama','$jumlah','$harga','$total_harga')")or die(mysql_error());
$dt=mysqli_query($conn,"update barang_laku SET status = '1' where kode = '$kode'");
header("location:barang_laku.php");
?>