<div class="row">
<div class="col-xs-12">
  <div class="box">
	<div class="box-header clearfix">
	  <h3 class="box-title">Bengkel</h3>
	  <div class="btn-group pull-right">
		<a href="?page=l_form" class="btn btn-default">Tambah <i class="fa fa-plus"></i></a>
	  </div>
	</div><!-- /.box-header -->
	<div class="box-body">
	  <table id="example1" class="table table-hover table-bordered table-striped">
		<thead>
		  <tr>
			<th>No</th>
			<th>Layanan</th>
			<th>Aksi</th>
		  </tr>
		</thead>
		<tbody>
		
		<?php
		$sql = pg_query("SELECT * FROM layanan");
		while($data =  pg_fetch_array($sql)){
		$id = $data['layanan_id'];
		$layanan = $data['jenis_layanan'];
		?>
		  <tr>
			<td><?php echo "$id"; ?></td>
			<td><?php echo "$layanan"; ?></td>
			<td><div class="btn-group">
				<a href="?page=l_form&id=<?php echo $id; ?>" class="btn btn-sm btn-default" title='Ubah'><i class="fa fa-edit"></i> Ubah</a>
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