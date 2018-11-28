<?
    include './config.php';
    $nama = $_GET['nama'];
    $query = mysqli_query($conn,'select kode,harga from barang where nama="'.$nama.'"');
    $data=mysqli_fetch_array($query,MYSQLI_ASSOC);
    // echo $data['harga'];
    echo json_encode(array('result'=>$data));