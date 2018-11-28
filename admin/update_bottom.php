<?
    include './config.php';
    $nama = $_GET['id'];
    $query = mysqli_query($conn,'update jumlah from barang_laku where nama="'.$nama.'"');
    $data=mysqli_fetch_array($query,MYSQLI_ASSOC);
    // echo $data['harga'];
    echo json_encode(array('result'=>$data));