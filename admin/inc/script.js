function jenischange(){
	$('#selectkat option').remove();
	var v=selectken.value;
	$.ajax({ 
	url:'act/jenis.php?id='+v, data: "", dataType: 'json', success: function(rows){
		for (var i in rows){
			var row = rows[i];
			var id=row.id;
			var jenis=row.jenis;
			$('#selectkat').append('<option value="'+id+'">Bengkel '+jenis+'</option>');
		}
	}});
}
function addinputl(){
	var x = document.getElementById("forml");
	var y = x.getElementsByClassName("form-group");
	var last_y = y[y.length - 1];
	$('#forml').append('<div class="form-group">'+last_y.innerHTML+'</div>');
}
function reminput2(){
	/* x = document.getElementsByClassName("form-group")[1];
	x.remove(); */
	var x = document.getElementById("forml");
	var y = x.getElementsByClassName("form-group");
	var last_y = y[y.length - 1];
	if (y.length>1){
		last_y.remove();
	}
}