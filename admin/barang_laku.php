<?php include 'header.php';	?>

<h3> Data Barang Terjual</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span>Tambah</button>
<form action="" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
		<select type="submit" name="tanggal" class="form-control" onchange="this.form.submit()">
			<option>Pilih tanggal ..</option>
			<?php 
			$pil=mysqli_query($conn,"select distinct tanggal from barang_laku order by tanggal desc");
			while($p=mysqli_fetch_array($pil)){
				?>
				<option><?php echo $p['tanggal'] ?></option>
				<?php
			}
			?>			
		</select>
	</div>

</form>
<br/>
<?php 
if(isset($_GET['tanggal'])){
	$tanggal=mysqli_real_escape_string($conn,$_GET['tanggal']);
	$tg="lap_barang_laku.php?tanggal='$tanggal'";
	?><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a><?php
}else{
	$tg="lap_barang_laku.php";
}
?>

<br/>
<?php 
if(isset($_GET['tanggal'])){
	echo "<h4> Data Penjualan Tanggal  <a style='color:blue'> ". $_GET['tanggal']."</a></h4>";
}
?>
<table class="table">
	<tr>
		<th>No</th>
		<!-- <th>kode</th> -->
		<th>Tanggal</th>
		<th>Nama Barang</th>
		<th>Harga</th>
		<th>Jumlah</th>
		<th>Total Harga</th>						
		<th>Opsi</th>
	</tr>
	<?php 
	if(isset($_GET['tanggal'])){
		$tanggal=mysqli_real_escape_string($conn,$_GET['tanggal']);
		$brg=mysqli_query($conn,"select * from barang_laku where status = 1 and tanggal like '$tanggal' order by tanggal desc");
	}else{
		$brg=mysqli_query($conn, "select * from barang_laku where status = 0 order by tanggal desc");
	}
	$no=1;
	while($b=mysqli_fetch_array($brg)){

		?>
		<tr>
			<form method="POST" action="update_barang_laku.php">
			<td><?php echo $no++ ?></td>
			<input type="hidden" name="kode" value="<?php echo $b['kode'] ?>" />
			<td><?php echo $b['tanggal'] ?></td>
			<td><?php echo $b['nama'] ?></td>
			<input type="hidden" name="harga" value="<?php echo $b['harga'] ?>" />
			<td>Rp.<?php echo number_format($b['harga']) ?>,-</td>
			<td>
				<input type="text" name="jumlah" value="<?php echo $b['jumlah'] ?>" style="width: 30px;">
				<input type="submit" class="btn btn-default pull-right" value="update">
					<!-- <?php echo $b['jumlah'] ?> -->
			</td>
			<td>Rp.<?php echo number_format($b['total_harga']) ?>,-</td>			
			<td>		
				<!-- <a href="edit_laku.php?id=<?php echo $b['id']; ?>" class="btn btn-warning">Edit</a> -->
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ 
					location.href='hapus_laku.php?id=<?php echo $b['id']; ?>&jumlah=<?php echo $b['jumlah'] ?>&nama=<?php echo $b['nama']; ?>' 
					}" class="btn btn-danger">Hapus</a>
			</td>
			</form>
		</tr>

		<?php 
	}
	?>
	<tr>
		<td colspan="5">Total Bayar</td>
		<td>
		<?php 
		if(isset($_GET['tanggal'])){
			$tanggal=mysqli_real_escape_string($conn,$_GET['tanggal']);
			$x=mysqli_query($conn,"select sum(total_harga) as total from barang_laku where status = 1 and tanggal='$tanggal'");	
			$xx=mysqli_fetch_array($x);			
			echo "<td><b> Rp.". number_format($xx['total']).",-</b></td>";
		}else{
			$x=mysqli_query($conn, "select sum(total_harga) as total from barang_laku where status = 0");	
			$xx=mysqli_fetch_array($x);			
			echo "<b> Rp.". number_format($xx['total']).",-</b>";
		}

		?>
		</td>
		<td>
		<?php			
		
		$brg=mysqli_query($conn,"select * from barang_laku where status = '0'");
		$no=1;
		$c=mysqli_fetch_array($brg);

		?>
		<form method="POST" action="bayar.php">
			<input type="hidden" name="kode" value="<?php echo $c['kode'] ?>" />
			<input type="hidden" name="tanggal" value="<?php echo $c['tanggal'] ?>" />
			<input type="hidden" name="nama" value="<?php echo $c['nama'] ?>" />
			<input type="hidden" name="harga" value="<?php echo $c['harga'] ?>" />
			<input type="hidden" name="jumlah" value="<?php echo $c['jumlah'] ?>" />
			<input type="hidden" name="total_harga" value="<?php echo $c['total_harga'] ?>" />
		
			<input type="submit" class="btn btn-default pull-right" value="Bayar">
		</form>
		</td>
		
	</tr>
	<!-- <tr>
		<td colspan="7">Total Laba</td>
		<?php 
		if(isset($_GET['tanggal'])){
			$tanggal=mysqli_real_escape_string($_GET['tanggal']);
			$x=mysqli_query($conn,"select sum(laba) as total from barang_laku where tanggal='$tanggal'");	
			$xx=mysqli_fetch_array($x);			
			echo "<td><b> Rp.". number_format($xx['total']).",-</b></td>";
		}else{

		}

		?>
	</tr> -->
</table>

<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Beli
				</div>
				<div class="modal-body">				
					<form action="barang_laku_act.php" method="post">
						<div class="form-group">
							<label>Tanggal</label>
							<input name="tgl" type="text" class="form-control" id="tgl" autocomplete="off">
						</div>	
					
						<div class="form-group">
							<label>Nama Barang</label>
							<select class="form-control" name="nama" id="nama" onchange="getData(this.value);">
							<option>Pilih ..</option>
								<?php 
								$brg=mysqli_query($conn,"select * from barang");
								while($b=mysqli_fetch_array($brg)){
									?>	
									<option value="<?php echo $b['nama']; ?>"><?php echo $b['nama'] ?></option>
									<?php 
								}
								?>
							</select>	
						</div>
						<div class="form-group">
							<label>Kode</label>
							<input name="kode" type="text" class="form-control" placeholder="Harga" autocomplete="off" id="kode">
						</div>									
						<div class="form-group">
							<label>Harga</label>
							<input name="harga" type="text" class="form-control" placeholder="Harga" autocomplete="off" id="harga">
						</div>	
						<div class="form-group">
							<label>Jumlah</label>
							<input name="jumlah" type="text" class="form-control" placeholder="Jumlah" autocomplete="off">
						</div>																	

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">												
						<input type="submit" class="btn btn-primary" value="Simpan">
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl").datepicker({dateFormat : 'yy/mm/dd'});							
		});
	</script>
	<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
	<script type="text/javascript">
		function getData(nama){
			$.ajax({
				url:"http://localhost/POS/admin/get_barang.php?nama=" + nama,
				type:'get',
				timeout:100000,
				dataType:'json',
				success:function(response){
					// console.log(response.result);
					$("#kode").val(response.result.kode);
					$("#harga").val(response.result.harga);
				}
			})
		}
		// $('.cimiw').keypress(function(e) {
    	// 	if(e.which == 13) {
        // 	var ome = $(this).val();
   	 	// 	}

	</script>
	<?php include 'footer.php'; ?>