<?php
include "config.php";

$kode = $_POST['kode'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];
$total_harga = $jumlah * $harga;

$dt=mysqli_query($conn,"update barang_laku SET jumlah = '$jumlah', total_harga = '$total_harga' where kode='$kode'");


header("location:barang_laku.php");

