var myLatLng = new google.maps.LatLng(-0.938627,100.355848);
var markerposisi=[];
var markerhasil=[];
var circles = [];
var infodetail = [];
var image='image/geomarker.png';
var server='json/';
var iconlegend='image/legenda/';
var fotolokasi='image/foto/';
//meload peta dan digitasi
function inisialisasi(){
		var mapOptions = {
			zoom: 13,
			center: myLatLng,
			mapTypeId: google.maps.MapTypeId.ROAD
		};
		map = new google.maps.Map(document.getElementById('map'), mapOptions); 
		
		geolocation();
		//menampilkan polyline kota padang
		var bataspadang = new google.maps.Data();
		bataspadang.loadGeoJson(server+'padang_polyline.php');
		bataspadang.setStyle({
			strokeWeight: 2.0,
			strokeOpacity: 1.0,
			strokeColor: 'black'
		});
		bataspadang.setMap(map);
		//menampilkan region kecamatan
		var bataskecamatan = new google.maps.Data();
		bataskecamatan.loadGeoJson(server+'kecamatan_polyline.php');
		bataskecamatan.setStyle({
			strokeWeight: 0.5,
			strokeOpacity: 1.0,
			strokeColor: 'red'
		});
		bataskecamatan.setMap(map);
		//menampilkan region bengkel
		
		var bengkel_reg = new google.maps.Data();
		bengkel_reg.loadGeoJson(server+'bengkel_region.php');
		bengkel_reg.setStyle(function(feature){
			var jenis = feature.getProperty('kat_id');
			if (jenis == 'kat1' || jenis == 'kat2' || jenis == 'kat3'){
				color = 'red';
			}else if(jenis == 'kat4'){
				color = 'yellow'
			}else if(jenis == 'kat5' || jenis == 'kat6' || jenis == 'kat7'){
				color = 'green'
			}else{
				color = 'blue'
			}
			return({
				fillColor: color,
				strokeColor: color,
				strokeWeight: 1,
				fillOpacity: 0.5,
			});
		})
		bengkel_reg.setMap(map);
		//fungsi klik digitasi bengkel
		bengkel_reg.addListener('click', function(event) {
			infowindow.close();
			infowindow.setContent(event.feature.getProperty('nama_bengkel'));
			infowindow.setPosition(event.latLng);
			infowindow.setOptions({pixelOffset: new google.maps.Size(0,-14)});
			infowindow.open(map);
		});
		//menampilkan legenda
		var iconBase = iconlegend;
		var icons = {
			resmimobil: {
			name: 'Bengkel Resmi Mobil',
			icon: iconBase+'merah.gif'
			},
			tidakresmimobil: {
			name: 'Bengkel Tidak Resmi Mobil',
			icon: iconBase+'kuning.gif'
			},
			resmimotor: {
			name: 'Bengkel Resmi Motor',
			icon: iconBase+'hijau.gif'
			},
			tidakresmimotor: {
			name: 'Bengkel Tidak Resmi Motor',
			icon: iconBase+'biru.gif'
			},
			kecamatan: {
			name: 'Batas Kecamatan',
			icon: iconBase+'kecamatan.jpg'
			},
			kota: {
			name: 'Batas Kota',
			icon: iconBase+'kota.jpg'
			},
        };
		var legend = document.getElementById('legend');
			for (var key in icons) {
				var type = icons[key];
				var name = type.name;
				var icon = type.icon;
				var div = document.createElement('div');
				div.setAttribute('class',"legend");
				div.innerHTML = '<img src="'+icon+ '"> ' +name;
				legend.appendChild(div);
			}
		map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend);
}

