<?php if (isset($_GET['gid'])){
	$gid=$_GET['gid'];
	$sql = pg_query("SELECT * FROM bengkel_region join kategori on kategori.kat_id=bengkel_region.kat_id where gid=$gid");
	$data =  pg_fetch_array($sql);
?>
<form class="" role="form" action="ins2process.php" method="post">
<button type="submit" class="btn btn-primary" style="float:right">Simpan</button>
<div class="row" style="clear:both;">
<div class="col-xs-6">
	<div class="box">
		<div class="box-body">
			<div id="form">
				<h4 style="text-transform:capitalize;">Jadwal Operasional Bengkel <?php echo $data['nama_bengkel'] ?></h4>
					<input type="text" class="form-control hidden" name="gid" value="<?php echo $gid ?>">
					<div class="form-group form-inline">
						<label style="width:70px">Minggu :</label>
						<input type="text" class="form-control hidden" name="hari[]" value="0">
						<input type="text" class="form-control" name="buka[]" value="" placeholder="Jam Buka"> - 
						<input type="text" class="form-control" name="tutup[]" value="" placeholder="Jam Tutup">
					</div>
					<div class="form-group form-inline">
						<label style="width:70px">Senin :</label>
						<input type="text" class="form-control hidden" name="hari[]" value="1">
						<input type="text" class="form-control" name="buka[]" value="" placeholder="Jam Buka"> - 
						<input type="text" class="form-control" name="tutup[]" value="" placeholder="Jam Tutup">
					</div>
					<div class="form-group form-inline">
						<label style="width:70px">Selasa :</label>
						<input type="text" class="form-control hidden" name="hari[]" value="2">
						<input type="text" class="form-control" name="buka[]" value="" placeholder="Jam Buka"> - 
						<input type="text" class="form-control" name="tutup[]" value="" placeholder="Jam Tutup">
					</div>
					<div class="form-group form-inline">
						<label style="width:70px">Rabu :</label>
						<input type="text" class="form-control hidden" name="hari[]" value="3">
						<input type="text" class="form-control" name="buka[]" value="" placeholder="Jam Buka"> - 
						<input type="text" class="form-control" name="tutup[]" value="" placeholder="Jam Tutup">
					</div>
					<div class="form-group form-inline">
						<label style="width:70px">Kamis :</label>
						<input type="text" class="form-control hidden" name="hari[]" value="4">
						<input type="text" class="form-control" name="buka[]" value="" placeholder="Jam Buka"> - 
						<input type="text" class="form-control" name="tutup[]" value="" placeholder="Jam Tutup">
					</div>
					<div class="form-group form-inline">
						<label style="width:70px">Jumat :</label>
						<input type="text" class="form-control hidden" name="hari[]" value="5">
						<input type="text" class="form-control" name="buka[]" value="" placeholder="Jam Buka"> - 
						<input type="text" class="form-control" name="tutup[]" value="" placeholder="Jam Tutup">
					</div>
					<div class="form-group form-inline">
						<label style="width:70px">Sabtu :</label>
						<input type="text" class="form-control hidden" name="hari[]" value="6">
						<input type="text" class="form-control" name="buka[]" value="" placeholder="Jam Buka"> - 
						<input type="text" class="form-control" name="tutup[]" value="" placeholder="Jam Tutup">
					</div>
			</div>
		</div>
	</div><!-- /.box -->
</div><!-- /.col -->
<div class="col-xs-6">
	<div class="box">
		<div class="box-body">
		<h4 style="text-transform:capitalize;">Layanan Bengkel <?php echo $data['nama_bengkel'] ?></h4>
		<a class="btn btn-success btn-sm" onclick="addinputl()" style="float:right;"><i class="fa fa-plus"></i></a>
			<div id="forml">
				<input type="text" class="form-control hidden" name="kendaraan" value="<?php echo $data['kendaraan_id'] ?>">
				<div class="form-group">
					<select name="layanan[]" class="form-control">
						<?php
							$sql = pg_query("select * from layanan_detail join layanan on layanan_detail.layanan_id=layanan.layanan_id where kendaraan_id=$data[kendaraan_id]");
							while($dt = pg_fetch_array($sql)){
								echo "<option value=\"$dt[layanan_id]\">$dt[jenis_layanan]</option>";}
						?>
					</select>
				</div>
			</div>
		</div>
	</div><!-- /.box -->
</div><!-- /.col -->
</div>
</form>
<?php } ?>