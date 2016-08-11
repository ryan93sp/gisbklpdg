<div class="row">
<div class="col-xs-12">
	<div class="box">
		<div class="box-body">
				<h4 style="text-transform:capitalize;">Jenis Bengkel</h4>
				<?php if (!isset($_GET['id'])){ ?>
				<form role="form" action="act/jenisins.php" method="post">
					<a class="btn btn-success btn-sm" onclick="add()"><i class="fa fa-plus"></i></a>
					<a class="btn btn-danger btn-sm" onclick="rem()"><i class="fa fa-times"></i></a>
					<button type="submit" class="btn btn-primary pull-right">Simpan <i class="fa fa-floppy-o"></i></button>
					<div id="l_form">
						<div class="form-group input-group" style="clear:both;width:100%;">
							<input id="" list="merk" type="text" class="form-control" name="merk[]" value="" style="margin-bottom:3px;width:50%;" autofocus required>
							<select class="form-control" name="kendaraan[]" title="Pilih jenis kendaraan" style="width:50%;" required>
								<option selected disabled>--pilih kendaraan--</option>
								<?php
									$sql = pg_query("select * from jenis_kendaraan");
									while($dtk = pg_fetch_array($sql)){
										echo "<option value=\"$dtk[kendaraan_id]\">$dtk[kendaraan]</option>";
									}
								?>
							</select>
						</div>
					</div>
					<datalist id="merk">
					<?php
						$sql = pg_query("select * from merk");
						while($dtm = pg_fetch_array($sql)){
							echo "<option value=\"$dtm[merk_jenis]\">";
						}
					?>
					</datalist>
				</form>
				<?php } ?>
			</div>
		</div>
	</div><!-- /.box -->
</div><!-- /.col -->
</div>
<script>
function add(){
	var x = document.getElementById("l_form");
	var y = x.getElementsByClassName("form-group");
	var last_y = y[y.length - 1];
	$('#l_form').append('<div class="form-group input-group" style="clear:both;width:100%;">'+last_y.innerHTML+'</div>');
}
function rem(){
	var x = document.getElementById("l_form");
	var y = x.getElementsByClassName("form-group");
	var last_y = y[y.length - 1];
	if (y.length>1){
		last_y.remove();
	}
}
</script>