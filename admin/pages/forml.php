<?php if (isset($_GET['gid'])){
	$gid=$_GET['gid'];
?>
<form class="" role="form" action="act/uplayprocess.php" method="post">
<button type="submit" class="btn btn-primary" style="float:right"><i class="fa fa-floppy-o"></i> Simpan</button>
<div class="row" style="clear:both;">
<div class="col-xs-12">
	<div class="box">
		<div class="box-body">
		<h4 style="text-transform:capitalize;">Layanan Bengkel <?php echo $data1['nama_bengkel'] ?></h4>
			<div id="forml">
				<input type="text" class="form-control hidden" id="gidl" name="gid" value="<?php echo $gid ?>">
					<div class="form-group">
						<?php
							$sql2 = pg_query("select * from layanan order by jenis_layanan");
							while($dt = pg_fetch_array($sql2)){
								$sql3 = pg_query("SELECT * FROM layanan_bengkel where gid=$gid and layanan_id=$dt[layanan_id]");
								$data3 = pg_fetch_array($sql3);
								if ($dt['layanan_id']==$data3['layanan_id']){
									echo "<div class='checkbox'><label><input name='layanan[]' value=\"$dt[layanan_id]\" type='checkbox' checked>$dt[jenis_layanan]</label></div>";
								}else{
									echo "<div class='checkbox'><label><input name='layanan[]' value=\"$dt[layanan_id]\" type='checkbox'>$dt[jenis_layanan]</label></div>";
								}
							}
						?>
						
					</div>
			</div>
		</div>
	</div><!-- /.box -->
</div><!-- /.col -->
</div>
</form>
<?php } ?>