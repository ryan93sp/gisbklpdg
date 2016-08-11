<div class="row">
<div class="col-xs-12">
  <div class="box">
	<div class="box-header clearfix">
	  <h3 class="box-title">Bengkel</h3>
	  <div class="btn-group pull-right">
		<a href="?page=j_form" class="btn btn-default">Tambah <i class="fa fa-plus"></i></a>
	  </div>
	</div><!-- /.box-header -->
	<div class="box-body">
	  <table id="example1" class="table table-hover table-bordered table-striped">
		<thead>
		  <tr>
			<th>No</th>
			<th>Jenis Kendaraan</th>
			<th>Jenis Bengkel</th>
		  </tr>
		</thead>
		<tbody>
		
		<?php
		$sql = pg_query("SELECT * FROM jenis_bengkel join merk on jenis_bengkel.merk_id=merk.merk_id join jenis_kendaraan on jenis_bengkel.kendaraan_id=jenis_kendaraan.kendaraan_id");
		$no=1;
		while($data =  pg_fetch_array($sql)){
			$kendaraan = $data['kendaraan'];
			$merk = $data['merk_jenis'];
		?>	
		
		  <tr>
			<td><?php echo "$no"; ?></td>
			<td><?php echo "$kendaraan"; ?></td>
			<td><?php echo "Bengkel $merk"; ?></td>
		  </tr>
		<?php $no++; } ?>
		</tbody>
	  </table>
	</div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.col -->
</div>