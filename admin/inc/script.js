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
	$('#forml').append('<div class="form-group">'+y[0].innerHTML+'</div>');
}
function reminput2(){
	x = document.getElementsByClassName("form-group")[1];
	x.remove();
}