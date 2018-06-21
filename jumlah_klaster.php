<?php
include "koneksi.php";

class jumlah_klaster {

//menentukkan nilai k
$resBobot = mysql_query("SELECT * FROM dokumen ORDER BY id");
   $num_rows = mysql_num_rows($resBobot);

   while($rowbobot = mysql_fetch_array($resBobot))
   {
      //menghitung jumlah dokumen/objek(n)
   	  $terjemah = $rowbobot['terjemahan_ayat'];
      $Id = $rowbobot['id'];
             
      //hitung berapa jumlah dokumen 
      $resNterjemah = mysql_query("SELECT Count(*) as N FROM dokumen  WHERE terjemahan_ayat = '$terjemah'");
      $rowNterjemah = mysql_fetch_array($resNterjemah);
      $Nterjemah = $rowNTerm['Nterjemah'];

 $jumlahTerm = mysql_query("SELECT * FROM tbindex ORDER BY Id");
    $hasil = mysql_num_rows($jumlahTerm)

   while($rowterm = mysql_fetch_array($jumlahTerm))
   {
   		//menghitung jumlah term 
    	$count = $rowterm['Count'];
    	$weight = $rowterm['weight'];

    	if($weight > 0){
    		echo $klaster;
    	}

    	$klaster = ($count * $Nterjemah) / $weight;

    	$hasilklaster = mysql_query("INSERT INTO  jumlah_klaster WHERE id_klaster = '$id'")
    }
}
if($hasilklaster){
    ?>
    <script language="JavaScript">
      alert('Successfully');
      window.location=history.go(-1);
    </script>
    <?php
}else
{
    ?>
    <script language="JavaScript">
      alert('Failed');
      window.location=history.go(-1);
    </script>
    <?php
}
}
?>