<?php if (isset($_GET['gid'])){
	$gid=$_GET['gid'];
	$sql = pg_query("SELECT * FROM jam_kerja join hari on hari.hari_id=jam_kerja.hari_id where gid=$gid order by jam_kerja.hari_id");
?>
<form class="" role="form" action="act/upjamprocess.php" method="post">
<button type="submit" class="btn btn-primary" style="float:right"><i class="fa fa-floppy-o"></i> Simpan</button>
<div class="row" style="clear:both;">
<div class="col-xs-12">
	<div class="box">
		<div class="box-body">
			<div id="form">
				<h4 style="text-transform:capitalize;">Jadwal Operasional Bengkel <?php echo $data['nama_bengkel'] ?></h4>
					<input type="text" class="form-control hidden" name="gid" value="<?php echo $gid ?>">
					<?php while($data = pg_fetch_array($sql)){ ?>
					<div class="form-group form-inline">
						<label style="width:70px"><?php echo $data['hari'] ?> :</label>
						<input type="text" class="form-control hidden" name="hari[]" value="<?php echo $data['hari_id'] ?>">
						<span class="bootstrap-timepicker"><input type="text" class="form-control timepicker" name="buka[]" value="<?php echo $data['jam_buka'] ?>" placeholder="Jam Buka"></span> - 
						<span class="bootstrap-timepicker"><input type="text" class="form-control timepicker" name="tutup[]" value="<?php echo $data['jam_tutup'] ?>" placeholder="Jam Tutup"></span>
					</div>
					<?php } ?>
			</div>
		</div>
	</div><!-- /.box -->
</div><!-- /.col -->
</form>
<?php } ?>