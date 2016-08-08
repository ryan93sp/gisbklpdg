<div class="box box-primary">
	<div class="box-header">
	  <h3 class="box-title">Upload Foto</h3>
	</div><!-- /.box-header -->
	<!-- form start -->
	<form role="form" action="act/upload.php" enctype="multipart/form-data" method="post">
	  <div class="box-body">
		<?php $gid=$_GET['gid'] ?>
		<input type="text" class="form-control hidden" name="gid" value="<?php echo $gid ?>">
		<div class="form-group">
		  <label for="file">Upload Foto</label>
		  <input type="file" name="image" required>
		</div>
		<span style="color:red;">*Ukuran gambar maksimal 500kb</span>
	  </div><!-- /.box-body -->

	  <div class="box-footer">
		<button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
	  </div>
	</form>
</div>