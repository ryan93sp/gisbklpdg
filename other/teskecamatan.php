<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript">
	var server= 'http://localhost/bengkel/json/';
	$(function(){
	  $.ajax({ 
	  url: server+'listkecamatan.php', data: "", dataType: 'json', success: function(rows)
			{ 
				for (var i in rows) 
					{ 	
						var row = rows[i];
						var gid=row.gid;
						var kecamatan=row.kecamatan;
						$('#selectkec').append('<option value="'+gid+'">'+kecamatan+'</option>');
		 			}
			}
		 });
  });
</script>



<body>
	<div id="collapse4" class="panel-collapse collapse">
						<div class="panel-body">
							<select required name="selecttipe" id="selectkec" class="form-control" placeholder="Pilih Jurusan">
									<option value="">--Pilih Kecamatan--</option>
								</select><br>
								<span class="input-group-btn">
									<button type="submit" id="buttoncarikec" style="margin-top:10px;" class="btn btn-primary" onclick="clearmarker(),cleardata()"> Cari <i class="ion-search"></i></button>
								</span>
						</div>
					</div>

<script type="text/javascript" src="mylib/myjs.js"></script>
</body>
</html>