//menampilkan posisi saat ini
function geolocation(){
	hapusposisi();
	navigator.geolocation.getCurrentPosition(function(position) {
		pos = {
			lat: position.coords.latitude,
			lng: position.coords.longitude
		};
		geomarker = new google.maps.Marker({
			position: pos,
			map: map,
			icon: image,
			animation: google.maps.Animation.DROP,
		});
		centerposisi = new google.maps.LatLng(pos.lat, pos.lng);
		markerposisi.push(geomarker);
		map.panTo(pos);
		infowindow = new google.maps.InfoWindow();
		infowindow.setContent(' Posisi Anda ');
		infowindow.open(map, geomarker);
    });
}
//menambah marker lokasi baru pada map
function manuallocation(){
	hapusRadius();
	alert('Klik Peta');
	map.addListener('click', function(event) {
		addMarker(event.latLng);
		});
	}
	function addMarker(location){
		hapusposisi();
		
		marker = new google.maps.Marker({
			icon: image,
			position : location,
			map: map,
			animation: google.maps.Animation.DROP,
			});
		pos = {
		lat: location.lat(),
		lng: location.lng()
		}
		centerposisi = new google.maps.LatLng(pos.lat, pos.lng);
		markerposisi.push(marker);
		infowindow = new google.maps.InfoWindow();
		infowindow.setContent(' Posisi Sekarang ');
		infowindow.open(map, marker);
		usegeolocation=true;
		google.maps.event.clearListeners(map, 'click');
	}
