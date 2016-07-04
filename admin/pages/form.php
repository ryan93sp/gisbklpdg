<div class="row">
<div class="col-xs-12">
	<div class="box">
		<div class="box-body">
			<div id="form">
			<?php if (isset($_GET['gid'])){
				$gid=$_GET['gid'];
				$sql = pg_query("SELECT * FROM bengkel_region join kategori on kategori.kat_id=bengkel_region.kat_id where gid=$gid");
				$data =  pg_fetch_array($sql);
			?>
				<h4 style="text-transform:capitalize;">Ubah Data Atribut Bengkel <?php echo $data['nama_bengkel'] ?></h4>
				<form role="form" action="upprocess.php" method="post">
				<button type="submit" class="btn btn-primary">Simpan</button>
					<input type="text" class="form-control hidden" name="gid" value="<?php echo $gid ?>">
					<div class="form-group">
						<label for="nama">Nama Bengkel</label>
						<input type="text" class="form-control" name="nama" value="<?php echo $data['nama_bengkel'] ?>">
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat'] ?>">
					</div>
					<div class="form-group">
						<label for="telepon">Telepon</label>
						<input type="number" class="form-control" name="telepon" value="<?php echo $data['telpon'] ?>">
					</div>
					<div class="form-group">
						<label for="selectken">Jenis Kendaraan</label>
						<select required name="selectken" id="selectken" class="form-control" onchange="katchange()">
							<?php
								$sql = pg_query("select * from jenis_kendaraan");
								while($dtk = pg_fetch_array($sql)){
								if ($data[kendaraan_id]==$dtk[kendaraan_id]){
									echo "<option value=\"$dtk[kendaraan_id]\" selected>$dtk[kendaraan]</option>";}
								else{
									echo "<option value=\"$dtk[kendaraan_id]\">$dtk[kendaraan]</option>";}
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="selectkat">Kategori</label>
						<select required name="selectkat" id="selectkat" class="form-control">
							<?php
								$sql = pg_query("select * from kategori where kendaraan_id=$data[kendaraan_id]");
								while($dt = pg_fetch_array($sql)){
								if ($data[kat_id]==$dt[kat_id]){
									echo "<option value=\"$dt[kat_id]\" selected>Bengkel $dt[kat_nama]</option>";}
								else{
									echo "<option value=\"$dt[kat_id]\">Bengkel $dt[kat_nama]</option>";}
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="konfirm">Deskripsi</label>
						<textarea class="form-control" name="deskripsi" rows="3" placeholder=""><?php echo $data['deskripsi']?></textarea>
					</div>
				</form>
			<?php 
				}else{
					$query = pg_query("SELECT MAX(gid) AS gid FROM bengkel_region");
					$result = pg_fetch_array($query);
					$idmax = $result['gid'];
					if ($idmax==null) {$idmax=1;}
					else {$idmax++;}
			?>
				<h4 style="text-transform:capitalize;">Tambah Data Bengkel</h4>
				<form role="form" action="insprocess.php" method="post">
					<button type="submit" class="btn btn-primary">Lanjut</button>
					<input type="text" class="form-control hidden" name="gid" value="<?php echo $idmax;?>">
					<div class="form-group">
						<label for="nama">Nama Bengkel</label>
						<input type="text" class="form-control" name="nama" value="" required>
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<input type="text" class="form-control" name="alamat" value="" required>
					</div>
					<div class="form-group">
						<label for="telepon">Telepon</label>
						<input type="number" class="form-control" name="telepon" value="<?php echo $data['telpon'] ?>">
					</div>
					<div class="form-group">
						<label for="selectken">Jenis Kendaraan</label>
						<select required name="selectken" id="selectken" class="form-control" onchange="katchange()">
							<?php
								$sql = pg_query("select * from jenis_kendaraan");
								while($dtk = pg_fetch_array($sql)){
									echo "<option value=\"$dtk[kendaraan_id]\">$dtk[kendaraan]</option>";}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="selectkat">Kategori</label>
						<select required name="selectkat" id="selectkat" class="form-control" required>
							<?php
								$sql = pg_query("select * from kategori where kendaraan_id=1");
								while($dt = pg_fetch_array($sql)){
								echo "<option value=\"$dt[kat_id]\">Bengkel $dt[kat_nama]</option>";}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="konfirm">Deskripsi</label>
						<textarea class="form-control" name="deskripsi" rows="3" placeholder=""></textarea>
					</div>
				</form>
			<?php } ?>
			</div>
		</div>
	</div><!-- /.box -->
</div><!-- /.col -->
</div>