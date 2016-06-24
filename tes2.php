<script>
var jam_buka="09:00:00"
var jam_tutup="17:00:00"

var d = new Date();
var d2 = Date.parse(d);

var tgl = d.getDate();
var bln = d.getMonth();
var thn = d.getFullYear();

bkh = jam_buka.split(":");
v_bk1 = new Date(thn, bln, tgl, bkh[0], bkh[1], bkh[2]);
var strbuka = Date.parse(v_bk1);

ttph = jam_tutup.split(":");
v_ttp1 = new Date(thn, bln, tgl, ttph[0], ttph[1], ttph[2]);
var strtutup = Date.parse(v_ttp1);

console.log(jam_buka);
console.log(jam_tutup);
console.log(d);
console.log(d2);
console.log(v_bk1);
console.log(v_ttp1);
console.log(strbuka);
console.log(strtutup);

if(d2 >= strbuka && d2 <= strtutup){}

</script>