//membersihkan pointer posisi
function hapusposisi(){
	for (var i = 0; i < markerposisi.length; i++){
	markerposisi[i].setMap(null);
	}
	markerposisi = [];
}
//menghapus marker hasil pencarian
function hapusmarker(){
	for (var i = 0; i < markerhasil.length; i++){
	markerhasil[i].setMap(null);
	}
	markerhasil = [];
}
//cari berdasarkan nama
function btncarinama(){
	if(inputcarinama.value==''){
		alert("Isi kolom pencarian!");
    }
    else{
		hapusRadius();
		hapusmarker();
		hapusrute();
		$('#list-a').empty();
		$.ajax({
	    url: server+'carinama.php?carinama='+inputcarinama.value, data: "", dataType: 'json', success: function (rows){
			loaddata(rows);}
	    });
	}
}
//cari berdasarkan kategori
function btncarikat(){
	if(selectken.value=='--Pilih Jenis Kendaraan--'){
		alert("Pilih Kategori!");
    }
    else{
		hapusRadius();
		hapusmarker();
		hapusrute();
		$('#list-a').empty();
		$.ajax({
	    url: server+'carikategori.php?kat='+selectbeng.value, data: "", dataType: 'json', success: function (rows){
			loaddata(rows);}
	    });
	}
}
//membersihkan circle radius
function hapusRadius(){
	for(var i=0;i<circles.length;i++){
	circles[i].setMap(null);
	}
	circles=[];
}
//cari berdasarkan radius
function btnradius(){
	var rad = inputradius.value;
	var radm = rad*1000;
	hapusRadius();
	hapusmarker();
	hapusrute();
	var circle = new google.maps.Circle({
		center: pos,
		radius: parseFloat(radm),      
		map: map,
		strokeColor: "blue",
		strokeOpacity: 0.2,
		strokeWeight: 1,
		fillColor: "blue",
		fillOpacity: 0.1
		});
	circles.push(circle);
	$('#list-a').empty();
	$.ajax({
	url: server+'cariradius.php?lat='+pos.lat+'&lng='+pos.lng+'&rad='+radm, data: "", dataType: 'json', success: function(rows){
		loaddata(rows);}
	});
}
//cari berdasarkan layanan
function btncarilay(){
	var arrayLay=[];
	for(i=0;i<$("input[name=layanan]:checked").length;i++){
		arrayLay.push($("input[name=layanan]:checked")[i].value);
	}
	hapusRadius();
	hapusmarker();
	hapusrute();
	$('#list-a').empty();
	
	if (arrayLay==''){
		alert('Pilih Layanan');
	}else{
		$.ajax({
		url: server+'carilayanan.php?lay='+arrayLay, data: "", dataType: 'json', success: function(rows){
		loaddata(rows);}
	});
	}
}
//cari berdasarkan kecamatan
function btncarikec(){
	var arrayKec=[];
	for(i=0;i<$("input[name=kecamatan]:checked").length;i++){
		arrayKec.push($("input[name=kecamatan]:checked")[i].value);
	}
	hapusRadius();
	hapusmarker();
	hapusrute();
	$('#list-a').empty();
	
	if (arrayKec==''){
		alert('Pilih Kecamatan');
	}else{
		$.ajax({
		url: server+'carikec.php?kec='+arrayKec, data: "", dataType: 'json', success: function(rows){
		loaddata(rows);
		kecamatanreg(arrayKec);
		}
	});
	}
}
//cari berdasarkan rating
function btncarirate(){
	if(ratecari.value==''){
		alert("Pilih rating!");
    }
    else{
		hapusRadius();
		hapusmarker();
		hapusrute();
		$('#list-a').empty();
		$.ajax({
	    url: server+'carirate.php?rate='+ratecari.value, data: "", dataType: 'json', success: function (rows){
			loaddata(rows);}
	    });
	}
}
//cari berdasarkan jam buka or jam operasional
function btncarijam(){
	if(jamcari.value==''){
		alert("Isi jam!");
    }
    else{
		hapusRadius();
		hapusmarker();
		hapusrute();
		$('#list-a').empty();
		$.ajax({
	    url: server+'carijam.php?jam='+jamcari.value, data: "", dataType: 'json', success: function (rows){
			loaddata(rows);}
	    });
	}
}
//menampilkan region kecamatan
function kecamatanreg(id){
	if(typeof(kectampil) != "undefined" && kectampil.setMap() != undefined){
    	kectampil.setMap(null);
	}
	kectampil = new google.maps.Data();
	kectampil.loadGeoJson(server+'kecamatan_region.php?kec='+id)
	kectampil.setStyle(function(feature){
		var gid = feature.getProperty('gid');
		if (gid == 1){
			color = '#84F38D';
		}else if(gid == 2){
			color = '#F38484'
		}else if(gid == 3){
			color = '#D597F9'
		}else if(gid == 4){
			color = '#3CC795'
		}else if(gid == 5){
			color = '#EC9949'
		}else if(gid == 6){
			color = '#4C51EF'
		}else if(gid == 7){
			color = '#EF4242'
		}else if(gid == 8){
			color = '#EEF72E'
		}else if(gid == 9){
			color = '#ACAF76'
		}else if(gid == 10){
			color = '#A53197'
		}else{
			color = '#59AD02'
		}
		return({
			fillColor: color,
			strokeColor: color,
			strokeWeight: 1,
			fillOpacity: 0.5,
		});
	});
	kectampil.setMap(map);
}
//menampilkan data pada laman hasil pencarian
function loaddata(rows){
	if(rows==null){
		alert('Data Tidak Ada');
	}
	else{
		clearall();
		if ($('#sidebar').hasClass('results-collapsed')){
			$('#sidebar').removeClass("results-collapsed");
			$('.map-canvas .map').one("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
				google.maps.event.trigger(map, 'resize');
			});
		}
		for (var i in rows){
			var row=rows[i];
			var gid=row.gid;
			var nama=row.nama_bengkel;
			var alamat=row.alamat;
			var telpon=row.telpon;
			var jam_buka=row.jam_buka;
			var jam_tutup=row.jam_tutup;
			var latitude=row.latitude;
			var longitude=row.longitude;
			centerbaru=new google.maps.LatLng(latitude, longitude);
			marker=new google.maps.Marker
			({
				position: centerbaru,
				map: map,
			});
			markerhasil.push(marker);
			map.setZoom(12);
			map.setCenter(centerbaru);
			var now = new Date();
			var strnow = Date.parse(now);
			var tgl = now.getDate();
			var bln = now.getMonth();
			var thn = now.getFullYear();
			bkh = jam_buka.split(":");
			v_bkh = new Date(thn, bln, tgl, bkh[0], bkh[1], bkh[2]);
			var strbuka = Date.parse(v_bkh);
			ttph = jam_tutup.split(":");
			v_ttph = new Date(thn, bln, tgl, ttph[0], ttph[1], ttph[2]);
			var strtutup = Date.parse(v_ttph);
			if(strnow >= strbuka && strnow <= strtutup){
				var stat = 'Buka';
				var warna = 'Blue';}
			else {
				var stat = 'Tutup';
				var warna = 'Red';}
				
			createInfoWindow(centerbaru, gid, nama, alamat, telpon, warna, stat);
			
			$('#list-a').append("<div class='list-det' id="+gid+" onclick='showdetail(this.id);'><a href='#'><div class='nama'>"+nama+"</div><div style='text-transform:capitalize;'>"+alamat+"</div><div>"+telpon+"</div><p style='color:"+warna+";'>"+stat+" "+jam_buka+" - "+jam_tutup+"</p></a></div>");
		}
	}
}
//menampilkan info window hasil pada peta
function createInfoWindow(centerbaru, gid, nama, alamat, telpon, warna, stat){
	var marker = new google.maps.Marker({
		position: centerbaru,
		map: map
	});
	markerhasil.push(marker);
	infowindow = new google.maps.InfoWindow();
	var isiinfowindow="<div class='nama'>"+nama+"</div><br> Alamat: "+alamat+"<br> Telepon: "+telpon+"<br> Status: "+stat+"<br><button class='btn btn-default btn-xs' style='width:100px' onclick='showdetail("+gid+");'>Detail</button>";
	google.maps.event.addListener(marker, 'mouseover', function(){
        infowindow.close();
		infowindow.setContent(isiinfowindow);
        infowindow.open(map, marker);
    });
	/* google.maps.event.addListener(marker, 'mouseout', function(){
		infowindow.close();
	}); */
}
//menghapus rute
function hapusrute(){           
    if(typeof(directionsDisplay) != "undefined" && directionsDisplay.getMap() != undefined){
    	directionsDisplay.setMap(null);
	}
}
//menampilkan rute perjalanan
function rute(start, end){
	hapusrute();
	$('#detailrute').empty();
	directionsService = new google.maps.DirectionsService();
	var request = {
		origin:start,
		destination:end,
		travelMode: google.maps.TravelMode.DRIVING,
		unitSystem: google.maps.UnitSystem.METRIC,
		provideRouteAlternatives: true
	};
	directionsService.route(request, function(response, status){
		if (status == google.maps.DirectionsStatus.OK){
			directionsDisplay.setDirections(response);
		}
	});
	directionsDisplay = new google.maps.DirectionsRenderer({draggable: false});
	directionsDisplay.setMap(map);
	directionsDisplay.setPanel(document.getElementById('detailrute'));
}
//menampilkan detail hasil pencarian
function showdetail(id){
	hapusInfo();
	$.ajax({ 
    url: server+'detail.php?gid='+id, data: "", dataType: 'json', success: function(rows)
        {
			for (var i in rows){
            var row = rows[i];
            var gid = row.gid;
            var nama = row.nama_bengkel;
            var alamat=row.alamat;
			var telpon=row.telpon;
			var foto=row.foto;
			var kendaraan=row.kendaraan;
			var kategori=row.kategori;
			var deskripsi=row.deskripsi;
			var jam_buka=row.jam_buka;
			var jam_tutup=row.jam_tutup;
			var hari=row.hari;
            var latitude  = row.latitude;
            var longitude = row.longitude;
			var now = new Date();
			var strnow = Date.parse(now);
			var tgl = now.getDate();
			var bln = now.getMonth();
			var thn = now.getFullYear();

			bkh = jam_buka.split(":");
			v_bkh = new Date(thn, bln, tgl, bkh[0], bkh[1], bkh[2]);
			var strbuka = Date.parse(v_bkh);

			ttph = jam_tutup.split(":");
			v_ttph = new Date(thn, bln, tgl, ttph[0], ttph[1], ttph[2]);
			var strtutup = Date.parse(v_ttph);
			
			if(strnow >= strbuka && strnow <= strtutup){
				var stat = 'Buka';
				var warna = 'Blue';}
			else {
				var stat = 'Tutup';
				var warna = 'Red';}
				
            centerbaru = new google.maps.LatLng(row.latitude, row.longitude);
			marker=new google.maps.Marker
			({
				position: centerbaru,
				map: map,
			});
			map.setCenter(centerbaru);
			map.setZoom(17);
			markerhasil.push(marker);
			infowindow = new google.maps.InfoWindow({
			    position: centerbaru,
			    content: nama
			});
			infodetail.push(infowindow);
			infowindow.open(map, marker);
			$('#foto').append("<img src="+fotolokasi+''+foto+" alt='' style=''>");
			$('#isi').append("<h2 style='text-transform:capitalize;margin-bottom: 10px;margin-top:10px;'>"+nama+"</h2><table><tbody style='vertical-align:top;'><tr><td><b>Alamat</b></td><td> :&nbsp;</td><td style='text-transform:capitalize;'>"+alamat+" </td></tr><tr><td> <b>Telepon</b></td><td>:</td><td> "+telpon+"</td></tr><tr><td><b>Kendaraan</b>&nbsp;</td><td> :</td><td> "+kendaraan+" </td></tr><tr> <td><b>Bengkel<b></td><td>: </td><td>"+kategori+" </td></tr><tr><td><b>Jam Kerja</b></td><td> :</td><td><span style='color:"+warna+";'>"+stat+"</span> "+hari+" "+jam_buka+" - "+jam_tutup+"</td></tr></tbody></table><a data-toggle='collapse' data-parent='#accordion' href='#collapsex'><b>Layanan</b><i class='fa fa-chevron-down'></i></a><div id='collapsex' class='panel-collapse collapse'><ul id='layanan'></ul></div><div class='rating'></div><br><button class='btn btn-primary' style='width:30%;' value='Route' onclick='rute(centerposisi,centerbaru);'>Rute</button>&nbsp<!--<button class='btn btn-primary' style='width:30%;' value='sekitar' onclick='sekitar("+latitude+","+longitude+",1000,"+gid+")'>Sekitar</button>--><div style='margin-top:10px;' id='detailrute'></div>");
			tampillayanan(gid);
			tampilrating(gid)
			}
		}
	});
	$('#det-a').prepend("<button id='kembali-l' class='btn btn-default btn-xs' onclick='closedetail();' style='width:25%;float:right;'><i class='fa fa-chevron-left'></i> Kembali</button>");
	$('#list-a').css('display','none');
	$('#det-a').css('display','block');
}
//menghapus infowindow detail
function hapusInfo(){
	for (var i = 0; i < infodetail.length; i++){
        infodetail[i].setMap(null);
    }
}
//menampilkan layanan detail pada list detail
function tampillayanan(id){
	$.ajax({
	url: server+'layanan.php?gid='+id, data: "", dataType: 'json', success: function(rows){
	if(rows==null){
		$('#layanan').append("-");
	}
	for (var i in rows){
		var row     = rows[i];
		var layanan = row.layanan;
		$('#layanan').append("<li>"+layanan+"</li>");
	}}
	});
}
//menampilkan rating
function tampilrating(id){
	$(".rating").append("<b>Rating</b> : ");
	$.ajax({
	url: server+'rating.php?id='+id, data: "", dataType: 'json', success: function(rows){
	for (var i in rows){
		var row = rows[i];
		var review = row.review;
		var rating = parseFloat(row.rating).toFixed(1),
		rounded = (rating | 0),
		str;
		for (var j = 0; j < 5; j++){
		  str = '<i class="fa ';
		  if (j < rounded){
			str += "fa-star";
		  } else if ((rating - j) > 0 && (rating - j) < 1) {
			str += "fa-star-half-o";
		  } else {
			str += "fa-star-o";
		  }
		  str += '" aria-hidden="true"></i>';
		  $(".rating").append(str);
		}
		if (rating=="NaN"){$(".rating").append(" Belum ada rating<br><div id='isir'><b>Review</b> : <a href='#' id='r_"+id+"' onclick='tampilreview(this.id)'>0 review</a></div>");}
		else {$(".rating").append(" "+rating+"<br><div id='isir'><b>Review</b> : <a href='#' id='r_"+id+"' onclick='tampilreview(this.id)'>"+review+" review | Semua Review</a></div>");}
	}}
	});
}
//menampilkan review
function tampilreview(id){
	var gid = id.split("_");
	$.ajax({
	url: server+'review.php?id='+gid[1], data: "", dataType: 'json', success: function(rows){
	for (var i in rows){
		var row = rows[i];
		var pengguna = row.pengguna;
		var komen = row.komentar;
		var time = row.time.split(" ");
		var rating = row.rating,
		rounded = (rating | 0),
		str;

		for (var j = 0; j < 5; j++){
		  str = '<i class="fa ';
		  if (j < rounded){
			str += "fa-star";
		  } else {
			str += "fa-star-o";
		  }
		  str += '" aria-hidden="true"></i>';
		  $("#isi-r").append(str);
		}
		  $("#isi-r").append('<br>'+time[0]+' oleh <b>'+pengguna+'</b><br>'+komen+'<br><hr>');
	}}
	});
	//$("#isi-r").append(" "+komen+" "+rating+" ");
	$('#det-r').prepend("<button id='backreview' class='btn btn-default btn-xs' onclick='closereview();' style='width:25%;float:right;'><i class='fa fa-chevron-left'></i> Kembali</button>");
	$("#gidr").val(gid[1]);
	$('#kembali-l').css('display','none');
	$('#det-a').css('display','none');
	$('#det-r').css('display','block');
}
//memilih rating cari
$('.star').click(function(){
	//get the id of star
	var star_id = $(this).attr('id');
	var star_index = $(this).attr("id").split("-")[1];
	$("#ratecari").val(star_index);
	switch (star_id){
		case "star-1":
			$("#star-1").addClass('star-checked');
			$("#star-2").removeClass('star-checked');
			$("#star-3").removeClass('star-checked');
			$("#star-4").removeClass('star-checked');
			$("#star-5").removeClass('star-checked');
			break;
		case "star-2":
			$("#star-1").addClass('star-checked');
			$("#star-2").addClass('star-checked');
			$("#star-3").removeClass('star-checked');
			$("#star-4").removeClass('star-checked');
			$("#star-5").removeClass('star-checked');
			break;
		case "star-3":
			$("#star-1").addClass('star-checked');
			$("#star-2").addClass('star-checked');
			$("#star-3").addClass('star-checked');
			$("#star-4").removeClass('star-checked');
			$("#star-5").removeClass('star-checked');
			break;
		case "star-4":
			$("#star-1").addClass('star-checked');
			$("#star-2").addClass('star-checked');
			$("#star-3").addClass('star-checked');
			$("#star-4").addClass('star-checked');
			$("#star-5").removeClass('star-checked');
			break;
		case "star-5":
			$("#star-1").addClass('star-checked');
			$("#star-2").addClass('star-checked');
			$("#star-3").addClass('star-checked');
			$("#star-4").addClass('star-checked');
			$("#star-5").addClass('star-checked');
			break;
	}
});
//memilih rating add review
$('.star2').click(function(){
	//get the id of star
	var star_id = $(this).attr('id');
	var star_index = $(this).attr("id").split("-")[1];
	$("#rateid").val(star_index);
	switch (star_id){
		case "star2-1":
			$("#star2-1").addClass('star-checked');
			$("#star2-2").removeClass('star-checked');
			$("#star2-3").removeClass('star-checked');
			$("#star2-4").removeClass('star-checked');
			$("#star2-5").removeClass('star-checked');
			break;
		case "star2-2":
			$("#star2-1").addClass('star-checked');
			$("#star2-2").addClass('star-checked');
			$("#star2-3").removeClass('star-checked');
			$("#star2-4").removeClass('star-checked');
			$("#star2-5").removeClass('star-checked');
			break;
		case "star2-3":
			$("#star2-1").addClass('star-checked');
			$("#star2-2").addClass('star-checked');
			$("#star2-3").addClass('star-checked');
			$("#star2-4").removeClass('star-checked');
			$("#star2-5").removeClass('star-checked');
			break;
		case "star2-4":
			$("#star2-1").addClass('star-checked');
			$("#star2-2").addClass('star-checked');
			$("#star2-3").addClass('star-checked');
			$("#star2-4").addClass('star-checked');
			$("#star2-5").removeClass('star-checked');
			break;
		case "star2-5":
			$("#star2-1").addClass('star-checked');
			$("#star2-2").addClass('star-checked');
			$("#star2-3").addClass('star-checked');
			$("#star2-4").addClass('star-checked');
			$("#star2-5").addClass('star-checked');
			break;
	}
});
//menambahkan review
function btnaddreview(){
	var gid = gidr.value;
	var pengguna = user.value;
	var rating = rateid.value;
	var komen = komentar.value;
	var now = new Date();	
	var tgl = now.getDate();
	var bln = now.getMonth();
	var thn = now.getFullYear();
	var time = thn+'/'+bln+'/'+tgl;
	if(pengguna=='' || rating=='' || komen==''){
		alert("Lengkapi!");
    }else{
		$.ajax({url: server+'addreview.php?gid='+gid+'&pengguna='+pengguna+'&rating='+rating+'&komentar='+komen, dataType: 'json', success: function(rows){
			//alert('sukses');
			for (var i in rows){
				var row = rows[i];
				//var review = row.review;
				var error = row.error;
				if (error=='true'){
					alert('Nama pengguna telah digunakan');
				}
				else {
					alert('sukses');
					$('.star').removeClass('star-checked');
					$("#user").val('');
					$("#komentar").val('');
					for (var j = 0; j < 5; j++){
						str = '<i class="fa ';
						if (j < rating){
						str += "fa-star";
						} else {
						str += "fa-star-o";
						}
						str += '" aria-hidden="true"></i>';
						$("#your-r").append(str);
						}
					$("#your-r").append('<br>'+time+' oleh <b>'+pengguna+'</b><br>'+komen+'<br><hr>');
				}
			}
		}
		});
	}
}
function refresh(){
	hapusRadius();
	hapusmarker();
	hapusrute();
	if(typeof(kectampil) != "undefined" && kectampil.setMap() != undefined){
    	kectampil.setMap(null);
	}
	$('#list-a').empty();
	$('#det-a').css('display','none');
	$('#det-r').css('display','none');
	$('#list-a').css('display','block');
}
function closedetail(){
	$('#kembali-l').remove();
	$('#det-a').css('display','none');
	$('#foto').empty();
	$('#isi').empty();
	$('#list-a').css('display','block');
}
function closereview(){
	$('#backreview').remove();
	$('#det-r').css('display','none');
	$('#isi-r, #your-r').empty();
	$('#det-a').css('display','block');
	$('#kembali-l').css('display','block');
}
function clearall(){
	$('#kembali-l').remove();
	$('#backreview').remove();
	$('#isi').empty();
	$('#isi-r, #your-r').empty();
	$('#list-a').css('display','block');
	$('#det-a,#det-r').css('display','none');
}
//menampilkan option list kecamatan
$(function(){
	$.ajax({ 
	url: server+'listkecamatan.php', data: "", dataType: 'json', success: function(rows){
		for (var i in rows){
			var row = rows[i];
			var gid=row.gid;
			var kecamatan=row.kecamatan;
			//$('#selectkec').append('<option value="'+gid+'">'+kecamatan+'</option>');
			$('#selectkec').append('<div class="checkbox"><label><input type="checkbox" name="kecamatan" value="'+gid+'">'+kecamatan+'</label></div>');
		}
	}
	});
});
//menampilkan option kendaraan
$(function(){
	$.ajax({ 
	url: server+'kendaraan.php', data: "", dataType: 'json', success: function(rows){
		for (var i in rows){
			var row = rows[i];
			var id=row.id;
			var kendaraan=row.kendaraan;
			$('#selectken').append('<option value="'+id+'">'+kendaraan+'</option>');
			$('#selectken2').append('<option value="'+id+'">'+kendaraan+'</option>');
		}
	}
	});
});
//menampilkan option kategori
function kategori(){
	$('#selectbeng option').remove();
	var v=selectken.value;
	$.ajax({ 
	url: server+'kategori.php?id='+v, data: "", dataType: 'json', success: function(rows){
		for (var i in rows){
			var row = rows[i];
			var id=row.id;
			var kategori=row.kategori;
			$('#selectbeng').append('<option value="'+id+'">Bengkel '+kategori+'</option>');
		}
	}
	});
}
//menampilkan checkbox layanan
function layanan(){
	$('#layananlist .checkbox').remove();
	var v=selectken2.value;
	$.ajax({ 
	url: server+'layanancek.php?id='+v, data: "", dataType: 'json', success: function(rows){
		for (var i in rows){
			var row = rows[i];
			var id=row.id;
			var layanan=row.layanan;
			$('#layananlist').append('<div class="checkbox"><label><input type="checkbox" name="layanan" value="'+id+'">'+layanan+'</label></div>');
		}
	}
	});
}
google.maps.event.addDomListener(window, 'load', inisialisasi);