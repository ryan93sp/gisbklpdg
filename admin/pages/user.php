<div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header clearfix">
			<a href="?page=formus" class="btn btn-default pull-right"><i class="fa fa-user-plus"></i> Tambah User</a>
			<h3 class="box-title">User Login</h3>
		</div><!-- /.box-header -->
		<div class="box-body">
		  <table id="example1" class="table table-hover table-bordered table-striped">
			<thead>
			  <tr>
				<th>Username</th>
				<th>Login Terakhir</th>
				<th>Aksi</th>
			  </tr>
			</thead>
			<tbody>
			
			<?php
			$sql = pg_query("SELECT * FROM login");
			while($data =  pg_fetch_array($sql)){
			$user = $data['username'];
			$lastlog = $data['last_login'];
			?>	
			
			  <tr>
				<td><?php echo "$user"; ?></td>
				<td><?php echo "$lastlog"; ?></td>
				<td>
					<div class="btn-group"><a href="?page=formus&user=<?php echo $user; ?>" class="btn btn-sm btn-default" title='Ganti Password'><i class="fa fa-edit"></i></a></div>
				</td>
			  </tr>
			<?php } ?>
			</tbody>
		  </table>
		</div><!-- /.box-body -->
	  </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->