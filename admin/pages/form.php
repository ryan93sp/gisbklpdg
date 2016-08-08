<div class="row">
<form role="form" action="act/insprocess.php" method="post">
<div class="col-lg-6 col-xs-6 col-0">
	<div class="box box-primary">
		<div class="box-body">
			<div id="form">
				<?php
					$query = pg_query("SELECT MAX(gid) AS gid FROM bengkel_region");
					$result = pg_fetch_array($query);
					$idmax = $result['gid'];
					if ($idmax==null) {$idmax=1;}
					else {$idmax++;}
				?>
				<h4 style="text-transform:capitalize;">Tambah Data Bengkel</h4>
				<input type="text" class="form-control hidden" id="gid" name="gid" value="<?php echo $idmax;?>">
				<div class="form-group">
					<label for="geom">Koordinat</label>
					<textarea class="form-control" id="geom" name="geom" readonly required></textarea>
				</div>
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
					<input type="text" class="form-control" name="telepon" value="<?php echo $data['telpon'] ?>">
				</div>
				<div class="form-group">
					<label for="selectken">Jenis Kendaraan</label>
					<select required name="selectken" id="selectken" class="form-control">
						<?php
							$sql = pg_query("select * from jenis_kendaraan");
							while($dtk = pg_fetch_array($sql)){
								echo "<option value=\"$dtk[kendaraan_id]\">$dtk[kendaraan]</option>";}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="selectjenis">Jenis Bengkel</label>
					<select required name="selectjenis" id="selectjenis" class="form-control" required>
						<?php
							$sql = pg_query("select * from jenis_bengkel");
							while($dt = pg_fetch_array($sql)){
							echo "<option value=\"$dt[jenis_id]\">Bengkel $dt[jenis_nama]</option>";}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="deskripsi">Deskripsi</label>
					<textarea class="form-control" name="deskripsi" rows="3" placeholder=""></textarea>
				</div>			
			</div>
		</div>
	</div><!-- /.box -->
</div><!-- /.col -->
<div class="col-lg-6 col-xs-6 col-0">
	<div class="box box-primary">
		<div class="box-body">
			<h4 style="text-transform:capitalize;">Peta</h4>
			<button type="submit" class="btn btn-primary pull-right">Lanjut <i class="fa fa-chevron-right"></i></button>
			<hr style="clear:both">
			<div id="map-canvas">
				<div id="map"></div>
				<div id="floating-panel">
					<button class="btn btn-default my-btn" id="delete-button" type="button" title="Remove shape"><i class="fa fa-trash"></i></button>
					<input id="latlng" type="text" value="" placeholder="latitude, longitude">
					<button class="btn btn-default my-btn" id="btnlatlng" type="button" title="Geocode"><i class="fa fa-search"></i></button>
				</div>
			</div>
		</div>
	</div>
</div><!-- ./col -->
</form>
</div>
<script src="inc/map.js" type="text/javascript"></script>