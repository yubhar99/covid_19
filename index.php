 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Informasi Covid-19</title>
     <style>
         body {
             background-color: black;
             color: white;
         }
     </style>
 </head>

 <body>
     <h1>Informasi Global (<?= date('Y-m-d', strtotime(date("Y-m-d"))); ?>)</h1>
     <table width="20%" border="1">
         <thead>
             <tr>
                 <th>Kasus</th>
                 <th id="global-kasus">0 Orang</th>
             </tr>
             <tr>
                 <th>Meninggal</th>
                 <th id="global-meninggal">0 Orang</th>
             </tr>
             <tr>
                 <th>pulih</th>
                 <th id="global-pulih">0 Orang</th>
             </tr>
         </thead>
     </table>

     <h1>Informasi Tiap Negara (<?= date('Y-m-d', strtotime(date("Y-m-d"))); ?>)</h1>
     <table border="1">
         <thead>
             <tr>
                 <th>No.</th>
                 <th>Negara</th>
                 <th>Kasus</th>
                 <th>Kasus Hari Ini</th>
                 <th>Aktif</th>
                 <th>Meninggal</th>
                 <th>Meninggal Hari Ini</th>
                 <th>Pulih</th>
                 <th>Kritis</th>
             </tr>
         </thead>
         <tbody id="daftar-negara">
         </tbody>
     </table>
     <ul>
         <li>Sumber Info</li>
         <li> https://coronavirus-19-api.herokuapp.com</li>
     </ul>
     <!-- Mengambil Statistik Perkembangan COVID19 di Indonesia-->
     <?php
        //default time zone
        date_default_timezone_set("Asia/Jakarta");
        $array = json_decode(file_get_contents("https://services5.arcgis.com/VS6HdKS0VfIhv8Ct/arcgis/rest/services/Statistik_Perkembangan_COVID19_Indonesia/FeatureServer/0/query?where=1%3D1&outFields=*&outSR=4326&f=json"), true);

        $tgl = date('Y-m-d', strtotime('-1 days', strtotime(date("Y-m-d"))));
        $tgl = date('Y-m-d', strtotime(date("Y-m-d")));
        $time = "07:00:00 AM";
        $datetime = $tgl . " " . $time;
        $datetime1 = strtotime($datetime) * 1000;
        //echo $datetime1 . "<br>";
        $statistik_perkembangan_covid19_indonesia = $array["features"];
        ?>
     <h1>Statistik Perkembangan COVID19 di Indonesia</h1>
     <table cellpadding='10' width='100%' align='center' border='1'>
         <tr>
             <th align='center'>Hari Ke-</th>
             <!-- <th align='center'>Tanggal</th> -->
             <th align='center'>Jumlah Kasus Baru Per Hari</th>
             <th align='center'>Jumlah Kasus Kumulatif</th>
             <th align='center'>Jumlah Pasien Dalam Perawatan</th>
             <th align='center'>Jumlah Pasien Sembuh</th>
             <th align='center'>Persentase Pasien Dalam Perawatan</th>
             <th align='center'>Jumlah Pasien Meninggal</th>
             <th align='center'>Persentase Pasien Meninggal</th>
             </th>
             <?php foreach ($statistik_perkembangan_covid19_indonesia as $d) : ?>

             <tr>
                 <td align='center'><?= $d["attributes"]["Hari_ke"] ?></td>
                 <!-- <td align='center'><?= $d["attributes"]["Tanggal"] ?></td> -->

                 <td align='center'><?= $d["attributes"]["Jumlah_Kasus_Baru_per_Hari"] ?> Orang</td>

                 <td align='center'><?= $d["attributes"]["Jumlah_Kasus_Kumulatif"] ?> Orang</td>

                 <td align='center'><?= $d["attributes"]["Jumlah_pasien_dalam_perawatan"] ?> Orang</td>

                 <td align='center'><?= $d["attributes"]["Jumlah_Pasien_Sembuh"] ?> Orang</td>

                 <td align='center'><?= $d["attributes"]["Persentase_Pasien_dalam_Perawatan"] ?> %</td>

                 <td align='center'><?= $d["attributes"]["Jumlah_Pasien_Meninggal"] ?> Orang</td>

                 <td align='center'><?= $d["attributes"]["Persentase_Pasien_Meninggal"] ?> %</td>
             </tr>
         <?php endforeach ?>
     </table>
     <!-- Mengambil Statistik Perkembangan COVID19 di setiap provinsi Indonesia-->
     <?php
        //default time zone
        date_default_timezone_set("Asia/Jakarta");
        $array_per_provinsi = json_decode(file_get_contents("https://services5.arcgis.com/VS6HdKS0VfIhv8Ct/arcgis/rest/services/COVID19_Indonesia_per_Provinsi/FeatureServer/0/query?outFields=*&where=1%3D1&outFields=*&outSR=4326&f=json"), true);
        $info_per_provinsi_indonesia = $array_per_provinsi["features"];
        ?>
     <h1>Informasi tiap Provinsi Indonesia (<?= date('Y-m-d', strtotime(date("Y-m-d"))); ?>)</h1>
     <table cellpadding='10' width='100%' align='center' border='1'>
         <tr>
             <th align='center'>Provinsi</th>
             <th align='center'>Kasus Positif</th>
             <th align='center'>Kasus Sembuh</th>
             <th align='center'>Kasus Meninggal</th>
             </th>
             <?php foreach ($info_per_provinsi_indonesia as $ippi) : ?>

             <tr>
                 <td align='center'><?= $ippi["attributes"]["Provinsi"] ?></td>
                 <td align='center'><?= $ippi["attributes"]["Kasus_Posi"] ?> Orang</td>
                 <td align='center'><?= $ippi["attributes"]["Kasus_Semb"] ?> Orang</td>
                 <td align='center'><?= $ippi["attributes"]["Kasus_Meni"] ?> Orang</td>
             </tr>
         <?php endforeach ?>
     </table>
     <ul>
         <li>Sumber</li>
         <li>http://covid19.bnpb.go.id</li>
     </ul>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script>
         //panggil fungsi getGlobalInfo ketika halaman telah berhasil diload
         $(document).ready(function() {
             getGlobalInfo(); //memanggil fungsi getGlobalInfo
             getCountryInfo(); //memanggil fungsi getCountryInfo 
         });
         //membuat fungsi untuk mendapatkan jumlah global
         function getGlobalInfo() {
             $.ajax({
                 url: 'https://coronavirus-19-api.herokuapp.com/all',
                 success: function(data) {

                     try {
                         var json = data;
                         var kasus = json.cases;
                         var meninggal = json.deaths;
                         var pulih = json.recovered;

                         $("#global-kasus").html(kasus + " Kasus");
                         $("#global-meninggal").html(meninggal + " Orang Meninggal");
                         $("#global-pulih").html(pulih + " Orang Pulih");
                     } catch (e) {
                         alert("Gagal Mendapatkan Data Dari Server");
                     }
                 },
                 error: function(resp) {

                 }
             });
         }

         // Membuat fungsi untuk mendapatkan jumlah berdasarkan negara
         function getCountryInfo() {
             $.ajax({
                 url: 'https://coronavirus-19-api.herokuapp.com/countries',
                 success: function(data) {

                     try {
                         var json = data;
                         if (json.length > 0) {
                             var i;
                             for (i = 0; i < json.length; i++) {
                                 var html = []; //set variable html sebagai array
                                 var dataNegara = json[i];
                                 var no = i + 1;

                                 //data ini diambil berdasarkan data json yang tampil setelah mengakses url:
                                 var namaNegara = dataNegara.country;
                                 var kasus = dataNegara.cases;
                                 var kasusHariIni = dataNegara.todayCases;
                                 var active = dataNegara.active;
                                 var meninggal = dataNegara.deaths;
                                 var meninggalHariIni = dataNegara.todayDeaths;
                                 var pulih = dataNegara.recovered;
                                 var kritis = dataNegara.critical;

                                 //memasukkkan data diatas ke dalam tabel

                                 html.push("<tr>"); //membuka baris
                                 html.push("<td>" + no + "</td>"); //membuat kolom nomor
                                 html.push("<td>" + namaNegara + "</td>"); //membuat kolom Nama Negara
                                 html.push("<td>" + kasus + "</td>"); //membuat kolom kasus
                                 html.push("<td>" + kasusHariIni + "</td>"); //membuat kolom Kasus Hari Ini
                                 html.push("<td>" + active + "</td>"); //membuat kolom active
                                 html.push("<td>" + meninggal + "</td>"); //membuat kolom Meninggal
                                 html.push("<td>" + meninggalHariIni + "</td>"); //membuat kolom Meninggal Hari Ini
                                 html.push("<td>" + pulih + "</td>"); //membuat kolom pulih
                                 html.push("<td>" + kritis + "</td>"); //membuat kolom Kritis 
                                 html.push("</tr>"); //menutup baris

                                 // menambahkan tiap-tiap baris ke dalam tabel - body table
                                 $("#daftar-negara").append(html.join(""));
                             }
                         }
                     } catch (e) {
                         alert("Gagal Mendapatkan Data Dari Server");
                     }
                 },
                 error: function(resp) {

                 }
             });
         }
     </script>
 </body>

 </html>