<?php if (isset($_GET['gid'])){
	$gid=$_GET['gid'];
	$sql = pg_query("SELECT * FROM bengkel_region join jenis_bengkel on jenis_bengkel.jenis_id=bengkel_region.jenis_id where gid=$gid");
	$data =  pg_fetch_array($sql);
?>
<form class="" role="form" action="act/ins2process.php" method="post">
<button type="submit" class="btn btn-primary" style="float:right">Simpan</button>
<div class="row" style="clear:both;">
<div class="col-xs-6">
	<div class="box">
		<div class="box-body">
			<div id="form">
				<h4 style="text-transform:capitalize;">Jadwal Operasional Bengkel <?php echo $data['nama_bengkel'] ?></h4>
					<input type="text" class="form-control hidden" name="gid" value="<?php echo $gid ?>">
					<?php 
					$hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
					for($i=0;$i<=6;$i++){ ?>
					<div class="form-group form-inline">
						<label style="width:70px"><?php echo $hari[$i] ?> :</label>
						<input type="text" class="form-control hidden" name="hari[]" value="<?php echo $i ?>">
						<span class="bootstrap-timepicker"><input type="text" class="form-control timepicker" name="buka[]" placeholder="Jam Buka"></span> - 
						<span class="bootstrap-timepicker"><input type="text" class="form-control timepicker" name="tutup[]" placeholder="Jam Tutup"></span>
					</div>
					<?php } ?>
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
							$sql = pg_query("select * from layanan");
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