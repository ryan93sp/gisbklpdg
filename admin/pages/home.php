<div class="row">
<div class="col-xs-12">
  <div class="box">
	<div class="box-header clearfix">
	  <h3 class="box-title">Bengkel</h3>
	  <div class="btn-group pull-right">
		<a href="?page=form" class="btn btn-default">Tambah <i class="fa fa-plus"></i></a>
	  </div>
	</div><!-- /.box-header -->
	<div class="box-body">
	  <table id="example1" class="table table-hover table-bordered table-striped">
		<thead>
		  <tr>
			<th>ID</th>
			<th>Nama Bengkel</th>
			<th>Alamat</th>
			<th>Telepon</th>
			<th>Aksi</th>
			
		  </tr>
		</thead>
		<tbody>
		
		<?php
		$sql = pg_query("SELECT * FROM bengkel_region order by gid asc");
		//$no = 0;
		while($data =  pg_fetch_array($sql)){
		$gid = $data['gid'];
		$nama = $data['nama_bengkel'];
		$alamat = $data['alamat'];
		$telpon = $data['telpon'];
		//$no++;
		?>	
		
		  <tr>
			<td><?php echo "$gid"; ?></td>
			<td><?php echo "$nama"; ?></td>
			<td><?php echo "$alamat"; ?></td>
			<td><?php echo "$telpon"; ?></td>
			
			<td><div class="btn-group">
				<a href="?page=detail&gid=<?php echo $gid; ?>" class="btn btn-sm btn-default" title='Detail'><i class="fa fa-exclamation-circle"></i> Detail</a>
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