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
				<form role="form" action="act/changepass.php" method="post">
				<input type="text" class="form-control hidden" name="user" value="<?php echo $_SESSION['username'] ?>">
				<div class="form-group">
					<label for="passlama"><span style="color:red">*</span> Password Lama</label>
					<input type="password" class="form-control" name="passlama" placeholder="*****" required>
				</div>
				<div class="form-group">
					<label for="passbaru"><span style="color:red">*</span> Password Baru</label>
					<input type="password" class="form-control" name="passbaru" placeholder="*****" required>
				</div>
				<div class="form-group">
					<label for="konfirm"><span style="color:red">*</span> Konfirmasi Password</label>
					<input type="password" class="form-control" name="konfirm" placeholder="*****" required>
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