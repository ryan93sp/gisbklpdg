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
			<th>Jenis Bengkel</th>
			<th>Kendaraan</th>
			<th>Aksi</th>
			
		  </tr>
		</thead>
		<tbody>
		
		<?php
		$sql = pg_query("SELECT * FROM jenis_bengkel join jenis_kendaraan on jenis_bengkel.kendaraan_id=jenis_kendaraan.kendaraan_id");
		while($data =  pg_fetch_array($sql)){
		$id = $data['jenis_id'];
		$jenis = $data['jenis_nama'];
		$kendaraan = $data['kendaraan'];
		
		?>	
		
		  <tr>
			<td><?php echo "$id"; ?></td>
			<td><?php echo "Bengkel $jenis"; ?></td>
			<td><?php echo "$kendaraan"; ?></td>
			
			<td><div class="btn-group">
				<a href="?page=j_form&id=<?php echo $id; ?>" class="btn btn-sm btn-default" title='Ubah'><i class="fa fa-edit"></i> Ubah</a>
				</div>
			</td>
		  </tr>
		<?php } ?>
		</tbody>
	  </table>
	</div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.col -->
</div>