<div class="box box-primary">
	<!-- form start -->
	<?php if (isset($_GET['user'])){
		$user=$_GET['user'];
		$sql = pg_query("select * from login where username='$user'");
		$data = pg_fetch_array($sql);
	?>
	<form role="form" action="upusprocess.php" method="post">
	  <div class="box-body">
		<div class="form-group">
			<label for="user">Username</label>
			<input type="text" class="form-control" name="username" value="<?php echo $user; ?>" readonly>
		</div>
		<div class="form-group">
			<label for="pass">Password Baru</label>
			<input type="password" class="form-control" name="password" value="" placeholder="●●●●●">
		</div>
	  </div><!-- /.box-body -->

	  <div class="box-footer">
		<button type="submit" class="btn btn-primary">Ganti</button>
	  </div>
	</form>
	<?php } ?>
	<?php if (!isset($_GET['user'])){ ?>
	<form role="form" action="insusprocess.php" method="post">
	  <div class="box-body">
		<div class="form-group">
			<label for="user">Username</label>
			<input type="text" class="form-control" name="username">
		</div>
		<div class="form-group">
			<label for="pass">Password</label>
			<input type="password" class="form-control" name="password">
		</div>
	  </div><!-- /.box-body -->

	  <div class="box-footer">
		<button type="submit" class="btn btn-primary">Tambah</button>
	  </div>
	</form>
	<?php } ?>
</div><!-- /.box-body -->