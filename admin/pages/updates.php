<?php
$gid=$_GET['gid'];
$sql = pg_query("SELECT * FROM bengkel_region where gid=$gid");
$data =  pg_fetch_array($sql);
?>
<style>
#floating-panel {
    position: absolute;
	top: 5px;
	right: 5px;
	z-index: 5;
	background-color: #fff;
	padding: 1px;
	border: 1px solid #999;
	border-radius: 3px;
}
#latlng{
	width: 200px;
}
</style>
<div class="row">
<div class="col-lg-4 col-xs-4 col-0">
	<div class="">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title" style="text-transform:capitalize;">Ubah Data Spasial Bengkel <?php echo $data['nama_bengkel'] ?></h3>
			</div>
			<button class="btn btn-default btn-xs pull-right" id="delete-button"><i class="fa fa-trash"></i> Hapus Shape</button>
			<div class="box-body">
				<form role="form" action="act/upprocesspas.php" method="post">
					<input type="text" class="" id="gid" name="gid" value="<?php echo $gid ?>" hidden>
					<textarea class="form-control" id="geom" name="geom" placeholder="" required></textarea>
					<div id="coor"></div>
					<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Simpan</button>
				</form>
			</div>
		</div>
		
	</div>
</div>

<div class="col-lg-8 col-xs-8 col-0">
	<div id="floating-panel">
      <input id="latlng" type="text" value="" placeholder="lat, lng">
      <button id="btnlatlng" type="button">Geocode</button>
    </div>
	<div id="map"></div>
</div><!-- ./col -->
</div>
<script src="inc/map.js" type="text/javascript"></script>