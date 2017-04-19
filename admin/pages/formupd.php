<div class="row">
<div class="col-xs-12">
	<div class="box">
		<div class="box-body">
			<div id="form">
			<?php if (isset($_GET['gid'])){
				$gid=$_GET['gid'];
				$sql = pg_query("SELECT * FROM bengkel_region join merk on merk.merk_id=bengkel_region.merk_id where gid=$gid");
				$data =  pg_fetch_array($sql);
			?>
				<h4 style="text-transform:capitalize;">Ubah Data Atribut Bengkel <?php echo $data['nama_bengkel'] ?></h4>
				<form role="form" action="act/upprocess.php" method="post">
				<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Simpan</button>
					<input type="text" class="form-control hidden" name="gid" value="<?php echo $gid ?>">
					<div class="form-group" style="clear:both">
						<label for="nama">Nama Bengkel</label>
						<input type="text" class="form-control" name="nama" value="<?php echo $data['nama_bengkel'] ?>">
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat'] ?>">
					</div>
					<div class="form-group">
						<label for="telepon">Telepon</label>
						<input type="text" class="form-control" name="telepon" value="<?php echo $data['telpon'] ?>">
					</div>
					<div class="form-group">
						<label for="selectken">Jenis Kendaraan</label>
						<select required name="selectken" id="selectken" class="form-control" onchange="jenischange()">
							<?php
								$sql = pg_query("select * from jenis_kendaraan");
								while($dtk = pg_fetch_array($sql)){
								if ($data[jenis_kendaraan_id]==$dtk[jenis_kendaraan_id]){
									echo "<option value=\"$dtk[jenis_kendaraan_id]\" selected>$dtk[nama_kendaraan]</option>";}
								else{
									echo "<option value=\"$dtk[jenis_kendaraan_id]\">$dtk[nama_kendaraan]</option>";}
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="selectjenis">Merk</label>
						<select required name="selectmerk" id="selectmerk" class="form-control">
							<?php
								$sql = pg_query("select * from kendaraan join merk on merk.merk_id=kendaraan.merk_id where jenis_kendaraan_id=$data[jenis_kendaraan_id]");
								while($dt = pg_fetch_array($sql)){
								if ($data[merk_id]==$dt[merk_id]){
									echo "<option value=\"$dt[merk_id]\" selected>$dt[nama_merk]</option>";}
								else{
									echo "<option value=\"$dt[merk_id]\">$dt[nama_merk]</option>";}
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="konfirm">Deskripsi</label>
						<textarea class="form-control" name="deskripsi" rows="3" placeholder=""><?php echo $data['deskripsi']?></textarea>
					</div>
				</form>
			<?php }	?>
			</div>
		</div>
	</div><!-- /.box -->
</div><!-- /.col -->
</div>