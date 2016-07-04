  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header clearfix">
			<h3 class="box-title">Profil</h3>
		</div><!-- /.box-header -->
		<div class="box-body">
			<table class="table">
				<tr><td>Username</td><td><?php echo $_SESSION['username'] ?></td></tr>
				<tr><td>Password</td><td><a href="#" id="ch" onclick="show()">Ganti Password</a></td></tr>
			</table>
			<br>
			<div id="form" class="hidden">
			<h4>Ganti Password</h4>
				<form role="form" action="changepass.php" method="post">
				<input type="text" class="form-control hidden" name="user" value="<?php echo $_SESSION['username'] ?>">
				<div class="form-group">
					<label for="passlama">Password Lama</label>
					<input type="password" class="form-control" name="passlama">
				</div>
				<div class="form-group">
					<label for="passbaru">Password Baru</label>
					<input type="password" class="form-control" name="passbaru">
				</div>
				<div class="form-group">
					<label for="konfirm">Konfirmasi Password</label>
					<input type="password" class="form-control" name="konfirm">
				</div>
				<button type="submit" class="btn btn-primary">Ganti</button>
			</form>
			</div>
			<?php /* } */ ?>
		</div><!-- /.box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
  </div><!-- /.row -->
<script>
function show() {
	$("#form" ).removeClass("hidden");
}
</script>