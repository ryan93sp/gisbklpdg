var myLatLng = new google.maps.LatLng(-0.938627,100.355848);
var markerposisi=[];
var markerhasil=[];
var circles = [];
var image='image/geomarker.png'
var server= 'http://localhost/bengkel/json/';
//meload peta dan digitasi
function inisialisasi(){
		var mapOptions = {
			zoom: 13,
			center: myLatLng,
			mapTypeId: google.maps.MapTypeId.ROAD
		};

		map = new google.maps.Map(document.getElementById('map'), mapOptions); 
		
		geolocation();
		
		var bataspadang = new google.maps.Data();
		var bengkel_reg = new google.maps.Data();
		
		bataspadang.loadGeoJson(server+'padang_polyline.php');
		bengkel_reg.loadGeoJson(server+'bengkel_region.php');
		
		bataspadang.setMap(map);
		bengkel_reg.setMap(map);
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
}

//membersihkan pointer
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
		$('#list-a').empty();
		$.ajax({
	    url: server+'carinama.php?carinama='+inputcarinama.value, data: "", dataType: 'json', success: function (rows){
			loaddata(rows);}
	    });
	}
}
//membersihkan region radius
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
//menampilkan data pada laman hasil pencarian
function loaddata(rows){
	if(rows==null){
		alert('Data Tidak Ada');
	}
	else{
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
			map.setCenter(centerbaru);
			map.setZoom(13);
			
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
				
			createInfoWindow(centerbaru, nama, alamat, telpon, warna, stat);
			
			$('#list-a').append("<div class='list-det' id="+gid+" onclick='showdetail(this.id);'><a href='#'><div class='nama'>"+nama+"</div><div>"+alamat+"</div><div>"+telpon+"</div><p style='color:"+warna+";'>"+stat+" "+jam_buka+" - "+jam_tutup+"</p></a></div>");
		}
	}
}
//menampilkan info window pada peta
function createInfoWindow(centerbaru, nama, alamat, telpon, warna, stat){
	var marker = new google.maps.Marker({
		position: centerbaru,
		map: map
	});
	markerhasil.push(marker);
	infowindow = new google.maps.InfoWindow();
	var isiinfowindow="<div class='nama'>"+nama+"</div><br> Alamat: "+alamat+"<br> Telepon: "+telpon+"<br> Status: "+stat;
	google.maps.event.addListener(marker, 'mouseover', function() {
        infowindow.setContent(isiinfowindow);
        infowindow.open(map, marker);
    });
	google.maps.event.addListener(marker, 'mouseout', function() {
		infowindow.close();
	});
}
//menghapus rute
function hapusrute(){           
    directionsDisplay.setMap(null);
}
//menampilkan rute perjalanan
function rute(start, end){
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
function showdetail(id) {
	$.ajax({ 
    url: server+'detail.php?gid='+id, data: "", dataType: 'json', success: function(rows)
        {
			for (var i in rows){
            var row = rows[i];
            var gid = row.gid;
            var nama = row.nama_bengkel;
            var alamat=row.alamat;
			var telpon=row.telpon;
			var foto1=row.foto1;
			var foto2=row.foto2;
			var kendaraan=row.kendaraan;
			var kategori=row.kategori;
			var deskripsi=row.deskripsi;
			var jam_buka=row.jam_buka;
			var jam_tutup=row.jam_tutup;
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
			infowindow = new google.maps.InfoWindow({
			    position: centerbaru,
			    content: nama
			});
			infowindow.open(map, marker);
			
			$('#isi').append("Nama : "+nama+" <br> Alamat : "+alamat+" <br> Telepon : "+telpon+"<br> Jenis Kendaraan : "+kendaraan+" <br> Jenis Bengkel : "+kategori+" <br> Jam Kerja : <span style='color:"+warna+";'>"+stat+"</span> "+jam_buka+" - "+jam_tutup+"<br>Layanan<br><ul id='layanan'></ul><br><button class='btn btn-primary' style='width:30%;' value='Route' onclick='rute(centerposisi,centerbaru);'>Rute</button>&nbsp<button class='btn btn-primary' style='width:30%;' value='sekitar' onclick='sekitar("+latitude+","+longitude+",1000,"+gid+")'>Sekitar</button><div style='margin-top:10px;' id='detailrute'></div>");
			tampillayanan(gid);
			}
		}
	});
	$('#innerbtn').append("<button class='btn btn-default btn-xs' onclick='closedetail();' style='width:22%; position:relative;float:right;'><i class='fa fa-chevron-left'></i> Kembali</button>");
	$('#list-a').css('display','none');
	$('#det-a').css('display','block');
}
function tampillayanan(id){
	$.ajax({
	url: server+'layanan.php?id='+id, data: "", dataType: 'json', success: function(rows){
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
function closedetail() {
	$('#innerbtn button').remove();
	$('#det-a').css('display','none');
	$('#isi').empty();
	$('#list-a').css('display','block');
}
	
google.maps.event.addDomListener(window, 'load', inisialisasi);