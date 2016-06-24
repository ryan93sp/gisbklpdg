<script>


        var date_time1 = "01-01-2015 09:00:00"

        var time = "01-01-2015 07:00:00"

        datetime1 = date_time1.split(" ");

            date_time1 = datetime1[0];

            dt1 = date_time1.split("-");

            v_dt1 = new Date(dt1[2], dt1[1] - 1, dt1[0]);


            datetime2 = time.split(" ");

            date_time2 = datetime2[0];

            dt2 = date_time2.split("-");
			
			date_time2 = datetime2[1];
			dth2 = date_time2.split(":");

            v_dt2 = new Date(dt2[2], dt2[1]-1, dt2[0], dth2[0], dth2[1], dth2[2]);


            var date1 = Date.parse(v_dt1);

            var date2 = Date.parse(v_dt2);
			
			var d = new Date();
			var d2 = Date.parse(d);
			
			var tgl = d.getDate();
			var bln = d.getMonth();
			var thn = d.getFullYear();
			var tglnow = tgl+"-"+bln+"-"+thn;

console.log(tglnow);			
console.log(d2);
console.log(v_dt2);
console.log(v_dt1);




            if(date1 < date2){

             // alert('Maaf, Anda Time Bething tidak boleh lebih kecil dari Time Arrive');
			  console.log('wew');

              //return false;

            }


</script>