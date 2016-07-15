<?php if (isset($_GET['gid'])){
	$gid=$_GET['gid'];
	$sql = pg_query("SELECT * FROM layanan_bengkel where gid=$gid");
?>
<form class="" role="form" action="act/uplayprocess.php" method="post">
<button type="submit" class="btn btn-primary" style="float:right"><i class="fa fa-floppy-o"></i> Simpan</button>
<div class="row" style="clear:both;">
<div class="col-xs-12">
	<div class="box">
		<div class="box-body">
		<h4 style="text-transform:capitalize;">Layanan Bengkel <?php echo $data['nama_bengkel'] ?></h4>
		<div style="float:right">
			<a class="btn btn-success btn-sm" onclick="addinputl()"><i class="fa fa-plus"></i></a>
			<a class="btn btn-danger btn-sm" onclick="reminput2()"><i class="fa fa-times"></i></a>
		</div>
			<div id="forml" style="clear:both">
				<input type="text" class="form-control hidden" id="gidl" name="gid" value="<?php echo $gid ?>">
				<?php while($data = pg_fetch_array($sql)){ ?>
				<input type="text" class="form-control hidden" id="kenl" name="kendaraan" value="<?php echo $data['kendaraan_id'] ?>">
				<div class="form-group">
					<select name="layanan[]" class="form-control">
						<?php
							$sql2 = pg_query("select * from layanan_detail join layanan on layanan_detail.layanan_id=layanan.layanan_id where kendaraan_id=$data[kendaraan_id]");
							while($dt = pg_fetch_array($sql2)){
								if ($data['layanan_id']==$dt['layanan_id']){
									echo "<option value=\"$dt[layanan_id]\" selected>$dt[jenis_layanan]</option>";
								}else{
									echo "<option value=\"$dt[layanan_id]\">$dt[jenis_layanan]</option>";
								}
							}
						?>
					</select>
				</div>
				<?php } ?>
			</div>
		</div>
	</div><!-- /.box -->
</div><!-- /.col -->
</div>
</form>
<?php } ?>