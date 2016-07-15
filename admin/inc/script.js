function katchange(){
	$('#selectkat option').remove();
	var v=selectken.value;
	$.ajax({ 
	url:'act/kategori.php?id='+v, data: "", dataType: 'json', success: function(rows){
		for (var i in rows){
			var row = rows[i];
			var id=row.id;
			var kategori=row.kategori;
			$('#selectkat').append('<option value="'+id+'">Bengkel '+kategori+'</option>');
		}
	}
	});
}
function addinputl(){
	var x = document.getElementById("forml");
	var y = x.getElementsByClassName("form-group");
	$('#forml').append('<div class="form-group">'+y[0].innerHTML+'</div>');
}
/* function addinputl2(){
	var k = kenl.value;
	$('#forml').append('<div class="form-group"><select name="layanan[]" class="form-control">');
	$.ajax({ 
	url:'act/layanan.php?ken='+k, data: "", dataType: 'json', success: function(rows){
		for (var i in rows){
			var row = rows[i];
			var layid=row.layid;
			var layanan=row.layanan;
			$('.form-control').append('<option value="'+layid+'">'+layanan+'</option>');
		}
	}
	});
	$('#forml').append('</select></div>');
} */
function reminput2(){
	x = document.getElementsByClassName("form-group")[1];
	x.remove();
}